@extends('app')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <label for="username">Username</label>
        <input type="username" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
@endsection
