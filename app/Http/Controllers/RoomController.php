<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view('room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.create');
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
            'room_name' => 'required|string|max:100',
            'explanation' => 'required|string|max:255'
        ]);

        Room::create([
            'room_name' => request('room_name'),
            'room_code' => $this->generateCode(10),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('room.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->update([
            'room_name' => request('room_name'),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('room.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('room.index')->with('success', 'Data berhasil dihapus.');
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
