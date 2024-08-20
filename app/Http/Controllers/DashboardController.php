<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();
        $all_posts = Post::all()->sortBy('asc');
        $user_posts =$user->posts;

        return view('dashboard', compact('all_posts', 'user_posts', 'user'));
    }


}
