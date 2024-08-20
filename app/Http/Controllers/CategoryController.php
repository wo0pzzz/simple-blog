<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::all()->sortBy('asc');

        return view('category.index', compact('categories'));
    }

    public function posts($category_id): View
    {
        $category = Category::find($category_id);
        $posts = [];

        if ($category) {
            $posts = $category->posts;
        }

        return view('category.posts', compact('posts', 'category'));
    }

    public function create(): View
    {
        return view('category.create', []);
    }

    public function store(Request $request): RedirectResponse
    {
        $data['title'] = $request->input(['title']);

        $validate = Validator::make($data, [
            'title' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->route('category.add')
                ->with('error', 'Category not created.');
        }

        $post = Category::create($data);

        return redirect()->route('category.index', $post->id)
            ->with('success', 'Category created successfully.');
    }
}
