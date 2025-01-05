<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use Str;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.posts.index')
            ->with('posts', Post::orderBy('created_at', 'DESC')->where('lang', app()->getLocale())->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create')
            ->with('articles', Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'sub_title' => 'required|max:50',
            'description' => 'required',
            'article' => 'required|array'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'lang' => app()->getLocale(),
            'profile_id' => Auth::user()->profile->id,
        ]);
        $post->articles()->attach($request->article);

        foreach ($request->image as $image) {
            $post->images()->create(['image' => $image]);
        }
        Session::flash('success', "post created successfully");
        return redirect()->route('post.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.posts.edit')
            ->with('post', $post)
            ->with('articles', Article::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:50',
            'sub_title' => 'required|max:50',
            'description' => 'required',
            'article' => 'required|array'

        ]);

        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);
        $post->lang = app()->getLocale();
        $post->save();

        $post->articles()->sync($request->article);
        Session::flash('success', "post Updated successfully");

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return "success";
    }
    public function trash()
    {
        $this->authorize('forceDelete', Post::class);
        return view('backend.posts.trash')
            ->with('posts', Post::onlyTrashed()->paginate(10));
    }
    public function delete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        if (!$post) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $post->forceDelete();
        return response()->json(['message' => 'success'], 200);
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->route('post.index');
    }
}
