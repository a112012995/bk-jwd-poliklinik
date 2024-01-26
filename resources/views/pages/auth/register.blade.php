@extends('app')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf

        <label for="username">Username</label>
        <input type="username" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Retype Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        @error('password_confirmation')
            <div>{{ $message }}</div>
        @enderror

        <button type="submit">Register</button>
    </form>
@endsection
