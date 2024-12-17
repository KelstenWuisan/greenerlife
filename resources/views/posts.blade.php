@extends('layout.main')

@section("container")
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background for better contrast */
            background-image: url('{{asset('images/Events-Horse.jpg')}} '); /* Replace with your preferred background image */
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            width: 100vw;
            overflow-x: hidden;
        }

        .create-post-btn {
            display: block;
            margin: 20px auto; /* Center the button below the search bar */
            background-color: #28a745; /* Green color for the button */
            color: white;
            border: none;
        }

        .create-post-btn:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .content-container {
            margin-top: 100px; /* Push content lower on the screen */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
        }

        .card:hover {
            transform: translateY(-5px); /* Slight animation on hover */
            transition: 0.3s ease;
        }

        .text-center h1 {
            color: #343a40; /* Darker text for contrast */
        }

        .btn {
            background-color: #75af48;
            color: white;
            transition: all 0.3s ease-in-out; /* Smooth transition */
        }

        .btn:hover {
            background-color: #75af48; /* Nice green color */
            color: white; /* Text color */
            transform: scale(1.05); /* Slightly enlarge the button */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Add depth with a shadow */
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); /* Subtle text shadow for better contrast */
        }

        .category-buttons {
            display: inline-flex; /* Ensures buttons are aligned horizontally */
            gap: 0; /* Removes gaps between buttons */
        }

        .category-btn {
            background-color: #122023;
            border-radius: 0; /* Remove border-radius for all buttons initially */
            border: 1px solid #122023; /* Ensure consistent borders */
            margin: 0; /* No margins to remove spacing issues */
        }

        .category-btn:hover {
            background-color: #122023; /* Nice green color */
            color: white; /* Text color */
            transform: scale(1.05); /* Slightly enlarge the button */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Add depth with a shadow */
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); /* Subtle text shadow for better contrast */
        }

        .category-btn.rounded-start {
            border-radius: 50px 0 0 50px; /* Rounded left side for the first button */
        }

        .category-btn.rounded-end {
            border-radius: 0 50px 50px 0; /* Rounded right side for the last button */
        }

        .category-btn.no-radius {
            border-left: none; /* Remove border between buttons */
        }
        .category-buttons {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    /* Space between buttons */
                }

    </style>

    <div class="content-container">
        <h1 class="mb-3 text-center mt-10 text-white"> {{ $title }} </h1>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/posts">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." name="search">
                        <button class="btn" type="submit">Search</button>
                    </div>
                </form>

                <!-- Create Post Button -->
                <a href="{{ route('create') }}" class="btn create-post-btn">Create Post</a>
                <div class="category-buttons mt-4 text-center">
                    @foreach ($categories as $category)
                        <a href="/categories/{{ $category->slug }}" 
                        class="category-btn btn btn-success {{ $loop->first ? 'rounded-start' : ($loop->last ? 'rounded-end' : 'no-radius') }}"
                        style="min-width: 150px;">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <div class="justify-content-center">
                @foreach ($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 60rem; border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        <div class="card-body d-flex align-items-center">
                            <!-- Left side: Image -->
                            <div class="post-image" style="flex: 1; padding-right: 20px;">
                                <img src="{{ $post->image ? $post->image : asset('images/default-image.jpg') }}" 
                                    alt="Post Image" 
                                    class="img-fluid" 
                                    style="max-width: 100%; height: auto; border-radius: 8px;">
                            </div>

                            <!-- Right side: Text -->
                            <div class="post-content" style="flex: 2;">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>By <a href="/authors/{{ $post->user->name }}">{{ $post->user->name }}</a></p> 
                                <p><a href="/categories/{{ $post->category->slug }}" class="no-link">Event Type: {{ $post->category->name }}</a> </p>
                                <p class="card-text">Location: {{ $post->location }}</p>
                                <p>{{ $post->created_at->diffForHumans() }}</p>
                                <a href='/posts/{{ $post->slug }}' class="text-decoration-none btn btn-primary"> Read More.. </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="d-flex justify-content-center align-items-center">
            <div class="justify-content-center">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card" style="width: 60rem; border: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <div class="card-body d-flex align-items-center">
                        <!-- Left side: Image -->
                        <div class="post-image" style="flex: 1; padding-right: 20px;">
                            <img src="{{ $post->image && file_exists(public_path('storage/' . $post->image)) 
                                    ? asset('storage/' . $post->image) 
                                    : asset('images/default-image.jpg') }}" 
                            alt="Post Image" 
                            class="img-fluid" 
                            style="max-width: 100%; height: auto; border-radius: 8px;">
                        </div>

                        <!-- Right side: Text -->
                        <div class="post-content" style="flex: 2;">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p>By <a href="/authors/{{ $post->user->name }}">{{ $post->user->name }}</a></p> 
                            <p><a href="/categories/{{ $post->category->slug }}" class="no-link">Event Type: {{ $post->category->name }}</a> </p>
                            <p class="card-text">Location: {{ $post->location }}</p>
                            <p>{{ $post->created_at->diffForHumans() }}</p>
                            <a href='/posts/{{ $post->slug }}' class="text-decoration-none btn btn-primary"> Read More.. </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>


        {{ $posts->links() }}
    </div>

    <style>
        a.no-link{
            color: inherit !important;
            text-decoration: none !important;
        }
    </style>
@endsection
