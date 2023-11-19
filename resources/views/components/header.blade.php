<div class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Your Logo or Branding -->
        <div class="text-lg font-semibold">
            <a href="/">App4orce</a>
        </div>

            <!-- Navigation Links -->
            <ul class="flex space-x-4">
            <li><a href="/">Home</a></li>
            @if(!session('logged_in'))  <li><a href="/register">Register</a></li>  @endif
            <li><a href="posts/create">Create Post</a></li>
            <!-- Add more li elements for additional links -->
        </ul>

        @if(session('logged_in'))
        <button class="flex items-center focus:outline-none">
        <form method="POST" action="{{ route('logout',session('user_id')) }}">
            @csrf
            <button type="submit" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                Logout
            </button>
        </form>
            </button>
        @else
        <button type="submit" class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-100">
                <a href="{{route('login_view')}}">Login</a>
            </button>
        @endif
    </div>
</div>
