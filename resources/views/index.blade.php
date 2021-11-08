@extends('layouts.app')

@section('body')
    <div class="home">
        @can('create', App\Models\Update::class)
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success mt-5" role="alert">
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
                <a href="{{ route('updates.create') }}" class="btn btn-primary mt-4">Create Update</a>
            </div>
        @endcan
        <h1 class="display-4 mt-3 mb-4">Updates and Patches</h1>
        <div class="container-fluid">
            <div class="card-news">
                <a href="#">
                    @foreach ($updates as $update)
                        <div class="card mt-3 mb-5">
                            @if ($loop->first)
                                <img src="media/wallpaper.jpg" class="card-img-top" alt="...">
                            @else
                                <img src="{{ Storage::url($update->thumbnail_path) }}" class="card-img-top" alt="...">
                            @endif
                            <div class="card-body">
                                <h2 class="fw-bold">{{ $update->title }}</h2>
                                <p class="card-text">
                                    {!! $update->description !!}
                                </p>
                                <div class="d-flex align-items-baseline">
                                    @can('update', $update)
                                        <a href="{{ route('updates.edit', $update) }}"
                                            class="btn btn-warning mt-5 text-dark fw-bold px-2 py-2">
                                            Update
                                        </a>
                                    @endcan
                                    @can('delete', $update)
                                        <form action="{{ route('updates.destroy', $update) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-danger text-dark fw-bold ms-3 p-2">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </a>
            </div>
        </div>
    </div>

@endsection
