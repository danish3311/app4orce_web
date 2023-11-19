
@extends('layouts.master')

@section('content')

<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4">Posts</h2>

    <!-- Table to Display Posts -->
    <table class="min-w-full bg-white border rounded-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Content</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td class="py-2 px-4 border-b"><a href="{{route('posts.single',$post['id'])}}">{{ $post['title'] }}</a></td>
                <td class="py-2 px-4 border-b">{{ $post['content'] }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('posts.edit', $post['id']) }}" class="text-blue-500 hover:underline mr-2">Edit</a>

                    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

@endsection
