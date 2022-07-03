<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreTextPostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
//use Illuminate\Http\Client\Request;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Posts/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    public function storeText(StoreTextPostRequest $request)
    {
        Post::query()->create($request->validated());
        return redirect()->back();
    }

    public function storeMedia(StoreMediaPostRequest $request)
    {

        $image_path = '';

//            dd($request->media->extension());
        if ($request->hasFile('media')) {
            $image_path = $request->file('media')->store('media', 'public');
            if($request->media->extension() === 'mp4'){
                Post::create([
                    'video' => $image_path,
                ]);
            }else {
                Post::create([
                    'image' => $image_path,
                ]);
            }

        }




        return \redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Inertia\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    public function search(Request $request){
        return User::query()->where('username', 'LIKE', "%$request->term%")->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function likeUnlike(Request $request, Post $post)
    {
        $request->user()->toggleLike($post);
        return redirect()->back();
    }
}
