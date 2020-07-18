@extends('layouts.app')

@section('title')Signup @endsection

@section('content')
  <div class="h-screen w-full bg-gray-600 flex text-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <div class="flex flex-col justify-center items-center">
      @include('includes.error')
      <div class="my-4 mx-16 mb-32">
        <h1 class="text-2xl text-white font-bold">Sign Up</h1>
        <form class="form-control" action="{{route('signup', 'signup')}}" method="post">
          @csrf
          <label for="name" class="text-gray-900 font-bold text-xl mr-4">Name:</label>
          <input type="text" name="name" id="name" value="{{ Request::old('name') }}" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" autocomplete="off" required><br>
          <label for="name" class="text-gray-900 font-bold text-xl mr-4">Email:</label>
          <input type="email" name="email" id="email" value="{{ Request::old('email') }}" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" autocomplete="off" required><br>
          <label for="username" class="text-gray-900 font-bold text-xl mr-4">Username:</label>
          <input type="text" name="username" id="username" value="{{ Request::old('username') }}" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" autocomplete="off" required><br>
          <label for="password" class="text-gray-900 font-bold text-xl mr-4">Password:</label>
          <input type="password" name="password" id="password" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500" required><br>
          <input type="submit" name="signin" value="Sign Up" class="focus:outline-none border-2 rounded-full w-40 my-2 py-2 px-3 font-bold bg-gray-500 hover:bg-gray-900 hover:text-white transition duration-500 ease-in-out">
        </form>
      </div>
      <p class="text-xl font-bold">Already have an <a href="{{route('login_page')}}" >account?</a></p>
    </div>
  </div>
@endsection
