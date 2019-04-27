<?php

namespace App\Http\Controllers;

use App\Supply;
use App\Inventary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = DB::table('supplies')
        ->join('inventaries', 'inventaries.id', '=', 'supplies.inventary_id')
        ->select('inventaries.name', 'inventaries.register_date', 'supplies.id', 'supplies.mount', 'supplies.user_id')
        ->orderBy('supplies.created_at', 'DESC')
        ->get();
        
        return view('supply.index', compact('supplies'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventaries = Inventary::all();
        return view('supply.create', compact('inventaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'inventary_id' => 'required|integer',
            'mount' => 'required|integer'
        ]);

        $inventary_id = request('inventary_id');
        $mountUpdate = request('mount');

        Supply::create([
            'inventary_id' => $inventary_id,
            'user_id' => auth()->user()->id,
            'mount' => $mountUpdate,
        ]);

        $inventary = Inventary::where('id', $inventary_id)->first();
        $inventary->update([
            'mount' => $inventary->mount + $mountUpdate,
        ]);

        return redirect()->route('supply.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function show(Supply $supply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function edit(Supply $supply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supply $supply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supply $supply)
    {
        $supply->delete();
        return redirect()->route('supply.index')->with('success', 'Data berhasil dihapus.');
    }
}
