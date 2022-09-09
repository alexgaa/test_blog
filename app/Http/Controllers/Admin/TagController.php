<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tags = Tag::query()->paginate(5);
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validDate($request);

        $tag = new Tag();
        $tag->title = $request->get('title');
        $tag->save();

        return redirect()->route('tags.index')->with('status', "New Tag create!");
    }

    /**
     * @param $id
     * @return string
     */
    public function show($id)
    {
        return '';
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $tag = Tag::query()->find($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tagTitle = $request->get('title');
        $tag = Tag::query()->find($id);
        if($tagTitle !== $tag->title){
            $this->validDate($request);
            $tag->title = $tagTitle;
            $tag->slug = null;
            $tag->save();
            $statusMessage = "Tag " . $tagTitle .  " Updated!";

        } else {
            $statusMessage = "Tag " . $tagTitle .  " Not Updated!";
        }
        session()->flash('status' , $statusMessage );

        return redirect()->route('tags.index');

    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $tagTitle='Tag not found!!';
        $tag = Tag::query()->find($id);
        if($tag) {
            $tagTitle = "Tag '" . $tag->title . "' deleted!";
            $tag->delete();
        }


        return redirect()->route('tags.index')->with('status', $tagTitle);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function validDate(Request $request): void
    {
        $request->validate([
            'title' => 'required|unique:categories|max:255'
        ]);
    }
}
