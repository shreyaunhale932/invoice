<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PacketMaster;
use App\Models\Stone;
use App\Models\Clarity;
use App\Models\Color;
use App\Models\Cut;
use App\Models\Mm;
use App\Models\Chalni;
use App\Models\Shape;

class PacketMasterController extends Controller
{
    public function index()
    {
        $packets = PacketMaster::with(['stone', 'clarity', 'color', 'cut', 'mm', 'chalni', 'shape'])->latest()->get();
        return view('packet-masters.index', compact('packets'));
    }

    public function create()
    {
        $stones = Stone::all();
        $clarities = Clarity::all();
        $colors = Color::all();
        $cuts = Cut::all();
        $mms = Mm::all();
        $chalnis = Chalni::all();
        $shapes = Shape::all();

        return view('packet-masters.create', compact('stones', 'clarities', 'colors', 'cuts', 'mms', 'chalnis', 'shapes'));

    }

   public function store(Request $request)
{
    $request->validate([
        'packet_no' => 'required|unique:packet_masters,packet_no,NULL,id,firm_id,' . auth()->user()->firm_id,
    ]);

    PacketMaster::create($request->all());

    return redirect()
        ->route('packet-masters.index')
        ->with('success', 'Packet created successfully.');
}

    public function edit($packetMaster)
    {
        $packetMaster =PacketMaster::findOrFail($packetMaster);
        $stones = Stone::all();
        $clarities = Clarity::all();
        $colors = Color::all();
        $cuts = Cut::all();
        $mms = Mm::all();
        $chalnis = Chalni::all();
        $shapes = Shape::all();

        return view('packet-masters.edit', compact('packetMaster', 'stones', 'clarities', 'colors', 'cuts', 'mms', 'chalnis', 'shapes'));
    }

    public function update(Request $request, $packetMaster)
    {
         $packetMaster = PacketMaster::findOrFail($packetMaster);

        $request->validate([
            'packet_no' => 'required|unique:packet_masters,packet_no,' . $packetMaster->id,
        ]);

        $packetMaster->update($request->all());

        return redirect()->route('packet-masters.index')->with('success', 'Packet updated successfully.');
    }

    public function destroy($packetMaster)
    {
          $packetMaster = PacketMaster::findOrFail($packetMaster);
        $packetMaster->delete();
        return redirect()->route('packet-masters.index')->with('success', 'Packet deleted successfully.');
    }
}
