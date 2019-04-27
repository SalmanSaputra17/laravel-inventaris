<?php

namespace App\Http\Controllers;

use App\Broken;
use App\Inventary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BrokenController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brokens = DB::table('brokens')
        ->join('inventaries', 'inventaries.id', '=', 'brokens.inventary_id')
        ->select('inventaries.inventary_code', 'inventaries.name', 'inventaries.register_date', 'brokens.id', 'brokens.mount')
        ->orderBy('brokens.created_at', 'DESC')
        ->get();

        return view('broken.index', compact('brokens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Broken  $broken
     * @return \Illuminate\Http\Response
     */
    public function show(Broken $broken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Broken  $broken
     * @return \Illuminate\Http\Response
     */
    public function edit(Broken $broken)
    {
        return view('broken.edit', compact('broken'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Broken  $broken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Broken $broken)
    {
        $mount = request('mount');

        if ($mount <= $broken->mount) {
            $invetary = Inventary::where('id', $broken->inventary_id)->first();
            $invetary->update([
                'mount' => $invetary->mount + $mount,
            ]);

            $broken->update([
                'mount' => $broken->mount - $mount,
            ]);

            if ($broken->mount == 0) {
                $broken->delete();
            }

            return redirect()->route('broken.index')->with('success', 'Data berhasil diperbarui.');
        }else{
            return redirect()->route('broken.index')->with('danger', 'Jumlah pengembalian melebihi jumlah barang rusak.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Broken  $broken
     * @return \Illuminate\Http\Response
     */
    public function destroy(Broken $broken)
    {
        $broken->delete();
        return redirect()->route('broken.index')->with('success', 'Data berhasil dihapus.');
    }
}
