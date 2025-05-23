<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use index;
use Alert;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Kwitansi;
use App\Helpers\RECTY;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $month;

     public function __construct()
     {
         $this->month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
     }



     public function tunggakan()
     {
        $items =  Kelas::all();
         return view('admin.laporan.tunggukanKelas', [
             'title' => 'Laporan',
             'name' => 'Laporan bulan ini ',
             'dataMonth' => $this->month,
             'items' => $items
         ]);
     }

     public function cetakTunggakan(Kelas $kelas)
    {
        $format_tanggal = Carbon::parse(date('Y-m-d') )->format('d-m-Y');
        return view('admin.laporan.cetak.cetakTunggakan', [
            'RekapKelas' => $kelas,
            'dataMonth' => $this->month,
            'tanggal' => $format_tanggal
        ]);
    }

     public function laporan()
     {
         return view('admin.laporan.rekapKelas', [
             'title' => 'Laporan',
             'name' => 'Laporan bulan ini ',
             'items' => Kelas::all(),
             'dataMonth' => $this->month,
         ]);
     }

     public function rekapLaporan(Kelas $kelas)
    {
        $format_tanggal = Carbon::parse(date('Y-m-d') )->format('d-m-Y');
        return view('admin.laporan.cetak.cetakRekap', [
            'RekapKelas' => $kelas,
            'dataMonth' => $this->month,
            'tanggal' => $format_tanggal
        ]);
    }

     public function kwitansi(Kwitansi $kwitansi)
     {

         $nominal = $kwitansi->siswa->spp->nominal;
         $total_bulan = count($kwitansi->siswa->pembayaran);
         $total =  $nominal * $total_bulan;
         $terbilang_result = RECTY::toTerbilang($total);
         $format_tanggal = Carbon::parse($kwitansi->tanggal)->format('d-m-Y');
         return view('admin.kwitansi_pembayaran.index', [
             'siswa' => $kwitansi->siswa,
             'pembayaran' => $total,
             'terbilang' => $terbilang_result,
             'kwitansi' => $kwitansi,
             'tanggal' => $format_tanggal,
             'kelas' => $kwitansi->siswa->kelas,
         ]);
     }

    public function transaksi()
    {
        $siswas = Siswa::orderBy("created_at", "desc")
        ->orderBy("updated_at", "desc")
        ->get();
        return view('admin.Entry_pembayaran.transaksi',[
                'title' => 'Pembayaran',
                'name' => 'Transaksi Pembayaran',
                'transaksi' => $siswas,
                'dataMonth' => $this->month,
        ]);
    }

    public function index()
    {
        // Perform a join between Kwitansi and Siswa tables based on nis
        $items = Kwitansi::join('siswas', 'kwitansis.nis', '=', 'siswas.nis')
            ->orderBy('kwitansis.created_at', 'desc')
            ->orderBy('kwitansis.updated_at', 'desc')
            ->select('kwitansis.*', 'siswas.nama','siswas.nisn') // Select the desired columns from both tables
            ->get();
    
        return view('admin.Entry_pembayaran.index', [
            'title' => 'Pembayaran',
            'name' => 'Kelola History Pembayaran',
            'items' => $items,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        $bulan = Pembayaran::all();

        return view('admin.Entry_Pembayaran.create',[
            'title' => 'Pembayaran',
            'name' => 'Transaksi Pembayaran',
            'dataSpp' => $spp,
            'level' => auth()->user(),
            'pembayaran' => $bulan,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'dataMonth' => $this->month,
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
        $idPetugas = User::pluck('id');
        $idSpp = Spp::pluck('id');

        $validateData = $request->validate([
            'id_petugas' => ['required', Rule::in($idPetugas)],
            'id_spp' => ['required', Rule::in($idSpp)],
            'nisn' => ['required', 'max:10'],
            'tgl_bayar' => ['required', 'date'],
            'bulan_dibayar' => ['required', 'max:12', 'array'],
            'level' => ['required',],
            'jumlah_bayar' => ['required'],
        ]);

        $existingPayments = Pembayaran::where('nisn', $validateData['nisn'])
            ->whereIn('bulan_dibayar', $validateData['bulan_dibayar'])
            ->get();

        if ($existingPayments->isNotEmpty()) {
         Alert::error('Cek bulan,bulan telah di bayar!');
            return back();
        }

        try {

            foreach ($validateData['bulan_dibayar'] as $bulan) {
                $pembayaran = Pembayaran::create([
                    'id_petugas' => $validateData['id_petugas'],
                    'id_spp' => $validateData['id_spp'],
                    'nisn' => $validateData['nisn'],
                    'tgl_bayar' => $validateData['tgl_bayar'],
                    'bulan_dibayar' => $bulan,
                    'level' => $validateData['level'],
                    'jumlah_bayar' => $validateData['jumlah_bayar'],
                ]);
            }

            if ($pembayaran) {
                $siswa = Siswa::query()
                    ->where('nisn', $request->nisn)
                    ->firstOrFail();
                $bulan = $request->bulan_dibayar;
                $kwitansi = Kwitansi::query()
                    ->where('nis', $siswa->nis)->first();

                if ($kwitansi) {
                    $bulan_baru = array_merge(explode(",", $kwitansi->bulan), $bulan);
                    $bulan_baru = array_unique($bulan_baru);
                    sort($bulan_baru);

                    $kwitansi->update([
                        'tanggal' => now()->format('Y-m-d'),
                        'bulan' => implode(",", $bulan_baru),
                    ]);
                } else {
                    Kwitansi::create([
                        'nis' => $siswa->nis,
                        'tanggal' => now()->format('Y-m-d'),
                        'bulan' => implode(",", $bulan),
                    ]);
                }
            }
            return redirect(route('pembayaran.transaksi'))->with('success', 'Data berhasil di tambah kan');
        } catch (Exception $e) {
            return back()->with('error', 'Data gagal di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $check = $pembayaran->delete();
            if($check){
                return back()->with('success', 'Data berhasil di hapus');
            }
            return back()->with('error', 'Data gagal di hapus');
    }
}
