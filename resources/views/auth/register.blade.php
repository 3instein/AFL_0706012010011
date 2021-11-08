{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts.app')

@section('body')
<div class="login-form position-absolute top-50 start-50 translate-middle text-center">
    <h1>Welcome to DOTA 2</h1>
    <p class="mb-5 text-warning">
        Register to start playing!
    </p>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="form-floating">
                <input type="text" name="username" class="form-control shadow-none @error('username') is-invalid @enderror"
                    id="username" placeholder="name@example.com" autocomplete="off" value="{{ old('username') }}" autofocus>
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
                    id="email" placeholder="name@example.com" autocomplete="off" value="{{ old('email') }}">
                <label for="email">Email</label>
                @error('email')
                    <div class="text-start invalid-feedback text-warning">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
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
        <button type="submit" class="btn btn-primary mb-5 bg-base-color">Register</button>
    </form>
    <a href="{{ route('login') }}" class="text-decoration-none text-dark-color not-registered">Already have an account? <span
            class="text-base-color">Sign in now!</span></a>
</div>
@endsection
