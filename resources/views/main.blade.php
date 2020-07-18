@extends('layouts.app')

@section('title')Main @endsection

@section('content')
  <div class="h-screen w-full bg-gray-600 flex text-center items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1523821741446-edb2b68bb7a0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80'); background-size: 100% 100%;">
    <h1 class="text-3xl font-bold mb-32"> <a href="{{route('login_page')}}"> Get Started </a></h1>
  </div>
@endsection
