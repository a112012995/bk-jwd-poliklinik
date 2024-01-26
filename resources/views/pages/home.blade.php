<!-- resources/views/pages/home.blade.php -->

@extends('app')

@section('title', 'Home')

@section('content')
    <h1>Welcome to the Home Page!</h1>

    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>You are not logged in. <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>.</p>
    @endauth
@endsection
