@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (auth()->check())

                    Hello {{ auth()->user()->role }} ,
                    {{ ucwords(auth()->user()->first_name . " " . auth()->user()->last_name) }}
                    @else
                        Hello User
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Blogs
                        @if (auth()->check())
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add New</a>
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                            @endif
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>description</th>
                                        <th>Start Date</th>
                                        <th>End date</th>
                                        <th>Is Active?</th>
                                        @if (auth()->check())
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @if ($blogs->count())
                                    @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <a href="{{ $blog->image }}" target="_blank">
                                                <img src="{{ $blog->image }}" width="100" height="100"
                                                    alt="{{ $blog->title. " image" }}">
                                            </a>
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ \Str::limit($blog->description, 100, '...') }}</td>
                                        <td>{{ date('d-m-Y',strtotime($blog->start_date)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($blog->end_date)) }}</td>
                                        <td>{{ $blog->is_active == 1 ? "Yes":"No" }}</td>
                                        @if (auth()->check())
                                        <td>
                                            <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
                                                <a href="{{ route('blogs.edit',$blog->id) }}"
                                                    class="btn btn-small btn-outline-info">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-small btn-outline-danger"
                                                    onclick="return confirm('Are you sure to delete?')">DELETE</button>
                                            </form>
                                        </td>

                                        @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="{{ auth()->check() ? 8 : 7 }}" class="text-center">
                                            No Data available
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                                </tbody>
                            </table>
                            @if ($blogs->count())
                            {!! $blogs->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
