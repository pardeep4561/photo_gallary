<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select('id', 'name')->get();


        $photos = Photo::query();



        $photos = Photo::with([
            'user:id,name',
            'category:id,name'
        ]);


        if ($request->category_id && $request->category_id != 'all') {
            $photos->where('category_id', $request->category_id);
        }

        
        return inertia('photos/Index', [
            'photos' => $photos->paginate(4),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'file_name' => 'required',
        ]);

        $create = $request->only('name', 'category_id');

        $create['user_id'] = Auth::id();
        $create['file_name'] = Auth::id() . "_" . time() . "." . $request->file_name->extension();

        $request->file_name->move(public_path("images/photos/"), $create['file_name']);

        $created = Photo::create($create);

        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $photo->load([
            'user:id,name',
            'category:id,name'
        ]);

        return inertia('photos/Show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $photo->update($request->only('name','category_id'));
        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
