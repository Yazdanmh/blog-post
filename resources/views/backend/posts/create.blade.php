@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Create Post</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Enter post title" class="form-control">
                        @error('title')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub-Title</label>
                        <input type="text" name="sub_title" placeholder="Enter post sub title" class="form-control">
                        @error('sub_title')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control my-editor" name="description" placeholder="Enter post description">

                        </textarea>
                        @error('description')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection