@extends('layout.main')

@section('container')

<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 mt-5 mb-3 shadow" style="background-color: #3eae4a; color: white;">
            
            <!-- Title and Profile Picture centered -->
            <div class="text-center mb-4">
                <h2 class="mb-2">Edit Profile</h2>
                
                <!-- Profile Picture -->
                <div class="mb-4">
                    @if($user->profile_picture)
                        <img src="{{ $user->profile_picture }}" 
                             alt="Profile Picture" 
                             class="rounded-circle border border-secondary" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-profile.jpg') }}" 
                             alt="Default Profile Picture" 
                             class="rounded-circle border border-secondary" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Form to update profile -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="text-white">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Age -->
                        <div class="form-group mb-3">
                            <label for="age" class="text-white">Age</label>
                            <input type="number" class="form-control" name="age" id="age" value="{{ old('age', $user->age) }}"/>
                        </div>

                        <!-- Bio -->
                        <div class="form-group mb-4">
                            <label for="bio" class="text-white">Bio</label>
                            <textarea class="form-control" name="bio" id="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="text-white">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="text-white">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <small class="form-text text-white">Leave blank if you do not want to change the password</small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="text-white">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                    </div>
                </div>

                <!-- Profile Picture Upload -->
                <div class="form-group mb-4">
                    <label for="profile_picture" class="text-white">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-light text-dark">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
