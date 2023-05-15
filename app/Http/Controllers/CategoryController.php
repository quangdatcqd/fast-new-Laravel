<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        try {
            $categories = Category::withCount('post')->paginate(25);

            $parents = Category::whereIn('id', $categories->pluck('parent_id'))->get();
            return view("categories.index", ['data' => $categories, 'parents' => $parents]);
        } catch (\Throwable $th) {
        }
    }


    public function create()
    {
        try {

            $categories = Category::whereNull("parent_id")->get();
            return view('categories.form_create', ['data' => $categories]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
        ]);
        //code... 
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->save();
        // return $result;
        return redirect(route('categories.list'));
    }

    public function show($id)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::find($id);
            $data = Category::whereNull("parent_id")->get();

            return view('categories.form_edit', [
                'data' => $data,
                'category' => $category,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
        ]);

        //code... 
        $category =   Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->save();
        // return $result;
        return redirect(route('categories.list'))->with('success', 'Cập nhật thành công!');;
        // return $result;
        return redirect()->route('posts.list')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        try {

            Category::destroy($id);
            $data = [
                'message' => 'Xoá thành công!',
                'error_code' => 0
            ];
            return response($data, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    public  function reorder()
    {
        $result = Category::orderBy("sort", "asc")->get();

        return view("categories.reorder", ['data' => $result]);
    }


    public function updateReorder(Request $request)
    {
        try {
            $data = json_decode($request->data, true);

            if (count($data) > 1) {
                # code...

                foreach ($data as $key => $value) {
                    if ($value["item_id"] != null) {
                        $category = Category::find($value["item_id"]);
                        $category->parent_id = $value["parent_id"];
                        $category->sort = $key;
                        $category->save();
                    }
                }
            }
            $dataResponse = [
                'message' => 'Cập nhật thành công!',
                'error_code' => 0
            ];
            return response($dataResponse, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    public function getPostByID($id)
    {
        try {
            return DB::table('posts')
                ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select(
                    [
                        '*',
                        'users.id as id_user',
                        'users.name as user_name',
                        'posts.id as post_id',
                        'posts.sort as post_sort',
                        'posts.hide as post_hide',
                        'posts.created_at as post_created_at',
                        'posts.updated_at as post_updated_at',
                        'subcategories.id as subcategory_id',
                        'subcategories.name as subcategory_name',

                    ]
                )->where("posts.id", $id)
                ->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
