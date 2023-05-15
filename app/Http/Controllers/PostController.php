<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $post = DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select(
                    [
                        '*',
                        'users.id as id_user',
                        'users.name as user_name',
                        'posts.id as post_id',
                        'posts.created_at as post_created_at',
                        'posts.updated_at as post_updated_at',
                        'categories.id as category_id',
                        'categories.name as category_name',
                    ]
                )
                ->paginate(25);

            return view("posts.index", ['data' => $post]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function listCategory($id)
    {
        try {
            $category = Category::find($id);
            $post = Post::join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select(
                    [
                        '*',
                        'users.id as id_user',
                        'users.name as user_name',
                        'posts.id as post_id',
                        'posts.created_at as post_created_at',
                        'posts.updated_at as post_updated_at',
                        'categories.id as category_id',
                        'categories.name as category_name',
                    ]
                )->where("category_id", $id)
                ->paginate(25);

            return view("posts.index", ['data' => $post, 'category' => $category]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::whereNotNull("parent_id")->get();
            return view('posts.form_create', ['categories' => $categories]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $post = new Post();
        $post->title =  $request->title;
        $post->hide =  $request->hide;
        $post->content =  $request->content;
        $post->sort =  $request->sort;
        $post->category_id =  $request->category;
        $post->user_id = Auth::user()->id;
        $post->slug =  $request->slug;
        $post->views =  0;
        $post->description = $request->description;
        $post->save();

        $postTagIds = $request->tags;
        $post->tags()->sync($postTagIds);
        return redirect(route('posts.list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $post = Post::find($id);
            $categories = Category::whereNotNull("parent_id")->get();

            // $post = $this->getPostByID($id); 
            return view('posts.form_edit', [
                'data' => $post,
                'categories' => $categories,


            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'hide' => 'required',
            'description' => 'required|max:355',
            'content' => 'required|min:355',
            'category' => 'required|integer',
            'sort' => 'integer',
        ]);


        $post =   Post::find($id);
        $post->title =  $request->title;
        $post->hide =  $request->hide;
        $post->content =  $request->content;
        $post->sort =  $request->sort;
        $post->category_id =  $request->category;
        $post->slug =  $request->slug;
        $post->description = $request->description;
        $post->save();

        $postTagIds = $request->tags;
        $post->tags()->sync($postTagIds);
        return redirect()->route('posts.list')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        try {

            DB::table('posts')->where("id", $id)->delete();
            $data = [
                'message' => 'Xoá thành công!',
                'error_code' => 0
            ];
            return response($data, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }


    public function getPostByID($id)
    {
        try {
            return DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select(
                    [
                        '*',
                        'users.id as id_user',
                        'users.name as user_name',
                        'posts.id as post_id',
                        'posts.slug as post_slug',
                        'posts.hide  as post_hide',
                        'posts.sort  as post_sort',
                        'posts.created_at as post_created_at',
                        'posts.updated_at as post_updated_at',
                        'categories.id as category_id',
                        'categories.name as category_name',
                    ]
                )->where("posts.id", $id)
                ->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
