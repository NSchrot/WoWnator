<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::paginate(10);
        return view('admin.zones.index', compact('zones'));
    }

    public function create()
    {
        return view('admin.zones.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:zones',
            'continent' => 'required|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        Zone::create($validatedData);
        return redirect()->route('admin.zones.index')->with('success', 'Zona criada com sucesso.');
    }

    public function show(Zone $zone)
    {
        return view('admin.zones.show', compact('zone'));
    }

    public function edit(Zone $zone)
    {
        return view('admin.zones.edit', compact('zone'));
    }

    public function update(Request $request, Zone $zone)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('zones')->ignore($zone->id)],
            'continent' => 'required|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        $zone->update($validatedData);
        return redirect()->route('admin.zones.index')->with('success', 'Zona atualizada com sucesso.');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('admin.zones.index')->with('success', 'Zona apagada com sucesso.');
    }
}
