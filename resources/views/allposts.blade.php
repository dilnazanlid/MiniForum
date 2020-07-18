@extends('layouts.app')

@section('title')Posts @endsection

@section('content')
  <div class="h-auto flex bg-gray-600  text-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <div class="flex flex-col">


    <!-- filter button -->
      <div class="flex container mt-5 ml-8">
        <button type="button" name="filter" id="filter" class="px-4 py-4 bg-gray-600 rounded-full focus:outline-none">
          <img src="https://img.icons8.com/android/24/000000/filter.png" class="w-6 h-6"/>
        </button>
      </div>

      <!-- filter settings -->
      <div class="flex flex-col justify-center items-center " id="filterSettings" style="display:none;">
        <div class="lg:w-2/3 w-auto">
          <form class="shadow-md rounded mt-4 py-4 px-4 bg-gray-800 border-2 border-gray-600" action="/posts" method="get">
            @csrf
            <div class="flex flex-row items-center my-4">
              <p class="mr-4 font-semibold"><strong>By date:</strong></p>
              <input type="radio" id="latest" name="criteria" value="latest" {{ Request::input('criteria')=='latest' ? 'checked' : '' }}>
              <label for="latest" class="text-white mr-4 ml-2 font-semibold">Latest</label><br>
              <input type="radio" id="earliest" name="criteria" value="earliest" {{ Request::input('criteria')=='earliest' ? 'checked' : ''}}>
              <label for="earliest" class="text-white mr-4 ml-2 font-semibold">Earliest</label><br>
            </div>
            <div class="flex flex-row items-center my-4">
              <p class="mr-4 font-semibold"><strong>or popularity:</strong></p>
              <input type="radio" id="popularMost" name="criteria" value="popularMost" {{ Request::input('criteria')=='popularMost' ? 'checked' : '' }}>
              <label for="popularMost" class="text-white mr-4 ml-2 font-semibold">Most popular</label><br>
              <input type="radio" id="popularLeast" name="criteria" value="popularLeast" {{ Request::input('criteria')=='popularLeast' ? 'checked' : '' }}>
              <label for="popularLeast" class="text-white mr-4 ml-2 font-semibold">Least Popular</label><br>
              <input type="radio" id="disliked" name="criteria" value="disliked" {{ Request::input('criteria')=='disliked' ? 'checked' : '' }}>
              <label for="disliked" class="text-white mr-4 ml-2 font-semibold">Unpopular</label><br>
            </div>
            <div class="flex lg:flex-row flex-col">
                @foreach($cats as $cat)
                  <label class="mx-2 block text-white font-bold">
                    <input class="mr-1 leading-tight" type="checkbox" name="category[]" value="{{$cat->id}}" {{in_array($cat->id,  $inputCats) ? 'checked' : ''}}>
                    <span class="text-sm">
                      {{$cat->category}}
                    </span>
                  </label>
                @endforeach
              <br>
            </div>
            <div class="flex flex-row justify-center items-center">
              <input type="submit" name="filteringData" value="Filter" class="focus:outline-none shadow appearance-none border-2 rounded-full my-4 mx-4 py-2 px-3 w-32 text-gray-700 leading-tight text-black focus:border-gray-500 hover:text-orange-500 font-bold">
              <a href="/posts"><button type="button" name="reset" class="focus:outline-none shadow appearance-none border-2 rounded-full my-4 mx-4 py-2 px-3 w-32 leading-tight text-white focus:border-gray-500 hover:text-orange-500 font-bold">Reset</button></a>
            </div>
          </form>
        </div>
      </div>


      <!-- posts section -->
      @if(sizeof($data)==0)
        <div class="flex justify-center items-center my-4">
          <h1 class="font-bold text-2xl text-white">No results found</h1>
        </div>
      @endif
      <div class="flex flex-col justify-center items-center">
        @foreach($data as $value)
          <div data-postid="{{ $value->id }}" class="lg:w-2/3 w-4/5 mx-8 my-4 bg-gray-600 rounded-md border-2 border-gray-900 px-3 py-6 text-center text-white text-left">
            <a href="{{ route('one_post', $value->id) }}"><h1 class="text-xl font-bold">{{ $value->title }}</h1></a>
            <div class="text-sm text-black my-2" >
              Posted by {{ $value->user->username }} on {{ $value->created_at->format('d.m.Y') }} at {{ $value->created_at->format('H:i') }}
            </div>
            <hr>
            <p class="mt-2 text-left h-64" style="white-space: pre-line;  overflow: hidden; text-overflow: ellipsis;">{{ $value->body }}</p>
            <div class="text-sm mt-2 flex flex-row">
              @if(Cookie::get('auth')!==null)
                <a href="#" class="like mx-2" onclick="likeFunction({{$value->id}}, 0)">@include('includes.like')</a>
              @else
                @include('includes.like')
              @endif
              <p class="countLikes{{$value->id}} font-bold px-2"> {{ DB::table('likes')->where('post_id', $value->id)->where('like', 1)->count() }} </p>
              @if(Cookie::get('auth')!==null)
                <a href="#" class="like mx-2" onclick="likeFunction({{$value->id}}, 1)">@include('includes.dislike')</a>
              @else
                @include('includes.dislike')
              @endif
                <p class="countDislikes{{$value->id}} font-bold px-2"> {{ DB::table('likes')->where('post_id', $value->id)->where('like', 0)->count() }} </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){

    $('button').click(function(){
      $('#filterSettings').toggle('slow');
    });

  });
  </script>
@endsection
