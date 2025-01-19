<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjams = Pinjam::select(DB::raw('DATE(created_at) as tanggal'), 'user_id')
        ->groupBy('tanggal', 'user_id') // Mengelompokkan berdasarkan tanggal dan user_id
        ->havingRaw('COUNT(*) = 1') // Hanya ambil jika user_id unik untuk tanggal
        ->orderBy('tanggal', 'asc')
        ->get();
        return view('admin.pinjam.index', compact('pinjams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userindex(){
        $barangs = Barang::all();
        return view('user.pinjam.index', compact('barangs'));
    }

    public function create()
    {
        return view('user.pinjam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $barangDipinjam = $request->input('barang');
        
        // Mulai transaksi untuk memastikan data konsisten
        DB::beginTransaction();
        // dd($barangDipinjam);
        try {
            foreach ($barangDipinjam as $barang) {
                $item = Barang::find($barang['id']);
                
                // Periksa apakah barang ada dan jumlahnya cukup
                if ($item && $item->qty >= $barang['qty']) {
                    // Simpan peminjaman barang
                    Pinjam::create([
                        'user_id' => auth()->user()->id,
                        'barang_id' => $barang['id'],
                        'qty' => $barang['qty'],
                    ]);
                    
                    // Kurangi qty barang
                } else {
                    // Jika barang tidak cukup, kirim respons error
                    DB::rollBack(); // Rollback transaksi
                    return response()->json(['status' => 'error', 'message' => 'qty barang tidak mencukupi']);
                }
            }
    
            // Commit transaksi jika tidak ada error
            DB::commit();
    
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Jika ada error, rollback transaksi
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat memproses peminjaman.']);
        }
    }
    /**
     * Display the specified resource.
     */

    public function showDaftarPeminjam()
    {
        // Ambil daftar peminjam dan tanggal peminjamannya
        $peminjam = Pinjam::select('user_id', 'created_at', 'status', DB::raw('SUM(qty) as total_qty'))
                            ->groupBy('user_id', 'created_at', 'status') // Mengambil hanya satu instance untuk setiap user dan tanggal
                            ->with('user')
                            ->get();
        return view('admin.pinjam.index', compact('peminjam'));
    }

    public function listpinjam()
    {
    // Ambil ID user yang sedang login
        $userId = auth()->id(); // Jika menggunakan autentikasi Laravel
        // Jika ID user disediakan secara manual (contoh: dari request), gunakan ini:
        // $userId = $request->user_id;

        // Ambil daftar peminjaman milik user tertentu
        $peminjam = Pinjam::select('user_id', 'created_at', 'status', DB::raw('SUM(qty) as total_qty'))
                            ->where('user_id', $userId) // Filter berdasarkan user_id
                            ->groupBy('user_id', 'created_at', 'status') // Mengambil hanya satu instance untuk setiap user dan tanggal
                            ->with('user') // Memuat relasi user
                            ->get();

        return view('user.pinjam.list', compact('peminjam'));
    }
    

    public function show($userid, $created_at)
    {
        // Ambil data user berdasarkan username

    // Konversi $created_at ke format timestamp


    $createdAt = Carbon::parse($created_at);

    $userminjam = Pinjam::with(['barang', 'user'])
    ->where('user_id', $userid)
    ->whereDate('created_at', $createdAt->toDateString())
    ->whereTime('created_at', $createdAt->toTimeString())
    ->first();

    // Ambil semua pinjaman berdasarkan user dan waktu created_at yang sama
    $pinjaman = Pinjam::with(['barang', 'user'])
        ->where('user_id', $userid) // Cocokkan dengan user ID
        ->whereDate('created_at', $createdAt->toDateString()) // Tanggal yang sama
        ->whereTime('created_at', $createdAt->toTimeString()) // Waktu yang sama
        ->get();
    // Jika tidak ada pinjaman, redirect atau tampilkan pesan error
    if ($pinjaman->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada pinjaman ditemukan.');
    }

    return view('admin.pinjam.show', compact('pinjaman', 'userminjam', 'createdAt'));
    }

    public function showdetail($userid, $created_at)
    {
        // Ambil data user berdasarkan username

    // Konversi $created_at ke format timestamp


    $createdAt = Carbon::parse($created_at);

    $userminjam = Pinjam::with(['barang', 'user'])
    ->where('user_id', $userid)
    ->whereDate('created_at', $createdAt->toDateString())
    ->whereTime('created_at', $createdAt->toTimeString())
    ->first();

    // Ambil semua pinjaman berdasarkan user dan waktu created_at yang sama
    $pinjaman = Pinjam::with(['barang', 'user'])
        ->where('user_id', $userid) // Cocokkan dengan user ID
        ->whereDate('created_at', $createdAt->toDateString()) // Tanggal yang sama
        ->whereTime('created_at', $createdAt->toTimeString()) // Waktu yang sama
        ->get();
    // Jika tidak ada pinjaman, redirect atau tampilkan pesan error
    if ($pinjaman->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada pinjaman ditemukan.');
    }

    return view('user.pinjam.detail', compact('pinjaman', 'userminjam', 'createdAt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateAll(Request $request)
    {
        $userId = $request->input('user_id');
        $createdAt = $request->input('created_at');
        $barangIds = $request->input('barang_id');
        $qtys = $request->input('qty');
        $action = $request->input('action'); 
        // "accept", "reject", atau "return"
        foreach ($barangIds as $index => $barangId) {
            $pinjam = Pinjam::where('user_id', $userId)
                ->where('created_at', $createdAt)
                ->where('barang_id', $barangId)
                ->first();
            if (!$pinjam) {
                continue; // Jika data tidak ditemukan, lanjutkan ke iterasi berikutnya
            }

            switch ($action) {
                case 'accept':
                    if ($pinjam->status === 0) {
                        $pinjam->status = 1; // Accepted
                        $barang = Barang::find($barangId);
                        if ($barang) {
                            $barang->qty -= $qtys[$index]; // Kurangi qty
                            $barang->save();
                        }
                        break;
                    }
                    else {
                        // Jika status bukan 0, tampilkan pesan error
                        return redirect()->back()->with('error', 'Tidak dapat menerima peminjaman karena status peminjaman tidak valid.');
                    }

                case 'reject':
                    if ($pinjam->status === 0) {

                        $pinjam->status = 2; // Rejected
                        break;
                    }
                    else {
                        // Jika status bukan 0, tampilkan pesan error
                        return redirect()->back()->with('error', 'Tidak dapat menolak peminjaman karena status peminjaman tidak valid.');
                    }
                    

                case 'return':
                    if ($pinjam->status === 1) {

                        $pinjam->status = 3; // Returned
                        $barang = Barang::find($barangId);
                        if ($barang) {
                            $barang->qty += $qtys[$index]; // Tambahkan qty kembali
                            $barang->save();
                        }
                    }
                    else {
                        // Jika status bukan 1, tampilkan pesan error
                        return redirect()->back()->with('error', 'Tidak dapat mengembalikan barang karena status peminjaman tidak valid.');
                    }
                    break;
            }

            $pinjam->save();
        }

        return redirect()->route('admin.pinjam')->with('success', 'Pinjaman telah diperbarui.');
    }

    public function edit(Pinjam $pinjam)
    {

        return view('admin.pinjam.edit', compact('pinjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        $request->validate([
            'status' => 'required',
        ]);

        //peminjaman
        if ($request->status == 1) {
            $pinjam->update($request->all());
            $barang = Barang::find($pinjam->barang_id);
            $barang->qty = $barang->qty - $pinjam->qty;
            $barang->save();
            return redirect()->route('pinjam.admin')->with('success', 'Data berhasil diupdate');
        }
        //penolakan
        elseif ($request->status == 2) {
            $pinjam->update($request->all());
            return redirect()->route('pinjam.admin')->with('success', 'Data berhasil diupdate');
        }

        //pengembalian
        elseif ($request->status == 3) {
            $pinjam->update($request->all());
            $barang = Barang::find($pinjam->barang_id);
            $barang->qty = $barang->qty + $pinjam->qty;
            $barang->save();
            return redirect()->route('pinjam.admin')->with('success', 'Data berhasil diupdate');
        }

        return redirect()->route('pinjam.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pinjam $pinjam)
    {
        //
    }
}
