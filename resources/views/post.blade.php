@extends('layout.main')

@section('container')
    <article style="padding-top:100px;">
        <!-- Post Title -->
        <h1 class="post-title">{{ $post->title }}</h1>

        <!-- Post Image -->
        <div class="post-image">
            <img src="{{ $post->image ? $post->image : asset('images/default-image.jpg') }}" 
                alt="{{ $post->image ? 'Post Image' : 'Default Post Image' }}" 
                class="img-fluid">
        </div>


        <!-- Post Description -->
        <div class="post-description">
            {!! $post->body !!}
        </div>

        <!-- Location -->
        <div class="post-details">
            <p><strong>Location:</strong> {{ $post->location }}</p>

            <!-- Event Time -->
            <p><strong>Event Time:</strong> {{ $post->event_time ?? 'TBA' }}</p>

            <!-- Zoom Link -->
            @if($post->category->slug === 'seminar')
                <p><strong>Zoom Link:</strong> 
                    @if($post->zoom_link)
                        <a href="{{ $post->zoom_link }}" target="_blank" class="zoom-link">{{ $post->zoom_link }}</a>
                    @else
                        Not provided
                    @endif
                </p>
            @endif

            <!-- Post Date -->
            <p><strong>Posted on:</strong> {{ $post->created_at->format('F j, Y') }}</p>
        </div>

        <!-- Profile Picture and Name -->
        <div class="post-profile">
            <div class="profile-info">
                @if($post->user->profile_picture)
                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="profile-img">
                @else
                    <img src="{{ asset('images/default-profile.jpg') }}" alt="Default Profile Picture" class="profile-img">
                @endif
                <p>{{ $post->user->name }}</p>
            </div>
        </div>

        <!-- RSVP Section -->
        <div class="join-now">
            <button id="joinBtn" class="btn join-btn" 
                onclick="toggleJoin()" 
                {{ $hasJoined ? 'disabled' : '' }}>
                {{ $hasJoined ? 'Joined' : 'RSVP Now' }}
            </button>
            <p><strong>Join Now ({{ $rsvpCount }}/{{ $rsvpLimit }})</strong></p>
            <a href="/posts" class="btn back-btn">Back to blog</a>
        </div>
    </article>

    <!-- Styles -->
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Montserrat', sans-serif;
            color: #333;
        }

        .post-title {
            font-size: 3rem;
            font-weight: 700;
            color: #111;
            text-align: center;
            margin-bottom: 20px;
        }

        .post-image img {
            max-width: 100%; 
            max-height: 600px; 
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .post-description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
            text-align: center; /* Align description to the center */
            margin-left:120px;
            margin-right:120px;
        }

        .post-details {
            font-size: 1rem;
            color: #444;
            margin-bottom: 20px;
            line-height: 1.5;
            margin-left: 120px;
        }

        .post-profile {
            margin-top: 30px;
            text-align: left;
            margin-left: 120px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .profile-img {
            max-width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }

        .profile-info p {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 600;
        }

        .join-now {
            margin-top: 20px;
            text-align: center;
        }

        .btn {
            background-color: #b59f57;
            color: white;
            padding: 12px 24px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 1.1rem;
            text-transform: uppercase;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #a68c4a;
            cursor: pointer;
            transform: translateY(-2px);
            color: #fff;
        }

        .join-btn {
            background-color: #3b9e1e;
        }

        .join-btn:hover {
            background-color: #339e0d;
        }

        .back-btn {
            background-color: #1c3a66;
            margin-top: 10px;
        }

        .back-btn:hover {
            background-color: #102a44;
        }
    </style>

    <!-- Scripts -->
    <script>
        const isJoined = @json($hasJoined);
        const joinBtn = document.getElementById('joinBtn');
        const postId = @json($post->id);
        let rsvpCount = @json($rsvpCount); // Current RSVP count
        const rsvpLimit = @json($rsvpLimit); // RSVP limit

        function toggleJoin() {
            if (isJoined) return; // If the user has already joined, do nothing

            fetch(`/posts/${postId}/rsvp`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    joinBtn.innerHTML = 'Joined'; // Change the button text
                    joinBtn.disabled = true; // Disable the button to prevent further clicks

                    // Update the RSVP count
                    rsvpCount++; // Increment the local RSVP count
                    document.querySelector('.join-now p').innerText = `Join Now (${rsvpCount}/${rsvpLimit})`;
                } else {
                    alert(data.error); // Handle error if RSVP fails
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
