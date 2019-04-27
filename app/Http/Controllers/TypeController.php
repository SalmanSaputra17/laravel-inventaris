<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.create');
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
            'type_name' => 'required|string|max:100',
            'explanation' => 'required|string|max:255'
        ]);

        Type::create([
            'type_name' => request('type_name'),
            'type_code' => $this->generateCode(10),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('type.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type->update([
            'type_name' => request('type_name'),
            'explanation' => request('explanation'),
        ]);

        return redirect()->route('type.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('type.index')->with('success', 'Data berhasil diubah.');
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
