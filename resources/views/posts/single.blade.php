@extends('layouts.master')

@section('content')

<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4">Post Detail</h2>

    @if($post)
        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <h3 class="text-xl font-semibold mb-4">{{ $post['title'] }}</h3>
            <p class="text-gray-700">{{ $post['content'] }}</p>
        </div>
    @else
        <p class="text-red-500">Post not found.</p>
    @endif
</div>

@endsection
