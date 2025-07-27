<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageSection;

class HomepageController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::all();
        return view('admin.homepage.index', compact('sections'));
    }

    public function update(Request $request)
    {
        foreach ($request->sections as $key => $data) {
            $section = HomepageSection::firstOrNew(['key' => $key]);
            $section->title = $data['title'];
            $section->content = $data['content'];
            $section->save();
        }
        return back()->with('success', 'Konten homepage berhasil diperbarui.');
    }
}
