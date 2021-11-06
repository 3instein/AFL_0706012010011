@extends('layouts.app')

@section('body')

    <div class="position-absolute top-50 start-50 translate-middle">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card player-info" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Player Info</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ auth()->user()->username }}</h6>
                {{-- <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a> --}}
                <span>Current Rating: {{ auth()->user()->rating }}</span>
                <span><br>Bracket: {{ auth()->user()->bracket->name }}</span>
                <form action="{{ route('index-play') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger px-5 py-3 w-100">Play</button>
                </form>
            </div>
        </div>
    </div>

@endsection
