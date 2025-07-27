<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSectionController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::all();
        return view('admin.homepage-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.homepage-sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:homepage_sections,key',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['key', 'title', 'content']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('homepage_images', 'public');
            $data['image'] = $imagePath;
        }

        HomepageSection::create($data);

        return redirect()->route('admin.homepage-sections.index')->with('success', 'Section baru berhasil ditambahkan.');
    }

    public function edit(HomepageSection $homepageSection)
    {
        return view('admin.homepage-sections.edit', ['section' => $homepageSection]);
    }

    public function update(Request $request, HomepageSection $homepageSection)
    {
        $request->validate([
            'key' => 'required|unique:homepage_sections,key,' . $homepageSection->id,
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,mp4|max:2048',
        ]);

        $data = $request->only(['key', 'title', 'content']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($homepageSection->image && Storage::disk('public')->exists($homepageSection->image)) {
                Storage::disk('public')->delete($homepageSection->image);
            }

            $imagePath = $request->file('image')->store('homepage_images', 'public');
            $data['image'] = $imagePath;
        }

        $homepageSection->update($data);

        return redirect()->route('admin.homepage-sections.index')
                        ->with('success', 'Section berhasil diperbarui.');
    }

    public function destroy(HomepageSection $homepageSection)
    {
        if ($homepageSection->image && Storage::disk('public')->exists($homepageSection->image)) {
            Storage::disk('public')->delete($homepageSection->image);
        }

        $homepageSection->delete();

        return redirect()->route('admin.homepage-sections.index')
                        ->with('success', 'Section berhasil dihapus.');
    }
}
