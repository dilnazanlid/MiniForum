<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Like;
use App\Traits\checkTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use checkTrait;

    public function dashboardShow(){
      $cat = Category::all();
      return view('dashboard', ['category' => $cat]);
    }

    public function addNewPost(Request $request){

      $post = new Post();
      $post->title = $request['title'];
      $post->body = $request['body'];
      $post->likeCount = 0;
      $post->dislikeCount = 0;
      $categories = $request->has('category') ? $request->input('category') : [];
      $success = $request->user()->posts()->save($post);
      foreach ($categories as $value) {
        $data = array('post_id'=> $post->id, "category_id"=>$value);
        DB::table('post_categories')->insert($data);
      }

      if($success){
        return redirect()->route('dashboard')->with(['success' => 'Post was successfully uploaded!']);
      }
      return redirect()->route('dashboard')->with(['failed' => 'Something went wrong, try again!']);
    }

    public function getAllPosts(Request $request){

      $criteria = $request->has('criteria') ? $request->input('criteria') : null;
      $categories = $request->has('category') ? $request->input('category') : [];
      $cats = Category::all();

      $posts = Post::leftJoin('post_categories', 'posts.id', '=', 'post_categories.post_id')
                    ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
                    ->select('posts.*');

      if($categories != []){
        foreach($categories as $key => $category){
          $posts = $posts->orWhere('post_categories.category_id', '=', (int)$category);
        }
      }else{
        $categories = $cats->toArray();
      }

      if($criteria == 'earliest'){
        $posts = $posts->orderBy('created_at', 'asc')->distinct();
      }else if($criteria == 'popularMost'){
        $posts = $posts->orderBy('likeCount', 'desc')->distinct();
      }else if($criteria == 'popularLeast'){
        $posts = $posts->orderBy('likeCount', 'asc')->distinct();
      }else if($criteria == 'disliked'){
        $posts = $posts->orderBy('dislikeCount', 'desc')->distinct();
      }else{
        $posts = $posts->orderBy('created_at', 'desc')->distinct();
      }

      return view('allposts', ['data' => $posts->get(), 'cats' => $cats, 'inputCats' => $categories]);
    }

    public function getOnePosts($id){
      $post = Post::where('id', $id)->first();

      $categories = Category::leftJoin('post_categories', 'categories.id', '=', 'post_categories.category_id')
                      ->select('categories.*')
                      ->where('post_categories.post_id', $id)->get();
      //dd($categories->toArray());
      return view('onepost', ['value' => $post, 'categories' => $categories]);
    }

    public function likePost(Request $request){
      $post_id = $request['postId'];
      $islike = $request['islike'] === '0';

      $update = false;
      $post = Post::find($post_id);

      if(!$post){
        return null;
      }

      $user = Auth::user();
      $likeInDB = $user->likes()->where('post_id', $post_id)->first();

      if($likeInDB){
        $already = $likeInDB->like;
        $update = true;
        if($already == $islike){
          $likeInDB->delete();
          return $this->likeCount($request);
        }
      }else{
        $likeInDB = new Like();
      }

      $likeInDB->like = $islike;
      $likeInDB->user_id = $user->id;
      $likeInDB->post_id = $post->id;
      if($update){
        $likeInDB->update();
      }else{
        $likeInDB->save();
      }
      return $this->likeCount($request);
    }

    public function likeCount(Request $request){
      $post_id = $request['postId'];
      $user = Auth::user();
      $countLikes = Like::where('post_id', $post_id)
                        ->where('like', 1)->count();
      $post = Post::where('id', $post_id)->first();
      $post->likeCount = $countLikes;
      $post->update();

      $countDislikes = Like::where('post_id', $post_id)
                        ->where('like', 0)->count();
      $post = Post::where('id', $post_id)->first();
      $post->dislikeCount = $countDislikes;
      $post->update();
      return [$countLikes, $countDislikes];
    }
}
