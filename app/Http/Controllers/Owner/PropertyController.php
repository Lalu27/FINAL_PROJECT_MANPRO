<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 🌟 WAJIB IMPORT INI UNTUK PENGHAPUSAN FILE
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Menampilkan daftar semua kost milik owner terkait
     */
    public function index()
    {
        $properties = Property::where('user_id', auth()->id())->latest()->get();
        return view('owner.properties.index', compact('properties'));
    }

    /**
     * Menampilkan formulir pendaftaran kost baru
     */
    public function create()
    {
        return view('owner.properties.create');
    }

    /**
     * Menyimpan data kost baru ke database (Menunggu verifikasi admin)
     */
    public function store(Request $request)
    {
        // 🌟 PERBAIKAN VALIDASI: Menyesuaikan aturan array untuk fasilitas & menambah kamar_tersedia
        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'harga_bulanan' => 'required|numeric',
            'tipe_hunian' => 'required|in:Putra,Putri,Campur', // Menyesuaikan huruf kapital form
            'kamar_tersedia' => 'required|integer', // 🌟 Tambahan field dari form kamu
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|array', // 🌟 DIUBAH JADI ARRAY agar cocok dengan Checkbox
            'alamat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 🌟 PROSES KONVERSI: Menggabungkan data array checkbox menjadi string (WiFi, Dapur, dll.)
        $fasilitasString = implode(', ', $request->fasilitas);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('properties', 'public');
        }

        Property::create([
            'user_id' => auth()->id(),
            'nama_properti' => $request->nama_properti,
            'harga_bulanan' => $request->harga_bulanan,
            'tipe_hunian' => $request->tipe_hunian,
            'kamar_tersedia' => $request->kamar_tersedia, // 🌟 Tambahan input DB
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $fasilitasString, // 🌟 Masuk sebagai string terformat rapi
            'alamat' => $request->alamat,
            'gambar' => $path,
            'is_approved_by_admin' => false,
        ]);

        return redirect()->route('owner.properties.index')->with('success', 'Kost berhasil didaftarkan! Menunggu verifikasi dari Admin.');
    }

    /**
     * Menampilkan formulir edit data kost
     */
    public function edit($id)
    {
        $property = Property::where('user_id', auth()->id())->findOrFail($id);
        return view('owner.properties.edit', compact('property'));
    }

    /**
     * Memperbarui data kost + Handle Upload Gambar & Fasilitas
     */
    public function update(Request $request, $id)
    {
        $property = Property::where('user_id', auth()->id())->findOrFail($id);

        // 🌟 PERBAIKAN VALIDASI DI UPDATE: Disamakan ketat dengan fungsi store
        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'harga_bulanan' => 'required|numeric',
            'tipe_hunian' => 'required|in:Putra,Putri,Campur',
            'kamar_tersedia' => 'required|integer',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|array',
            'alamat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 🌟 PROSES KONVERSI DI UPDATE
        $fasilitasString = implode(', ', $request->fasilitas);

        $data = [
            'nama_properti' => $request->nama_properti,
            'harga_bulanan' => $request->harga_bulanan,
            'tipe_hunian' => $request->tipe_hunian,
            'kamar_tersedia' => $request->kamar_tersedia,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $fasilitasString,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('gambar')) {
            if ($property->gambar && Storage::disk('public')->exists($property->gambar)) {
                Storage::disk('public')->delete($property->gambar);
            }

            $path = $request->file('gambar')->store('properties', 'public');
            $data['gambar'] = $path;
        }

        $property->update($data);

        return redirect()->route('owner.properties.index')->with('success', 'Data kost berhasil diperbarui!');
    }

    /**
     * Menghapus data kost dari database beserta file gambarnya
     */
    public function destroy($id)
    {
        $property = Property::where('user_id', auth()->id())->findOrFail($id);

        if ($property->gambar && Storage::disk('public')->exists($property->gambar)) {
            Storage::disk('public')->delete($property->gambar);
        }

        $property->delete();

        return redirect()->route('owner.properties.index')->with('success', 'Data kost berhasil dihapus!');
    }
}