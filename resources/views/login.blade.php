@extends('layouts.app')

@section('title')Signin @endsection

@section('content')
  <div class="h-screen w-full bg-gray-600 flex text-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <div class="flex flex-col justify-center items-center">
      @include('includes.error')
      <div class="my-4 mb-32 mx-16">
        <h1 class="text-2xl text-white font-bold">Sign In</h1>
        <form class="form-control" action="{{route('signin', 'login')}}" method="post">
          @csrf
          <label for="username" class="text-gray-900 font-bold text-xl mr-4">Username:</label>
          <input type="text" name="username" id="username" value="{{ Request::old('username') }}" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" autocomplete="off" required><br>
          <label for="password" class="text-gray-900 font-bold text-xl mr-4">Password:</label>
          <input type="password" name="password" id="password" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" required><br>
          <input type="submit" name="signin" value="Sign In" class="focus:outline-none border-2 rounded-full w-40 my-2 py-2 px-3 font-bold bg-gray-500 hover:bg-gray-900 hover:text-white transition duration-500 ease-in-out">
        </form>
        @if (Session::has('wrong'))
          <div class="bg-red-300 my-4 rounded-full py-2 px-2 text-center">
            <h1>{{Session::get('wrong') }}</h1>
          </div>
        @endif
      </div>
      <p class="text-xl font-bold">Don't have an account? Sing up <a href="{{route('signup_page')}}">here!</a></p>
    </div>
  </div>
@endsection
