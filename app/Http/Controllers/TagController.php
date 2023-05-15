<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(25);
        return  view('tags.index', ['data' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'slug' => 'required|max:20',
        ]);
        $result = new Tag();
        $result->title = $request->name;
        $result->slug = $request->slug;
        $result->save();
        return redirect()->route('tags.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.form_edit', ['data' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'slug' => 'required|max:20',
        ]);
        $result =  Tag::find($id);
        $result->title = $request->name;
        $result->slug = $request->slug;
        $result->save();
        return redirect()->route('tags.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Tag::destroy($id);
        $data = [
            'message' => 'Xoá thành công!',
            'error_code' => 0
        ];
        return response($data, 200);
    }


    public function search(Request $request)
    {
        $tags = Tag::where("title", "like", "%" . $request->q . "%")->paginate(5);
        return  json_encode($tags);
    }
}
