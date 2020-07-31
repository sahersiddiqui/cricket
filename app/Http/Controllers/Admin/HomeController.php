<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data['teams'] = Team::count();
        $data['players'] = Player::count();
        $data['matches'] = Player::count();
        return view('admin.home')->with($data);
    }
}
