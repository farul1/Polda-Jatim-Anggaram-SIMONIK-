<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PoliceStation;
use Illuminate\Http\Request;

class PoliceStationController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $query = PoliceStation::query();

        if ($admin->role !== 'superadmin') {
            $query->where('city', $admin->kota);
        }

        $stations = $query->latest()->get();
        return view('admin.police-stations.index', compact('stations'));
    }

    public function create()
    {
        return view('admin.police-stations.create');
    }

    public function store(Request $request)
    {
        $isSuperAdmin = auth()->user()->role === 'superadmin';

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => [$isSuperAdmin ? 'required' : 'nullable', 'string', 'max:255'],
        ]);

        $data = $request->all();

        if (!$isSuperAdmin) {
            $data['city'] = auth()->user()->kota;
        }

        PoliceStation::create($data);

        return redirect()->route('admin.police-stations.index')->with('success', 'Lokasi kantor baru berhasil ditambahkan.');
    }

    public function edit(PoliceStation $policeStation)
    {
        return view('admin.police-stations.edit', ['station' => $policeStation]);
    }

    public function update(Request $request, PoliceStation $policeStation)
    {
        $isSuperAdmin = auth()->user()->role === 'superadmin';

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => [$isSuperAdmin ? 'required' : 'nullable', 'string', 'max:255'],
        ]);

        $data = $request->all();

        if (!$isSuperAdmin) {
            $data['city'] = auth()->user()->kota;
        }

        $policeStation->update($data);

        return redirect()->route('admin.police-stations.index')->with('success', 'Lokasi kantor berhasil diperbarui.');
    }

    public function destroy(PoliceStation $policeStation)
    {
        $policeStation->delete();
        return redirect()->route('admin.police-stations.index')->with('success', 'Lokasi kantor berhasil dihapus.');
    }
}
