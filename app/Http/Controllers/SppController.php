<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spps = Spp::orderBy("created_at", "desc")
        ->orderBy("updated_at", "desc")
        ->get();
        return view('admin.spp.index',[
            'title' => "SPP",
            'name' => 'Data SPP',
            'items' => $spps,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spp.create',[
            'title' => 'SPP'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'level' => ['required'],
            'nominal' => ['required']
        ]);

        if($validateData){
            $check = Spp::create($validateData);
        }
        if($check){
            return redirect(@route('spp.index'))->with('success', 'Data Berhasil Di Tambah');
        }
        return back()->with('error', 'Data Gagal Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        return response()->json($spp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp $spp)
    {
        $validateData = $request->validate([
            'level' => ['required'],
            'nominal' => ['required']
        ]);

        if($validateData){
            $check = $spp->update($validateData);
        }
        if($check){
            return redirect(@route('spp.index'))->with('success', 'Data Berhasil Di Ubah');
        }
        return back()->with('error', 'Data Gagal Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $spp)
    {
        $check = $spp->delete();

        if($check){
            return back()->with('success', 'Data berhasil di hapus');
        }
        return back()->with('error', 'Data gagal di hapus');
    }
}
