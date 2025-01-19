<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelompok = Barang::select('kelompok')->distinct()->get();
        $kategori = Barang::select('kategori')->distinct()->get();
        $spesifikasi = Barang::select('spesifikasi')->distinct()->get();

        // Kirim data ke view
        return view('admin.barang.create', compact('kelompok', 'kategori', 'spesifikasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'nullable',
            'kelompok' => 'required',
            'kategori' => 'required',
            'qty' => 'required',
            'spesifikasi' => 'required',
        ]);
        
        Barang::create($request->all());
        return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kelompok = Barang::select('kelompok')->distinct()->get();
        $kategori = Barang::select('kategori')->distinct()->get();
        $spesifikasi = Barang::select('spesifikasi')->distinct()->get();
        return view('admin.barang.edit', compact('barang','kelompok', 'kategori', 'spesifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'nuullable',
            'kelompok' => 'required',
            'kategori' => 'required',
            'qty' => 'required',
            'spesifikasi' => 'required',
        ]);
        $barang->update($request->all());
        return redirect()->route('admin.barang')->with('success', 'Barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang')->with('success', 'Barang berhasil dihapus');
    }
}
