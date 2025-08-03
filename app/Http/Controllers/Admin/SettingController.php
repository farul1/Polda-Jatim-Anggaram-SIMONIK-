<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings', compact('settings'));
    }

public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'welcome_video_file' => 'nullable|file|mimetypes:video/mp4|max:20480', // Max 20MB
        'welcome_video_embed' => 'nullable|url',
        'logo_kiri' => 'nullable|image|max:2048',
        'logo_kanan' => 'nullable|image|max:2048',
        'aksesoris_kanan_atas' => 'nullable|image|max:2048',
        'aksesoris_kiri_atas' => 'nullable|image|max:2048',
        'aksesoris_kiri_bawah' => 'nullable|image|max:2048',
        'aksesoris_kanan_bawah' => 'nullable|image|max:2048',
    ]);

    $data = $request->except([
        '_token',
        'welcome_video_file',
        'logo_kiri',
        'logo_kanan',
        'aksesoris_kanan_atas',
        'aksesoris_kiri_atas',
        'aksesoris_kiri_bawah',
        'aksesoris_kanan_bawah',
    ]);

    // Hapus logo jika diminta
    foreach (['logo_kiri', 'logo_kanan'] as $key) {
    if ($request->has("remove_$key") && get_setting($key)) {
        $this->deleteFile(get_setting($key));
        set_setting($key, null);
        }
    }

    // Hapus video jika diminta
    if ($request->has('remove_welcome_video') && get_setting('welcome_video_path')) {
        $this->deleteFile(get_setting('welcome_video_path'));
        set_setting('welcome_video_path', null);
        set_setting('welcome_video_type', null);
    }


    // Penghapusan aksesoris jika diminta
    foreach (['kanan_atas', 'kiri_atas', 'kiri_bawah', 'kanan_bawah'] as $posisi) {
        $key = "aksesoris_$posisi";
        if ($request->has("remove_$key") && get_setting($key)) {
            $this->deleteFile(get_setting($key));
            set_setting($key, null);
        }
    }

    // Upload video jika ada
    if ($request->hasFile('welcome_video_file')) {
        try {
            if (get_setting('welcome_video_path')) {
                $this->deleteFile(get_setting('welcome_video_path'));
            }

            $videoPath = $request->file('welcome_video_file')->store('settings/videos', 'public');

            Setting::updateOrCreate(['key' => 'welcome_video_path'], ['value' => $videoPath]);
            Setting::updateOrCreate(['key' => 'welcome_video_type'], ['value' => 'upload']);

            // Kosongkan embed
            $data['welcome_video_embed'] = null;
            Setting::where('key', 'welcome_video_embed')->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload video: ' . $e->getMessage());
        }
    }

    // Upload logo
    foreach (['logo_kiri', 'logo_kanan'] as $fileKey) {
        if ($request->hasFile($fileKey)) {
            if (get_setting($fileKey)) {
                $this->deleteFile(get_setting($fileKey));
            }

            $path = $request->file($fileKey)->store('settings/logos', 'public');
            Setting::updateOrCreate(['key' => $fileKey], ['value' => $path]);
        }
    }

    // Upload aksesoris
    foreach (['kanan_atas', 'kiri_atas', 'kiri_bawah', 'kanan_bawah'] as $posisi) {
        $key = "aksesoris_$posisi";
        if ($request->hasFile($key)) {
            if (get_setting($key)) {
                $this->deleteFile(get_setting($key));
            }

            $path = $request->file($key)->store('settings/aksesoris', 'public');
            Setting::updateOrCreate(['key' => $key], ['value' => $path]);
        }
    }

    // Jika embed dipilih, hapus video file
    if ($request->input('welcome_video_type') === 'embed' && get_setting('welcome_video_path')) {
        $this->deleteFile(get_setting('welcome_video_path'));
        Setting::where('key', 'welcome_video_path')->delete();
    }

    // Simpan sisa setting biasa
    foreach ($data as $key => $value) {
        if ($value === null && !in_array($key, [
            'welcome_video_embed',
            'welcome_video_title',
            'welcome_video_description',
            'welcome_video_type',
        ])) {
            continue;
        }

        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
}


    /**
     * Hapus file dengan aman
     */
    protected function deleteFile($path)
    {
        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal menghapus file: ' . $e->getMessage());
        }
    }
}
