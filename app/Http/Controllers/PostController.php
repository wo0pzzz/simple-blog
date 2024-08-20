<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    public function index($id): View
    {
        $post = Post::find($id);

        if (!$post) {
            $error['code'] = 404;
            $error['message'] = 'Not found';
            return view('error', compact('error'));
        }

        $comments = $post->comments;

        return view('post.index', [
            'post' => $post,
            'categories' => $post->categories,
            'user' => Auth::user(),
            'comments' => $comments
        ]);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('post.create', compact(['categories']));
    }

    public function store(Request $request): RedirectResponse
    {
        $data['title'] = $request->input(['title']);
        $data['content'] = $request->input(['content']);
        $data['category'] = $request->input(['category']);
        $data['author_id'] = Auth::user()->id;

        $validate = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        if ($validate->fails()) {
            $error_msg = $validate->messages()->all();
//            var_dump($error_msg);
//            die();
            return redirect()->route('post.add')
                ->with('error', 'Post not created.')
                ->withErrors($error_msg)
                ->withInput($request->input());
        }

        $post = Post::create($data);
        $post->categories()->attach($data['category']);

        return redirect()->route('post.index', $post->id)
            ->with('success', 'Post created successfully.');
    }

    public function edit($id): View
    {
        $post = Post::find($id);
        $categories = Category::all();

        if ($post && $post->author_id == Auth::user()->id) {
            $post_categories_arr = [];
            foreach ($post->categories as $post_cat) {
                $post_categories_arr[] = $post_cat->id;
            }
            return view('post.edit', compact(['post', 'categories', 'post_categories_arr']));
        }
        return redirect()->route('dashboard');
    }

    public function search(Request $request): View
    {
        $user = Auth::user();
        $all_posts = Post::where('title', 'LIKE', '%'.$request->input('search').'%')
            ->orWhere('content', 'LIKE', '%'.$request->input('search').'%')
            ->get();

        return view('dashboard', compact('all_posts', 'user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $post = Post::find($request->input(['post_id']));

        if ($post && $post->author_id == Auth::user()->id) {
            $data['title'] = $request->input(['title']);
            $data['content'] = $request->input(['content']);
            $data['category'] = $request->input(['category']);

            $validate = Validator::make($data, [
                'title' => 'required',
                'content' => 'required',
                'category' => 'required',
            ]);

            if ($validate->fails()) {
                return redirect()->route('post.edit', $post->id)
                    ->with('error', 'Post not updated.');
            }

            $post->update([
                'title' => $data['title'],
                'content' => $data['content']
            ]);

            $categories = [];
            foreach ($data['category'] as $cat_id) {
                $categories[] = $cat_id;
            }

            $post->categories()->sync($categories);

            return redirect()->route('post.index', $post->id)
                ->with('success', 'Post updated successfully.');
        }
        return redirect()->route('dashboard');
    }

    public function destroy($id): RedirectResponse
    {
        $post = Post::find($id);

        if ($post && $post->author_id == Auth::user()->id) {
            $post->delete();

            return redirect()->route('dashboard', $post->post_id)
                ->with('success', 'Post deleted successfully');
        }

        return redirect()->route('post.index', $post->id)
            ->with('error', 'Post not deleted.');
    }
}
