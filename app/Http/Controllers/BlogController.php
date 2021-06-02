<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogUpdateRequest;

class BlogController extends Controller
{

    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCreateRequest $request)
    {
        $fileName = '';
        if ($file = $request->file('image')) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/blogs/'), $fileName);
        }

        Blog::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active,
            'image' => url('uploads/blogs/' . $fileName),
        ]);

        return redirect('/')->with('success', 'Blog created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        abort_if(auth()->user()->role != 'admin' && auth()->id() != $blog->user_id, 401);

        return view('blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        abort_if(auth()->user()->role != 'admin' && auth()->id() != $blog->user_id, 401);

        $fileName = '';
        if ($file = $request->file('image')) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/blogs/'), $fileName);
            $blog->update([
                'image' => url('uploads/blogs/' . $fileName),
            ]);
        }

        $blog->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active,
        ]);

        return redirect('/')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        abort_if(auth()->user()->role != 'admin' && auth()->id() != $blog->user_id, 401);

        $blog->delete();
        return redirect('/')->with('success', 'Blog deleted successfully!');
    }
}
