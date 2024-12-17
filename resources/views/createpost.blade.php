@extends('layout.mainlayout')
@section('title', 'Create Post')
@section('content')

<style>
    body {
        background-image: url('{{ asset('images/Events-Horse.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 20px 0;
        margin: 0;
        overflow-y: auto;
    }

    .login-box {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
        margin: 20px;
        overflow-y: auto;
    }

    .form-label {
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .login-box {
            padding: 20px;
            margin: 10px;
        }

        body {
            padding: 10px;
        }
    }
</style>


<div class='login-box'>
    <h2 class="text-center">Create A Post</h2>
    <div class="mt-3">
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <!-- Create Post Form -->
    <form action="{{ route('create.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        
        <!-- Slug -->
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Auto-generated or enter manually" required>
        </div>
        
        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" required>
        </div>
        
        <!-- Event Date -->
        <div class="form-group">
            <label for="event_date">Event Date and Time</label>
            <input type="text" class="form-control" name="event_date" id="event_date" placeholder="e.g., 11:20-13:00" required>
        </div>
        
        <!-- Body -->
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
        </div>
        
        <!-- Category Dropdown -->
        <div class="form-group">
            <label for="category">Category</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Category
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-value="1">Volunteer</a>
                    <a class="dropdown-item" href="#" data-value="2">Fundraiser</a>
                    <a class="dropdown-item" href="#" data-value="3">Workshop</a>
                    <a class="dropdown-item" href="#" data-value="4">Seminar</a>
                </div>
            </div>
            <input type="hidden" name="category_id" id="category_id" required>
        </div>
        
        <!-- Zoom Meeting Link (hidden by default) -->
        <div class="form-group" id="zoom_link_container" style="display: none;">
            <label for="zoom_link">Zoom Meeting Link</label>
            <input type="url" class="form-control" name="zoom_link" id="zoom_link" placeholder="Enter the Zoom meeting link">
        </div>
        
        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/jpeg, image/png, image/jpg, image/gif, image/svg">
        </div>

        <div class="form-group">
            <label for="rsvp_limit">RSVP Limit</label>
            <input type="number" class="form-control" name="rsvp_limit" id="rsvp_limit" 
                placeholder="Set the RSVP limit (max 1000)" min="1" max="1000" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Create Event</button>
    </form>
</div>

<script>
    // JavaScript to handle category selection
    document.querySelectorAll('.dropdown-item').forEach(function(item) {
        item.addEventListener('click', function() {
            var categoryValue = this.getAttribute('data-value');
            document.getElementById('category_id').value = categoryValue;
            document.getElementById('dropdownMenuButton').textContent = this.textContent;

            // Show Zoom link input only for Seminar
            if (categoryValue === "4") {
                document.getElementById('zoom_link_container').style.display = "block";
            } else {
                document.getElementById('zoom_link_container').style.display = "none";
            }
        });
    });

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function () {
        const title = this.value;
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .trim();
        document.getElementById('slug').value = slug;
    });
</script>

@endsection
