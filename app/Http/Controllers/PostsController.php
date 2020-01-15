<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\User;
use App\Tags;
use App\Categories;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBlogPosts;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Resources\PostsDatatableResources;

class PostsController extends Controller
{
    public function index()
    {
        $postsAll = Posts::paginate(15);

        return view('posts.index')->with('posts', $postsAll);
    }

    public function datatables()
    {
        return Laratables::recordsOf(User::class);
    }

    public function postsTable()
    {
        return Laratables::recordsOf(Posts::class, PostsDatatableResources::class);
    }

    public function create()
    {
        $posts = new Posts();
        $categories = Categories::all();
        $postsAll = $posts->get();
        $tags = Tags::all();

        return view('posts.create')->with('posts', $postsAll)->with('categories', $categories)->with('tags', $tags);
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        $categories = Categories::all();
        $tags = Tags::all();

        return view('posts.edit', ['posts'=> $post,'categories'=>$categories, 'tags'=>$tags]);
    }

    public function update(Request $request, Posts $post)
    {
        $data = $request->only(['title', 'content', 'published_at', 'description']);


        if ($request->hasFile('image')) {
            $image = 'uploads/no-image.jpg';
            if (Storage::disk('uploads')->put($request->title.'.'.$request->file('image')->extension(), file_get_contents($request->file('image')->getRealPath()))) {
                $image = 'uploads/'.$request->title.'.'.$request->file('image')->extension();
            }
            $post->deleteImage();
            $data->image = $image;
        }

        if ($request->tags) {
            $post->tag()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'Post updated sucessfuly');

        return redirect(route('posts.index'));
    }

    public function store(StoreBlogPosts $request)
    {
        $image = 'uploads/no-image.jpg';
        if (Storage::disk('uploads')->put(md5(strtotime("now")).'.'.$request->file('image')->extension(), file_get_contents($request->file('image')->getRealPath()))) {
            $image = 'uploads/'.md5(strtotime("now")).'.'.$request->file('image')->extension();
        }

        $posts = Posts::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
            'categories_id' => $request->categories_id,
            'description' => $request->description
        ]);

        if ($request->tags) {
            $posts->tag()->attach($request->tags);
        }

        session()->flash('success', 'Posts Criado com sucesso');

        return redirect(route('posts.index'));
    }

    public function destroy($id)
    {
        $postsImage = Posts::find($id);
        $delete =  Storage::delete($postsImage->image);
        $postsImage->tag()->detach($postsImage->tag);
        $posts = Posts::find($id)->delete();

        session()->flash('success', 'Post deletado com sucesso');

        return redirect(route('posts.index'));
    }
}
