@extends('layouts.master')

@section('content')

<div class="bg-white p-8 rounded-md shadow-md max-w-md w-full">
        <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>

        <form action="{{ route('signin') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none">
                Login
            </button>
        </form>
    </div>
@endsection
