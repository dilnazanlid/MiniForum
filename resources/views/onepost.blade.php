@extends('layouts.app')

@section('title'){{$value->title}} @endsection

@section('content')
  <div class="h-auto w-full bg-gray-600 flex text-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <div class="flex flex-col justify-center items-center">
      <div data-postid="{{ $value->id }}" class="lg:mx-64 mx-8 my-4 bg-gray-600 rounded-md border-2 border-gray-900 px-3 py-6 text-white text-left" id="2">
        <h1 class="text-xl font-bold text-black text-center mb-2">{{ $value->title }}</h1>
        <p style="white-space: pre-line; display: inline-block; ">{{ $value->body }}</p>
        <div class="flex flex-row text-black mt-2">
          @foreach($categories as $key => $category)
            <h2 class="mr-2"><strong>#{{ $category->category  }}</strong></h2>
          @endforeach
        </div>
        <hr>
        <div class="text-sm mt-2 flex flex-row">
          @if(Cookie::get('auth')!==null)
            <a href="#" class="like mx-2" onclick="likeFunction({{$value->id}}, 0)">@include('includes.like')</a>
          @else
            @include('includes.like')
          @endif
          <p class="countLikes{{$value->id}} font-bold px-2"> {{ $like }} </p>
          @if(Cookie::get('auth')!==null)
            <a href="#" class="like mx-2" onclick="likeFunction({{$value->id}}, 1)">@include('includes.dislike')</a>
          @else
            @include('includes.dislike')
          @endif
            <p class="countDislikes{{$value->id}} font-bold px-2"> {{ $dislike }} </p>
        </div>

        <div class="text-sm text-black my-2">
          Posted by {{ $value->user->username }} on {{ $value->created_at->format('d.m.Y') }} at {{ $value->created_at->format('H:i') }}
        </div>

      </div>
      <div class="container my-4 mx-8 py-4 px-3">
        @comments(['model' => $value])
      </div>
    </div>
  </div>
@endsection
