@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Blog') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('blogs.update',$blog->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label text-md-right">{{ __('Title') }}</label>

                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title')??$blog->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="10" class="form-control">{{ old('description')??$blog->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="start_date"
                                    class="col-form-label text-md-right">{{ __('Start Date') }}</label>

                                <input id="start_date" type="text"
                                    class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                    value="{{ old('start_date')??$blog->start_date }}" required autocomplete="start_date">

                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="end_date" class="col-form-label text-md-right">{{ __('End Date') }}</label>

                                <input id="end_date" type="text"
                                    class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                    value="{{ old('end_date')??$blog->end_date }}" required autocomplete="end_date">

                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="is_active"
                                    class="col-form-label text-md-right">{{ __('Is Active?') }}</label>

                                <label for="is_active1">

                                    <input type="radio" name="is_active" id="is_active1" value="1" {{ $blog->is_active == 1 ?  'checked' : ''}}> Yes
                                </label>
                                <label for="is_active2">

                                    <input type="radio" name="is_active" id="is_active2" value="0" {{ $blog->is_active == 0 ?  'checked' : ''}}> No
                                </label>

                                @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="image"
                                    class="col-form-label text-md-right">{{ __('Image') }}</label>

                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}" autocomplete="image">
                                <a href="{{ $blog->image }}" target="_blank">view</a>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <input type="submit" value="Submit" class='btn btn-primary'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(function(){
            $('#start_date').datepicker({
                format:'yyyy-mm-dd',
                todayHighlight:true
            });
            $('#end_date').datepicker({
                format:'yyyy-mm-dd',
                todayHighlight:true
            });
        });
    </script>
@endsection
