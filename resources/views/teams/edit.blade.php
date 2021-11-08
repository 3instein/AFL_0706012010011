@extends('layouts.app')

@section('body')
    <div class="login-form position-absolute top-50 start-50 translate-middle text-center">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session()->has('none'))
            <div class="alert alert-warning" role="alert">
                {{ session('none') }}
            </div>
        @elseif (session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <h1>Update your Team</h1>
        <p class="mb-5 text-warning">
            Change your team information!
        </p>
        <form action="{{ route('teams.update', $team) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror"
                        id="name" placeholder="" autocomplete="off" value="{{ $team->name }}" autofocus>
                    <label for="name">Team Name</label>
                    @error('name')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="tag" class="form-control shadow-none @error('tag') is-invalid @enderror"
                        id="tag" placeholder="" autocomplete="off" value="{{ $team->tag }}">
                    <label for="tag">Team Tag</label>
                    @error('tag')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5 bg-base-color">Change</button>
        </form>
    </div>
@endsection
