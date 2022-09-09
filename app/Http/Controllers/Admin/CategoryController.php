<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = Category::query()->paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validDate($request);
        $category = new Category();
        $newTitleCategory = $request->get('title');
        $category->title = $newTitleCategory;
        $category->save();
        $request->session()->flash('status', 'New Category' . $newTitleCategory . " - created!");
        return redirect()->route('categories.create');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = Category::query()->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function update(Request $request, $id)
    {
        $category = Category::query()->find($id);
        $titleCategory = $request->get('title');
        if($category->title !== $titleCategory) {
            $this->validDate($request);
            $category->title = $titleCategory;
            $category->slug = null;
            $category->save();
            $request->session()->flash('status', 'The Category' . $titleCategory . " - updated!");
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $category = Category::query()->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {

        $category = Category::query()->find($id);
        if($category) {
            $statusMessage = 'The Category "' . $category->title .'" delete!';
            $category->delete();
            //Category::destroy($id);

        } else {
            $statusMessage = 'Category not found!!';
        }
        return redirect()->route('categories.index')->with('status', $statusMessage);
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
