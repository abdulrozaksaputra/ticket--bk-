<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $types = TicketType::all();
        return view('admin.ticket_types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.ticket_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        TicketType::create($data);
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil dibuat.');
    }

    public function edit(TicketType $ticketType)
    {
        return view('admin.ticket_types.edit', compact('ticketType'));
    }

    public function update(Request $request, TicketType $ticketType)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $ticketType->update($data);
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil diperbarui.');
    }

    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil dihapus.');
    }
}
