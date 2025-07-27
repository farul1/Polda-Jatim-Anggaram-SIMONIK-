<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Menampilkan daftar semua slider.
     */
    public function index()
    {
        $sliders = \App\Models\Slider::orderBy('order')->get();

        return view('admin.sliders.index', compact('sliders'));
    }
    /**
     * Menampilkan form untuk membuat slider baru.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Menyimpan slider baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        // Simpan gambar dan dapatkan path-nya
        $path = $request->file('image')->store('public/sliders');

        Slider::create([
            'image_path' => $path,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slide baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit slider.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Memperbarui slider di database.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Gambar tidak wajib diisi saat update
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->order = $request->order;

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::delete($slider->image_path);
            // Simpan gambar baru
            $slider->image_path = $request->file('image')->store('public/sliders');
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slide berhasil diperbarui.');
    }

    /**
     * Menghapus slider dari database.
     */
    public function destroy(Slider $slider)
    {
        // Hapus file gambar dari storage
        Storage::delete($slider->image_path);
        // Hapus data dari database
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slide berhasil dihapus.');
    }
}
