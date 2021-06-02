<?php

namespace App\Http\Controllers;

use App\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::where('is_active', 1)
            ->where('end_date', '>=', date('Y-m-d'));

        if (auth()->check() && auth()->user()->role == 'user') {

            $blogs->where('user_id',  auth()->id());
        }

        $blogs = $blogs->paginate(10);

        return view('home', \compact('blogs'));
    }
}
