<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Rsvp; // Ensure the RSVP model is imported
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display list of posts
    public function index()
    {
        return view('posts', [
            "title" => "All Events",
            "posts" => Post::latest()->filter(request(['category', 'search']))->paginate(5),
            "categories" => Category::all(),
        ]);
    }

    public function show($slug)
    {
        // Fetch the post by slug first
        $post = Post::where('slug', $slug)->firstOrFail();
        
        $user = Auth::user();

        // Check if the user has RSVP'd for this post
        $hasJoined = $user ? $post->rsvps->contains('user_id', $user->id) : false;

        $rsvpCount = $post->rsvps->count(); // Ensure this is calculated

        // Pass data to the view
        return view('post', [
            "title" => "Event",
            "post" => $post,
            'hasJoined' => $hasJoined,

            'rsvpCount' => $rsvpCount,  // Pass the RSVP count
            'rsvpLimit' => $post->rsvp_limit,     // Pass the RSVP limit
        ]);
    }


    // Display posts by category
    public function showCategory()
    {
        return view('posts.index', [
            "title" => "All Posts",
            "posts" => Post::latest()->filter(request(['search', 'category']))->paginate(10), // Pagination for posts
            "categories" => Category::all(), // No pagination for categories
        ]);
    }


    // PostController.php
    public function rsvp(Request $request, Post $post)
    {
        $user = Auth::user();
    
        // Check if the user already RSVP'd
        if ($post->rsvps->contains('user_id', $user->id)) {
            return response()->json(['success' => false, 'error' => 'You have already RSVP\'d.']);
        }
    
        // Check if RSVP limit is reached
        if ($post->rsvps->count() >= $post->rsvp_limit) {
            return response()->json(['success' => false, 'error' => 'RSVP limit reached.']);
        }
    
        // Add RSVP
        $post->rsvps()->create(['user_id' => $user->id]);
    
        // After adding RSVP, fetch the updated RSVP count
        $newRsvpCount = $post->rsvps->count(); // Count the number of RSVPs from the relationship
    
        // Update the RSVP count field in the post model (this is optional if you want to store it in the DB)
        $post->rsvp_count = $newRsvpCount;
        $post->save();
    
        return response()->json(['success' => true, 'new_count' => $newRsvpCount]);
    }
    

}


