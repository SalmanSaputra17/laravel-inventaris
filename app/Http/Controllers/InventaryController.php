<?php

namespace App\Http\Controllers;

use App\Inventary;
use App\Type;
use App\Room;
use App\Supply;
use Illuminate\Http\Request;

class InventaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventaries = Inventary::orderBy('name')->get();
        $types = Type::all()->count();
        $rooms = Room::all()->count();
        $supplies = Supply::all()->count();

        return view('inventary.index', compact('inventaries', 'types', 'rooms', 'supplies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $rooms = Room::all();
        return view('inventary.create', compact('types', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condition = "Well";

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'mount' => 'required|integer',
            'type_id' => 'required|integer',
            'room_id' => 'required|integer',
            'register_date' => 'required|date',
            'explanation' => 'required|string|max:255',
        ]);

        Inventary::create([
            'inventary_code' => $this->generateCode(10),
            'name' => request('name'),
            'condition' => $condition,
            'mount' => request('mount'),
            'type_id' => request('type_id'),
            'room_id' => request('room_id'),
            'user_id' => auth()->user()->id,
            'register_date' => request('register_date'),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('inventary.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventary  $inventary
     * @return \Illuminate\Http\Response
     */
    public function show(Inventary $inventary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventary  $inventary
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventary $inventary)
    {
        $types = Type::all();
        $rooms = Room::all();
        return view('inventary.edit', compact('inventary', 'types', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventary  $inventary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventary $inventary)
    {
        $inventary->update([
            'name' => request('name'),
            'type_id' => request('type_id'),
            'room_id' => request('room_id'),
            'user_id' => auth()->user()->id,
            'register_date' => request('register_date'),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('inventary.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventary  $inventary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventary $inventary)
    {
        $inventary->delete();
        return redirect()->route('inventary.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Generate kode otomatis.
     */
    public function generateCode($length)
    {
        $char = 'ABCDEFGHIJKLM1234567890\;[]';
        $string = '';

        for ($i = 0; $i < $length; $i++) { 
            $tmp = rand(0, strlen($char) - 1);
            $string .= $char[$tmp]; 
        }

        return $string;
    }

}
