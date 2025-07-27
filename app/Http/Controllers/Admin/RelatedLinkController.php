<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RelatedLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RelatedLinkController extends Controller
{
    public function index()
    {
        $links = RelatedLink::orderBy('order')->get();
        return view('admin.related-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.related-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'order' => 'required|integer',
        ]);

        $path = $request->file('logo')->store('public/related-links');

        RelatedLink::create([
            'name' => $request->name,
            'url' => $request->url,
            'logo_path' => $path,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.related-links.index')->with('success', 'Link Terkait berhasil ditambahkan.');
    }

    public function edit(RelatedLink $relatedLink)
    {
        return view('admin.related-links.edit', ['link' => $relatedLink]);
    }

    public function update(Request $request, RelatedLink $relatedLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'order' => 'required|integer',
        ]);

        $relatedLink->name = $request->name;
        $relatedLink->url = $request->url;
        $relatedLink->order = $request->order;

        if ($request->hasFile('logo')) {
            Storage::delete($relatedLink->logo_path);
            $relatedLink->logo_path = $request->file('logo')->store('public/related-links');
        }

        $relatedLink->save();

        return redirect()->route('admin.related-links.index')->with('success', 'Link Terkait berhasil diperbarui.');
    }

    public function destroy(RelatedLink $relatedLink)
    {
        Storage::delete($relatedLink->logo_path);
        $relatedLink->delete();

        return redirect()->route('admin.related-links.index')->with('success', 'Link Terkait berhasil dihapus.');
    }
}
