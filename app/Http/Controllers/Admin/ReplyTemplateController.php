<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReplyTemplate;
use Illuminate\Http\Request;

class ReplyTemplateController extends Controller
{
    /**
     * Menampilkan daftar semua template balasan.
     */
    public function index()
    {
        $templates = ReplyTemplate::latest()->get();
        return view('admin.reply-templates.index', compact('templates'));
    }

    /**
     * Menampilkan form untuk membuat template baru.
     */
    public function create()
    {
        return view('admin.reply-templates.create');
    }

    /**
     * Menyimpan template baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        ReplyTemplate::create($request->all());

        return redirect()->route('admin.reply-templates.index')->with('success', 'Template balasan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit template.
     * (Route model binding otomatis mencari data berdasarkan ID)
     */
    public function edit(ReplyTemplate $replyTemplate)
    {
        return view('admin.reply-templates.edit', ['template' => $replyTemplate]);
    }

    /**
     * Memperbarui template di database.
     */
    public function update(Request $request, ReplyTemplate $replyTemplate)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $replyTemplate->update($request->all());

        return redirect()->route('admin.reply-templates.index')->with('success', 'Template balasan berhasil diperbarui.');
    }

    /**
     * Menghapus template dari database.
     */
    public function destroy(ReplyTemplate $replyTemplate)
    {
        $replyTemplate->delete();
        return redirect()->route('admin.reply-templates.index')->with('success', 'Template balasan berhasil dihapus.');
    }
}