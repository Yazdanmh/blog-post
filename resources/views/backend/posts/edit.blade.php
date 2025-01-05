@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Edit Post</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ $post->title }}" placeholder="Enter post title"
                            class="form-control">
                        @error('title')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub-Title</label>
                        <input type="text" name="sub_title" value="{{ $post->sub_title }}"
                            placeholder="Enter post sub title" class="form-control">
                        @error('sub_title')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control my-editor" name="description" placeholder="Enter post description">
                            {{ $post->description }}
                        </textarea>
                        @error('description')
                            <p class="text-denger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="topic">Topics</label>
                        @foreach ($articles as $article)
                            {{ $article->title }}
                            <input type="checkbox" value="{{ $article->id }}"
                                @foreach ($post->articles as $postArticle)
                                    @if ($postArticle->id == $article->id)
                                        checked
                                    @endif @endforeach
                                class="mr-2" name="article[]">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Changes" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
