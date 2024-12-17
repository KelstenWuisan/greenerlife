@extends('layout.mains')

@section('container')
<style>
    body {
        background-color: #122023;
        margin-top: 80px;
    }

    h1, h2, h3 {
        color: #2ECC40;
        font-family: 'Urbanist', sans-serif;
    }

    .btn-success {
        background-color: #2ECC40;
        border: none;
    }

    .btn-success:hover {
        background-color: #28A745;
    }

    .leaderboard {
        background-color: #1C3D3D;
        border-radius: 10px;
        padding: 20px;
        max-width: 100%;
    }

    .leaderboard h2 {
        font-size: 24px;
    }

    .leaderboard .card {
        background-color: #fff;
        color: #122023;
        border-radius: 10px;
        padding: 20px;
        width: 250px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .leaderboard .card img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .leaderboard .card .user-info {
        text-align: center;
        margin-bottom: 10px;
    }

    .leaderboard .card .user-info span {
        display: block;
        font-weight: bold;
    }

    .leaderboard .card .points {
        font-size: 18px;
        font-weight: bold;
    }

    /* Flexbox container for side-by-side layout */
    .leaderboard .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 50px;
    }
</style>

<h1 class="text-center mb-4">{{ $title }}</h1>

<div class="container mt-5">
    <!-- Leaderboard -->
    <div class="text-center mb-5 leaderboard">
        <h2>Leaderboard</h2>
        <div class="cards-container">
            @if($topUsers->count())
                @foreach($topUsers as $user)
                    <div class="card">
                        <div class="user-info">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}'s Profile Picture" class="profile-img">
                            @else
                                <img src="{{ asset('images/default-profile.jpg') }}" alt="Default Profile Picture" class="profile-img">
                            @endif
                            <span>{{ $user->name }}</span>
                        </div>
                        <span class="points">Points: {{ $user->points }}</span>
                    </div>
                @endforeach
            @else
                <p>No users on the leaderboard yet.</p>
            @endif
        </div>
    </div>

    <!-- Challenges -->
    <h2 class="text-center">Challenges List</h2>
    <div class="row justify-content-center">
        @if($challenges->count())
            @foreach($challenges as $challenge)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $challenge->title }}</h5>
                            <p>{{ $challenge->description }}</p>
                            <p class="card-text">Points: {{ $challenge->points }}</p>
                            
                            <!-- Trigger modal -->
                            <button type="button" class="btn btn-success" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#proofModal" 
                                    data-challenge-id="{{ $challenge->id }}"
                                    {{ auth()->user()->completedChallenges->contains($challenge) ? 'disabled' : '' }}>
                                {{ auth()->user()->completedChallenges->contains($challenge) ? 'Completed' : 'Join Challenge' }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No challenges available right now.</p>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Submit Documentation Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('challenges.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="challenge_id" id="challengeIdInput">
                    <div class="mb-3">
                        <label for="proofFile" class="form-label">Upload Proof (PDF/Image)</label>
                        <input type="file" class="form-control" id="proofFile" name="proof" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Pass the selected challenge ID to the modal form
    const proofModal = document.getElementById('proofModal');
    proofModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const challengeId = button.getAttribute('data-challenge-id');
        document.getElementById('challengeIdInput').value = challengeId;
    });

    // Update completed button states after submission
    const completedChallenges = @json(auth()->user()->completedChallenges->pluck('id'));
    document.querySelectorAll('button[data-challenge-id]').forEach(button => {
        const challengeId = button.getAttribute('data-challenge-id');
        if (completedChallenges.includes(Number(challengeId))) {
            button.disabled = true;
            button.textContent = 'Completed';
        }
    });
</script>
@endsection
