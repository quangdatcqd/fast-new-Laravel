<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $users = User::paginate(25);
            return view("users.index", compact('users'));
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
            $roles = Role::all();
            $permissions = Permission::all();
            return view('users.form_create', compact('roles', 'permissions'));
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
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        $user->permissions()->sync($request->permission);
        return redirect()->route('users.list');
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
        try {
            $user = User::find($id);
            $roles = Role::all();
            $permissions = Permission::all();
            return view('users.form_edit', compact('roles', 'permissions', 'user'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
        $dataStore = [
            'name' => $request->name,
            'email' =>  $request->email,
            'role_id' => $request->role,
        ];
        if ($request->password != null) {
            $request->validate([
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            $dataStore["password"] = Hash::make($request->password);
        }

        $user = User::find($id);
        $user->update($dataStore);
        $user->save();

        $user->permissions()->sync($request->permission);
        return redirect()->route('users.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $data = [];
            if ($user->posts()  &&  $user->posts()->count() > 0) {
                $data = [
                    'message' => 'Người dùng có bài đăng. không thể xoá!',
                    'error_code' => 1001
                ];
                return response($data, 200);
            }
            $user->delete();
            $data = [
                'message' => 'Đã xoá thành công!',
                'error_code' => 0
            ];
            return response($data, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
}
