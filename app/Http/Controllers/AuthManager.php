<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Category;


class AuthManager extends Controller
{
    function login(){
        return view('login');
    }
    
    function registration(){
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error', "Login details are not valid");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with('error', 'Registration failed, try again.');
        }

        return redirect(route('login'))->with('success', "Registration Success!");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function create(){
        return view('createpost', ['title' => 'Create a New Post']);
    }

    public function createPost(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|unique:posts,title',
            'slug' => 'required|unique:posts,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // Slug validation
            'location' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'rsvp_limit' => 'required|integer|min:1|max:1000',
        ]);

        // Check and convert the uploaded image to Base64
        $image = null;
        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->path()));
            $mimeType = $request->file('image')->getClientMimeType();
            $image = "data:$mimeType;base64,$imageData";
        }

        // Prepare the data
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'location' => $request->location,
            'body' => $request->body,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'image' => $image,  // Store Base64 image
            'rsvp_limit' => $request->rsvp_limit,
        ];

        // Create the post
        $post = Post::create($data);


        if (!$post) {
            return redirect(route('createpost'))->with('error', 'Creating event failed, try again.');
        }

        return redirect(route('posts'))->with('success', 'Event uploaded successfully!');
    }

}
