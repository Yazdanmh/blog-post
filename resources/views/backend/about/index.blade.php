@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>About</h1>
            </div>
            <div class="card-body">
                <form action="{{ $about == null ? route('about.store') : route('about.update', ['about' => $about->id]) }}" method="POST">
                    @csrf
                    @if ($about != null)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Enter post title" class="form-control" value="{{ $about->title ?? '' }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub-Title</label>
                        <input type="text" name="sub_title" placeholder="Enter post sub title" class="form-control" value="{{ $about->sub_title ?? '' }}">
                        @error('sub_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control my-editor" name="description" placeholder="Enter post description">{{ $about->description ?? '' }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="{{ $about == null ? 'Create' : 'Update' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
