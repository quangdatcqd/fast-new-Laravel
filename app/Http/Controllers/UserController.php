<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

            $data_status = DB::table('status_account')->get();
            $users = DB::table('users')
                ->join('status_account', 'users.status', '=', 'status_account.id')
                ->select(['*', 'users.id as id_user', 'status_account.name as status', 'status_account.id as id_tatus', 'users.name as name'])
                ->paginate(25);
            return view("users.index", ['data' => $users, 'data_status' => $data_status]);
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
            $status = DB::table('status_account')->get();
            return view('users.form_edit', ['data' => $status, 'title' => 'Tạo mới tài khoản']);
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
        //
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
        //
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
        try {
            $result = DB::table('users')->where("id", $id)->update([
                'status' => $request->status,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            $data = [
                'data' => $result,
                'message' => 'Cập nhật thành công!',
                'error_code' => 0
            ];
            return response($data, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
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

            DB::table('users')->where("id", $id)->delete();
            $data = [
                'message' => 'Xoá thành công!',
                'error_code' => 0
            ];
            return response($data, 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
}
