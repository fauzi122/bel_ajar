<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy("created_at", "desc")
        ->orderBy("updated_at","desc")
        ->get();
        return view('admin.kelas.index',[
            'title' => 'Kelas',
            'name' => 'Data Kelas',
            'items' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create',[
            'title' => 'Kelas',
            'name' => 'Tambah Data Kelas',
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
            'nama_kelas' => ['required'],
            'kompetensi_keahlian' => ['required']
        ]);

        if($validateData){
            $check = Kelas::create($validateData);
        }
        if($check){
            return redirect(@route('kelas.index'))->with('success', 'Data berhasil di tambah');
        }
        return back()->with('error', 'Data gagal di tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        return response()->json($kelas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validateData = $request->validate([
            'nama_kelas' => ['required'],
            'kompetensi_keahlian' => ['required']
        ]);

        if($validateData){
            $check = $kelas->update($validateData);
        }
        if($check){
            return redirect(@route('kelas.index'))->with('success', 'Data berhasil di ubah');
        }
        return back()->with('error', 'Data gagal di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $check = $kelas->delete();
        if($check){
            return back()->with('success', 'Data berhasil di hapus');
        }
        return back()->with('error', 'Data gagal di hapus');
     }
}
