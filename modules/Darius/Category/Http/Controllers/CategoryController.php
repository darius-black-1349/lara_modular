<?php

namespace Darius\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Darius\Category\Http\Requests\CategoryRequest;
use Darius\Category\Models\Category;
use Darius\Category\Repositories\CategoryRepo;
use Darius\Common\Responses\AjaxResponses;

class CategoryController extends Controller
{

    protected $repoCategory;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repoCategory = $categoryRepo;
    }

    public function index()
    {
        $this->authorize('manage', Category::class);
        $categories = $this->repoCategory->all();
        return view('Categories::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('manage', Category::class);
        $this->repoCategory->store($request);
        return back();
    }

    public function edit($categoryId)
    {
        $this->authorize('manage', Category::class);
        $category = $this->repoCategory->findById($categoryId);
        $categories = $this->repoCategory->allExceptById($categoryId);
        return view('Categories::edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, $categoryId)
    {
        $this->authorize('manage', Category::class);
        $this->repoCategory->update($categoryId, $request);
        return back();
    }

    public function destroy($categoryId)
    {
        $this->authorize('manage', Category::class);
        $this->repoCategory->delete($categoryId);
        return AjaxResponses::SuccessResponse();
    }
}
