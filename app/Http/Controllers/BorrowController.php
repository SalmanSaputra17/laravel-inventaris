<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Detail_borrow;
use App\Inventary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level_id == 1 || auth()->user()->level_id == 2) {
            $borrows = Borrow::all();
        } elseif (auth()->user()->level_id == 3) {
            $borrows = Borrow::where('user_id', auth()->user()->id)->get();
        }

        return view('borrow.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('borrow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = "Booking";

        $this->validate($request, [
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);
        
        Borrow::create([
            'user_id' => null,
            'borrow_date' => request('borrow_date'),
            'return_date' => request('return_date'),
            'borrow_status' => $status,
        ]);

        $ID = DB::getPdo()->lastInsertId();
        return redirect()->route('borrow.show', $ID);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        $inventaries = DB::table('inventaries')->where('mount', '>', 0)->get();
        $invenList = DB::table('detail_borrows')
        ->join('borrows', 'detail_borrows.borrow_id', '=', 'borrows.id')
        ->join('inventaries', 'detail_borrows.inventary_id', '=', 'inventaries.id')
        ->join('users', 'detail_borrows.user_id', '=', 'users.id')
        ->where('detail_borrows.borrow_id', $borrow->id)
        ->select('inventaries.name', 'inventaries.condition', 'borrows.id as borrow_id', 'detail_borrows.id', 'detail_borrows.user_id', 'detail_borrows.mount', 'users.name as username')
        ->get();

        return view('borrow.show', compact('borrow', 'inventaries', 'invenList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        return view('borrow.edit', compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        $borrow->update([
            'borrow_date' => request('borrow_date'),
            'return_date' => request('return_date'),
        ]);

        return redirect()->route('borrow.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrow.index')->with('success', 'Data berhasil dihapus.');
    }

    public function confirm(Request $request, Borrow $borrow)
    {
        $statusApproved = "Approved";
        $statusDenied = "Denied";
        $statusPostponed = "Postponed";

        $notif = "";

        if (request('confirm') == 1) {
            $borrow->update([
                'user_id' => auth()->user()->id,
                'borrow_status' => $statusApproved,
            ]); 
            
            $detail_borrow = Detail_borrow::where('borrow_id', $borrow->id)->get();
            foreach ($detail_borrow as $row) {
                $inven = Inventary::where('id', $row->inventary_id)->first();
                if ($inven->mount > 0) {
                    $inven->update([
                        'mount' => ($inven->mount - $row->mount),
                    ]);
                }else{
                    $borrow->update([
                        'borrow_status' => $statusPostponed,
                    ]);
                    $notif = "There is/are uncomplete transaction.";
                }
            }

            return redirect()->route('borrow.index')->with('success', 'Peminjaman telah disetujui. '.$notif);
        }elseif (request('confirm') == 0) {
            $borrow->update([
                'user_id' => auth()->user()->id,
                'borrow_status' => $statusDenied,
            ]);

            $detail_borrow = Detail_borrow::where('borrow_id', $borrow->id)->delete();

            return redirect()->route('borrow.index')->with('danger', 'Peminjaman tidak disetujui.');
        }
        
    }
}
