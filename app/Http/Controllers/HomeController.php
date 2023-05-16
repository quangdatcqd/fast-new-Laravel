<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        // thống kê tăng trưởng người dùng 
        $usersCount = User::count();
        $usersCurrentMonth = User::whereMonth('created_at', '=', $currentMonth)->count();
        $usersLastMonth = User::whereMonth('created_at', '=', $lastMonth)->count();
        $usersGrowth = "N/A";
        if ($usersLastMonth > 0) $usersGrowth = $this->calcGrowth($usersCurrentMonth, $usersLastMonth);

        // thống kê tăng trưởng bài đăng
        $postsCount = Post::count();
        $postsCurrentMonth = Post::whereMonth('created_at', '=', $currentMonth)->count();
        $postsLastMonth = Post::whereMonth('created_at', '=', $lastMonth)->count();
        $postsGrowth = "N/A";
        if ($postsLastMonth > 0) $postsGrowth = $this->calcGrowth($postsCurrentMonth, $postsLastMonth);



        return view('home', compact('usersCount', 'usersGrowth', 'postsCount', 'postsGrowth'));
    }
    public function calcGrowth($current, $last)
    {
        return (($current - $last) / $last) * 100;
    }
}
