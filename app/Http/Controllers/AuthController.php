<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('login');
    }
    public function register_view()
    {
        return view('register');
    }


    public function register(Request $request)
    {

        // Get the name, email, and password from the request
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // Make a POST request to register the user
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(env('API_SERVER') . '/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // User registered successfully
            $responseData = $response->json();
            // Redirect to the login page
            return redirect()->route('register_view')->with('successMessage', 'Registration successful! Please log in.');
        } else {
            // Error handling
            $errorMessage = $response->json()['message'];
            // Redirect with an error message
            return redirect()->route('register_view')->with('errorMessage', $errorMessage);
        }
    }




    public function login(Request $request)
    {

        // Get the email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');

        // Make a POST request to authenticate the user
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(env('API_SERVER') . '/api/login', [
            'email' => $email,
            'password' => $password,
        ]);


        // Check if the request was successful
        if ($response->successful()) {
            // User logged in successfully
            $responseData = $response->json();

            // Store user data in the session
            session([
                'user_id' => $responseData['data']['user']['id'],
                'user_name' => $responseData['data']['user']['name'],
                'user_email' => $responseData['data']['user']['email'],
                'access_token' => $responseData['data']['token'],
            ]);

          // Optionally, you can also store a flag indicating that the user is logged in
          session(['logged_in' => true]);

            return redirect()->route('home'); // Replace with your desired redirect route
        } else {
            // Error handling
            $errorMessage = $response->json()['message'];
            // Redirect with an error message
            return redirect()->route('login')->with('errorMessage', $errorMessage);
        }
    }

    public function logout($id){

        session(['logged_in' => false]);

        // Make a POST request to register the user
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . session('access_token'),
        ])->get(env('API_SERVER') . '/api/logout/'.$id);

        return redirect('login');
    }



}
