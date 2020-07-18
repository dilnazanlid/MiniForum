@extends('layouts.app')

@section('title')Dashboard @endsection

@section('content')
  <div class="w-full lg:h-screen h-auto flex text-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <div class="container ">
      <div class="h-auto mx-8 my-4 bg-gray-600 rounded-md border-2 border-gray-900 px-3 py-6 text-white text-left">
        @include('includes.error')
        <form class="" action="{{ route('new_post') }}" method="post">
          @csrf
          <div class="flex flex-col">
            <div class="flex items-center justify-left">
              <label for="title" class="mx-4 mr-8">Title of the new post :
                <input type="text" name="title" id="title" required class="focus:outline-none shadow appearance-none border-2 rounded-md my-2 py-2 px-3 w-auto text-gray-700 leading-tight focus:border-gray-500" autocomplete="off"><br>
              </label>
            </div>
            <div class="flex items-center justify-left">
              <textarea name="body" id="body" rows="5" wrap="soft" required class="focus:outline-none shadow appearance-none border-2 rounded-md my-2 py-2 px-3 w-full text-gray-700 leading-tight focus:border-gray-500" autocomplete="off"></textarea><br>
            </div>
            <div class="flex lg:flex-row flex-col justify-around">
              @foreach($category as $cat)
                <div class="flex flex-row items-center mr-2">
                  <label class="w-full block font-bold">
                    <input class="mr-1 leading-tight" type="checkbox" name="category[]" value="{{$cat->id}}">
                    <span class="text-sm">
                      {{$cat->category}}
                    </span>
                  </label>
                </div>
              @endforeach
            </div>
            <div class="flex justify-center mt-4">
              <input type="submit" name="post" id="post" value="Post it!" class="focus:outline-none shadow text-black bg-gray-500 hover:bg-gray-900 hover:text-white transition duration-500 ease-in-out font-bold order-2 rounded-md my-2 py-2 px-3 w-32 bg-gray-200">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
