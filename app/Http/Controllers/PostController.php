<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCategory;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        $categories = PostCategory::all();

        if (request()->category) {
            $category = request()->category;
            $posts    = Post::where('category_id', $category)->latest()->paginate(10);
        }

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->has('thumbnail')) {
            $data['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'posts');
        }

        $post = auth()->user()->posts()->create($data);

        session()->flash('success', 'Post created');

        return redirect($post->permalink);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->views()->create();
        $related = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(6)->get();
        $recent = Post::latest()->take(6)->get();
        return view('posts.show', compact('post', 'related', 'recent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = PostCategory::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validated();

        if ($request->has('thumbnail')) {
            Storage::delete($post->thumbnail); //delete thumbnail to avoid duplication
            $data['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'posts');
        }

        $post->update($data);

        session()->flash('success', 'Post Updated');

        return redirect($post->permalink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->votes()->delete();
        $post->views()->delete();
        $post->delete();

        session()->flash('success', 'Post deleted');

        return redirect(route('home'));
    }

    public function getComments(Post $post)
    {
        return $post->comments()->latest()->paginate(10);
    }
}
