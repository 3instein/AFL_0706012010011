@extends('layouts.app')

@push('prepend-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush

@section('body')

    <div class="position-absolute top-50 start-50 translate-middle text-center">
        <div class="team-table text-center">
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
            <table class="table table-striped" id="teams">
                <thead>
                    <tr>
                        <th scope="col">Team Name</th>
                        <th scope="col">Team Tag</th>
                        <th scope="col">Players</th>
                        <th scope="col">Team Rating</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="login-form w-100 mt-5">
            <h1>Register your Team</h1>
            <p class="mb-5 text-warning">
                Register to start playing as a team!
            </p>
            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror"
                            id="name" placeholder="" autocomplete="off" value="{{ old('name') }}" autofocus>
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
                            id="tag" placeholder="" autocomplete="off" value="{{ old('tag') }}">
                        <label for="tag">Team Tag</label>
                        @error('tag')
                            <div class="text-start invalid-feedback text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-5 bg-base-color">Register</button>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        var dataTable = $('#teams').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'tag',
                    name: 'tag'
                },
                {
                    data: 'players',
                    name: 'players'
                },
                {
                    data: 'rating',
                    name: 'rating'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush
