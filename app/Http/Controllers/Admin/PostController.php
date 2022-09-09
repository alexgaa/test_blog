<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::query()->with('category', 'tag')->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories =Category::query()->pluck('title', 'id');
        $tags = Tag::query()->pluck('title', 'id');
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $filePath='';

        if($request->hasFile('thumbnail')) {
            $folderName = date('Y-m-d');
            $filePath = $request
                ->file('thumbnail')
                ->storeAs(
                    "images/" . $folderName,
                    $request->file('thumbnail')->getClientOriginalName()
                );
        }

        $this->validDate($request);
        $post = new Post();
        $newTitlePost = $request->get('title');
        $post->title = $newTitlePost;
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        $post->category_id = $request->get('category_id');
        $post->thumbnail = $filePath;
        $post->save();
        $post->tag()->sync($request->get('tags'));


        $request->session()->flash('status', 'New Post' . $newTitlePost . " - created!");
        return redirect()->route('posts.create');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $post = Post::query()->find($id);
        $categories =Category::query()->pluck('title', 'id');
        $tags = Tag::query()->pluck('title', 'id');
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $filePath='';
        //dd($request->all());
        $this->validDate($request);

        $post = Post::query()->find($id);

        if($request->hasFile('thumbnail')) {
            Storage::delete($post->thumbnail);
            $folderName = date('Y-m-d');
            $filePath = $request
                ->file('thumbnail')
                ->storeAs(
                    "images/" . $folderName,
                    $request->file('thumbnail')->getClientOriginalName()
                );
        }

        $newTitlePost = $request->get('title');
        $post->title = $newTitlePost;
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        $post->category_id = $request->get('category_id');
        if($filePath !== ''){
            $post->thumbnail = $filePath;
        }

        $post->save();
        $post->tag()->sync($request->get('tags'));

        $request->session()->flash('status', 'Post "' . $newTitlePost . '" - updated!');

        return redirect()->route('posts.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $post = Post::query()->find($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $statusMessage = 'Post not found!!';
        $post = Post::query()->find($id);

        if($post) {
            $statusMessage = 'The Post "' . $post->title .'" delete!';
            Storage::delete($post->thumbnail);
            $post->delete();
            $post->tag()->sync([]);

        }
        return redirect()->route('posts.index')->with('status', $statusMessage);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function validDate(Request $request): void
    {
        $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' =>'nullable'
        ]);
    }
}
