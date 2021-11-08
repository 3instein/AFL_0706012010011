@extends('layouts.app')

@push('prepend-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush

@section('body')
    <div class="mt-3">
        <h1 class="display-1 text-center">Team {{ auth()->user()->team->name }}</h1>
        <div class="team-table">
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
            <table class="table table-striped" id="members">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @if (auth()->user()->team->players->count() == 1)
                <form action="{{ route('teams.destroy', auth()->user()->team) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Destroy</button>
                </form>
            @else
                <a href="{{ route('teams.leave', auth()->user()) }}" class="btn btn-danger">Leave</a>
            @endif
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        var dataTable = $('#members').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'username',
                    name: 'username'
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
