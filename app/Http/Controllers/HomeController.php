<?php

namespace App\Http\Controllers;

use App\Type;
use App\Room;
use App\Supply;
use App\Inventary;
use App\Borrow;
use App\Broken;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $types = Type::all()->count();
        $rooms = Room::all()->count();
        $supplies = Supply::all()->count();
        $users = User::all()->count();
        $borrows = Borrow::all()->count();
        $brokens = Broken::all()->count();
        $inventaries = Inventary::orderBy('register_date', 'DESC')->get();
        $invenCount = $inventaries->count();

        return view('home', compact('types', 'rooms', 'supplies', 'borrows', 'brokens', 'users', 'inventaries', 'invenCount'));
    }
}
