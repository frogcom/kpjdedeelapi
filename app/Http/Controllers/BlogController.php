<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(5);

        return view('blogs.index', compact('blogs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        return [
            "status" => 1,
            "data" => $blogs
        ];
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        // Blog::create($request->all());
        $blog = Blog::create($request->all());

        return redirect()->route('blogs.index')
        ->with('success', 'blog created successfully.');

        return [
            "status" => 1,
            "data" => $blog
        ];
    }

    /**
     * Display the specified resource.
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
        return view('blogs.show', compact('blog'));
        return [
            "status" => 1,
            "data" => $blog
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog->update($request->all());

        return redirect()->route('blogs.index')
        ->with('success', 'blog updated successfully');
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //

        $blog->delete();


        return redirect()->route('blogs.index')
        ->with('success', 'blog deleted successfully');

        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog deleted successfully"
        ];
    }
}
