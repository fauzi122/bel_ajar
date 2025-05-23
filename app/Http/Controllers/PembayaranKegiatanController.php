<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use index;
use Alert;
use App\Models\Pembayaran;
use App\Models\pembayaran_kegiatan;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Kwitansi;
use App\Helpers\RECTY;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranKegiatanController extends Controller
{
    public $month;

    public function __construct()
    {
        $this->month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }
    public function index()
    {
       
        return view('aadmin.pembayaran_kegiatan.index');

    }


    public function ujian()
    {
        // Ambil data siswa
        $siswas = Siswa::orderBy("created_at", "desc")->orderBy("updated_at", "desc")->get();
    
        $master_biaya = DB::table('master_biayas')
                    ->where('jenis_biaya', '1')
                    ->get()
                    ->map(function ($item) {
                        $item->kategori = trim($item->kategori);
                        return $item;
                    });

                $pembayaran = DB::table('pembayaran_kegiatans')
                    ->select('nisn', 'jenis_kegiatan','created_at')
                    ->get()
                    ->map(function ($item) {
                        $item->nisn = trim((string)$item->nisn);
                        $item->jenis_kegiatan = trim($item->jenis_kegiatan);
                        return $item;
                    })
                    ->groupBy('nisn');

        return view('admin.pembayaran_kegiatan.ujian.index', compact('siswas', 'master_biaya', 'pembayaran'));
    }



    public function create(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $spp = Spp::all();

        $master_biaya = DB::table('master_biayas')
            ->where('jenis_biaya', '1')
            ->get()
            ->map(function ($item) {
                $item->kategori = trim($item->kategori);
                return $item;
            });

        $pembayaran = DB::table('pembayaran_kegiatans')
            ->select('nisn', 'jenis_kegiatan')
            ->get()
            ->map(function ($item) {
                $item->nisn = trim((string)$item->nisn);
                $item->jenis_kegiatan = trim($item->jenis_kegiatan);
                return $item;
            })
            ->groupBy('nisn');

        $master_biaya_first = DB::table('master_biayas')
            ->where('jenis_biaya', '1')
            ->first();

        return view('admin.pembayaran_kegiatan.ujian.create', compact(
            'kelas',
            'spp',
            'master_biaya',
            'master_biaya_first',
            'siswa',
            'pembayaran'
        ))->with([
            'title' => 'Pembayaran',
            'name' => 'Transaksi Pembayaran',
            'level' => auth()->user(),
            'dataMonth' => $this->month,
        ]);
    }

    public function store(Request $request)
    {
        $idPetugas = User::pluck('id');
        $idSpp = Spp::pluck('id');

        $validateData = $request->validate([
            'id_petugas' => ['required', Rule::in($idPetugas)],
            // 'id_spp' => ['required', Rule::in($idSpp)],
            'nisn' => ['required', 'max:10'],
            'tgl_bayar' => ['required', 'date'],
            'jenis_kegiatan' => ['required', 'max:12', 'array'],
            // 'level' => ['required',],
            'jumlah_bayar' => ['required'],
        ]);

        $existingPayments = pembayaran_kegiatan::where('nisn', $validateData['nisn'])
            ->whereIn('jenis_kegiatan', $validateData['jenis_kegiatan'])
            ->get();

        if ($existingPayments->isNotEmpty()) {
         Alert::error('Cek bulan,bulan telah di bayar!');
            return back();
        }

        try {

            foreach ($validateData['jenis_kegiatan'] as $bulan) {
                $pembayaran = pembayaran_kegiatan::create([
                    'id_petugas' => $validateData['id_petugas'],
                    // 'id_spp' => $validateData['id_spp'],
                    'nisn' => $validateData['nisn'],
                    'tgl_bayar' => $validateData['tgl_bayar'],
                    'jenis_kegiatan' => $bulan,
                    // 'level' => $validateData['level'],
                    'jumlah_bayar' => $validateData['jumlah_bayar'],
                ]);
            }

            if ($pembayaran) {
                $siswa = Siswa::query()
                    ->where('nisn', $request->nisn)
                    ->firstOrFail();
                $bulan = $request->jenis_kegiatan;
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
            return redirect(route('pembayaranujian.index'))->with('success', 'Data berhasil di tambah kan');
        } catch (Exception $e) {
            return back()->with('error', 'Data gagal di tambahkan');
        }
    }

}
