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
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub-Title</label>
                        <input type="text" name="sub_title" placeholder="Enter post sub title" class="form-control">
                        @error('sub_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control my-editor" name="description" placeholder="Enter post description">

                        </textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="topic">Topics</label>
                        @foreach ($articles as $article)
                            {{ $article->title }}
                            <input type="checkbox" value="{{ $article->id }}" class="mr-2" name="article[]">
                        @endforeach
                        @error('article')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group ">
                                <span class="input-group-btn">
                                    <a data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="image[]">
                                @error('profile_pic')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group ">
                                <span class="input-group-btn">
                                    <a data-input="thumbnail2" data-preview="holder2" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail2" class="form-control" type="text" name="image[]">
                                @error('profile_pic')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <input type="submit" value="Create" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>
@endsection
