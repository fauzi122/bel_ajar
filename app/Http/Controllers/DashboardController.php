<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $jmlpetugas = User::count();
        $jmlsiswa = Siswa::count();
        $jmlkelas = Kelas::count();
        $jmlspp = Spp::count();
        $jmlpembayarann = Pembayaran::count();
        $data_spp = Spp::with(['pembayaran', 'siswa'])->get();
        return view('admin.dashboard.index',[
           'title' => "Dashboard",
           'petugas' => $jmlpetugas,
           'siswa' => $jmlsiswa,
           'kelas' => $jmlkelas,
           'spp' => $jmlspp,
           'pembayaran' => $jmlpembayarann,
           'dataSpp' => $data_spp
        ]);
    }
}
