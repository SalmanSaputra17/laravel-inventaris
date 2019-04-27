<?php

namespace App\Http\Controllers;

use App\Detail_borrow;
use App\Inventary;
use App\Broken;
use Illuminate\Http\Request;

class DetailBorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $ID = request('borrow_id');

        $this->validate($request, [
            'inventary_id' => 'required|integer',
            'mount' => 'required|integer',
        ]);

        $data = Detail_borrow::where([
            'borrow_id' => request('borrow_id'),
            'inventary_id' => request('inventary_id'),
        ])->first();
        $inventary = Inventary::where('id', request('inventary_id'))->first();

        // return dd($data->id);

        if ($data) {

            if (request('mount') > $inventary->mount) {
                return redirect()->route('borrow.show', $ID)->with('warning', 'Jumlah pinjam melebihi stok, stok barang: '.$inventary->mount);
            }else{
                $data->update([
                    'mount' => $data->mount + request('mount'),
                ]);

                return redirect()->route('borrow.show', $ID)->with('success', 'Data berhasil disimpan.');
            } 

        }else{

            if (request('mount') > $inventary->mount) {
                return redirect()->route('borrow.show', $ID)->with('warning', 'Jumlah pinjam melebihi stok, stok barang: '.$inventary->mount);
            }else{
                Detail_borrow::create([
                    'borrow_id' => request('borrow_id'),
                    'inventary_id' => request('inventary_id'),
                    'user_id' => auth()->user()->id,
                    'mount' => request('mount'),
                ]);

                return redirect()->route('borrow.show', $ID)->with('success', 'Data berhasil disimpan.');    
            } 
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detail_borrow  $detail_borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Detail_borrow $detail_borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detail_borrow  $detail_borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail_borrow $detail_borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detail_borrow  $detail_borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail_borrow $detail_borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detail_borrow  $detail_borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Detail_borrow $detail_borrow)
    {
        $ID = request('borrow_id');
        $detail_borrow->delete();

        return redirect()->route('borrow.show', $ID)->with('success', 'Data berhasil dihapus.');
    }

    public function return(Request $request, Detail_borrow $detail_borrow)
    {
        $mount = request('mount');
        $brokenMount = request('broken_mount');
        $ID = request('borrow_id');

        if ($brokenMount == null) {
            $inven = Inventary::where('id', $detail_borrow->inventary_id)->first();
            $inven->update([
                'mount' => $inven->mount + $mount,
            ]);

            $detail_borrow->update([
                'mount' => $detail_borrow->mount - $mount,
            ]);

            if ($detail_borrow->mount == 0) {
                $detail_borrow->delete();
            }

            return redirect()->route('borrow.show', $ID)->with('success', 'Data berhasil diperbarui.');
        }elseif ($brokenMount != null) {
            $inven = Inventary::where('id', $detail_borrow->inventary_id)->first();
            if (($mount + $brokenMount) <= $detail_borrow->mount) {
                $inven->update([
                    'mount' => $inven->mount + $mount,
                ]);

                $detail_borrow->update([
                    'mount' => $detail_borrow->mount - ($mount + $brokenMount),
                ]);

                if ($detail_borrow->mount == 0) {
                    $detail_borrow->delete();
                }
                
                Broken::create([
                    'inventary_id' => $inven->id,
                    'mount' => $brokenMount,
                ]);

                $detail_borrow->delete();
                
                return redirect()->route('borrow.show', $ID)->with('success', 'Data berhasil diperbarui.');   
            }
        }
    }

}
