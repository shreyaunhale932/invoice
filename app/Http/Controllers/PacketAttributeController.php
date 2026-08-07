<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stone;
use App\Models\Clarity;
use App\Models\Color;
use App\Models\Cut;
use App\Models\Mm;
use App\Models\Chalni;
use App\Models\Shape;
use App\Models\PacketType;

class PacketAttributeController extends Controller
{
    private function getModel($type)
    {
        return match ($type) {
            'stones' => Stone::class,
            'clarities' => Clarity::class,
            'colors' => Color::class,
            'cuts' => Cut::class,
            'mms' => Mm::class,
            'chalnis' => Chalni::class,
            'shapes' => Shape::class,
            'packet_types' => PacketType::class,
            default => null,
        };
    }

    public function index($type)
    {
        $model = $this->getModel($type);
        if (!$model) abort(404);

        $attributes = $model::all();
        return view('packet-attributes.index', compact('attributes', 'type'));
    }

    public function store(Request $request, $type)
    {
        $model = $this->getModel($type);
        if (!$model) abort(404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_code' => 'nullable|string|max:50',
        ]);

        $attribute = $model::create($validated);

        // If request expects JSON (AJAX call from Packet Create page)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'id' => $attribute->id,
                'name' => $attribute->name,
                'message' => 'Added successfully!'
            ]);
        }

        // If normal form submit (Attribute Master page)
        return redirect()
            ->route('packet-attributes.index', $type)
            ->with('success', ucfirst(\Illuminate\Support\Str::singular($type)) . ' added successfully!');
    }



    public function edit($type, $id)
    {
        $model = $this->getModel($type);
        if (!$model) abort(404);

        $attribute = $model::findOrFail($id);
        return response()->json($attribute);
    }

    public function update(Request $request, $type, $id)
    {
        $model = $this->getModel($type);
        if (!$model) abort(404);

        $attribute = $model::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'short_code' => 'nullable|string|max:50',
        ]);

        $attribute->update($request->only('name', 'short_code'));

        return redirect()->back()->with('success', 'Updated successfully!');
    }

    public function destroy($type, $id)
    {
        $model = $this->getModel($type);
        if (!$model) abort(404);

        $model::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }
}
