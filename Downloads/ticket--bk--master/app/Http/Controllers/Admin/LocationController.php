<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiEvent;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = LokasiEvent::all();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        // not used, handled via modal in index
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        LokasiEvent::create($data);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi event berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // not used
    }

    public function edit(string $id)
    {
        // not used, handled via modal in index
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $location = LokasiEvent::findOrFail($id);
        $location->update($data);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi event berhasil diperbarui.');
    }

    public function destroy(LokasiEvent $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi event berhasil dihapus.');
    }
}
