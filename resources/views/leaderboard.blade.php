@extends('layout.mains')

@section('content')
<h1>Leaderboard</h1>
<table>
    <thead>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->points }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
