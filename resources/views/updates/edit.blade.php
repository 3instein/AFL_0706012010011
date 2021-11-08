@extends('layouts.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
@endpush

@push('prepend-script')
    <script src="{{ asset('/js/trix.js') }}"></script>
@endpush

@section('body')
    <div class="login-form w-100 mt-5">
        <h1>Edit update</h1>
        <form action="{{ route('updates.update', $update) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row mb-3 mx-0">
                <label for="thumbnail_path"
                    class="form-label @error('thumbnail_path') is-invalid @enderror fw-bold text-start text-light">Thumbnail
                </label>
                <input class="form-control shadow-none" type="file" id="thumbnail_path" name="thumbnail_path">
                @error('thumbnail_path')
                    <div class="text-start invalid-feedback text-warning">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="title" class="form-control shadow-none @error('title') is-invalid @enderror"
                        id="title" placeholder="" autocomplete="off" value="{{ $update->title }}" autofocus>
                    <label for="title">Update title</label>
                    @error('title')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="patch_code"
                        class="form-control shadow-none @error('patch_code') is-invalid @enderror" id="patch_code"
                        placeholder="" autocomplete="off" value="{{ $update->patch_code }}">
                    <label for="patch_code">Update patch code</label>
                    @error('patch_code')
                        <div class="text-start invalid-feedback text-warning">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 background">
                    <label for="description" class="form-label">Description</label>
                    <input id="description" type="hidden" name="description" value="{!! $update->description !!}">
                    <trix-editor input="description"></trix-editor>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            <button type="submit" class="btn btn-primary mb-5 bg-base-color">Update</button>
        </form>
    </div>
@endsection
