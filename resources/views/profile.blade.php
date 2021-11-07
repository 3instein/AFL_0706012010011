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
        <h1>Profile</h1>
        <p class="mb-5 text-warning">
            Change your information!
        </p>
        <form action="{{ route('saveProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3 mx-0">
                <label for="profile_photo_path"
                    class="form-label @error('profile_photo_path') is-invalid @enderror fw-bold text-start text-light">Profile
                    Photo</label>
                <input class="form-control shadow-none" type="file" id="profile_photo_path" name="profile_photo_path">
                @error('profile_photo_path')
                    <div class="text-start invalid-feedback text-warning">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="username"
                        class="form-control shadow-none @error('username') is-invalid @enderror" id="username"
                        placeholder="" autocomplete="off" value="{{ auth()->user()->username }}" readonly>
                    <label for="username">Username</label>
                    @error('username')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control shadow-none @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" autocomplete="off" value="{{ auth()->user()->email }}">
                    <label for="email">Email</label>
                    @error('email')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-floating">
                    <input type="password" name="password"
                        class="form-control shadow-none @error('password') is-invalid @enderror" id="password"
                        placeholder="name@example.com">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success mb-5 bg-base-color w-75 mt-3">Save Changes</button>
        </form>
    </div>
@endsection
