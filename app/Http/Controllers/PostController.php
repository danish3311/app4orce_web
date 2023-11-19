<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{


    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get(env('API_SERVER') . '/api/posts');

        if ($response->successful()) {
            // Decode the JSON response
            $posts = $response->json();
            return view('posts.index', ['posts' => $posts['posts']]);
        } else {
            $errorMessage = $response->json()['message'];
            return view('posts.index', ['posts' => [], 'errorMessage' => $errorMessage]);
        }
    }

    public function create_view(Request $request){
       return view('posts.create');
    }

    public function create_post(Request $request)
    {

        // Get the title and content from the request
        $title = $request->input('title');
        $content = $request->input('content');

        // Make a POST request to create the post
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . session('access_token'),
        ])->post(env('API_SERVER') . '/api/posts', [
            'title' => $title,
            'content' => $content,
            'id'=>session('user_id')
        ]);
    // Check if the request was successful
    if ($response->successful()) {
        // Post created successfully
        $responseData = $response->json();
        // Access the data if needed
        $createdPost = $responseData['data'];
        // Redirect or do something else
        return redirect()->route('home')->with('successMessage', 'Post created successfully');
    } else {
        // Error handling
        $errorMessage = $response->json()['message'];
        // Redirect with an error message
        return redirect()->route('create_view')->with('errorMessage', $errorMessage);
    }
    }

    public function update(Request $request)
    {
   // Get the title and content from the request
   $title = $request->input('title');
   $content = $request->input('content');

   // Make a POST request to create the post
   $response = Http::withHeaders([
       'Accept' => 'application/json',
       'Content-Type' => 'application/json',
       'Authorization' => 'Bearer ' . session('access_token'),
   ])->put(env('API_SERVER') . '/api/posts/'.$request->id, [
       'title' => $title,
       'content' => $content,
       'id'=>session('user_id')
   ]);

// Check if the request was successful
if ($response->successful()) {
   // Post created successfully
   $responseData = $response->json();
   // Access the data if needed
   $createdPost = $responseData['data'];
   // Redirect or do something else
   return redirect()->route('home')->with('successMessage', 'Post created successfully');
} else {
   // Error handling
   $errorMessage = $response->json()['message'];
   // Redirect with an error message
   return redirect()->back()->with('errorMessage', $errorMessage);
}
    }

    public function single($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . session('access_token'),
        ])->get(env('API_SERVER') . '/api/posts/' . $id);

        if ($response->successful()) {
            // Decode the JSON response
            $post = $response->json();
            return view('posts.single', ['post' => $post['data']]);
        } else {
            $errorMessage = $response->json()['message'];
            return view('posts.single', ['post' => null, 'errorMessage' => $errorMessage]);
        }
    }


    public function edit($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get(env('API_SERVER') . '/api/posts/' . $id);

        if ($response->successful()) {
            // Decode the JSON response
            $post = $response->json();
            return view('posts.update', ['post' => $post['data']]);
        } else {
            $errorMessage = $response->json()['message'];
            return view('posts.update', ['post' => null, 'errorMessage' => $errorMessage]);
        }
    }
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . session('access_token'),
        ])->delete(env('API_SERVER') . '/api/posts/' . $id);
        if ($response->successful()) {
            return redirect()->back();
        } else {
            $errorMessage = $response->json()['message'];
            return redirect()->back()->with('errorMessage', $errorMessage);
        }
    }
}
