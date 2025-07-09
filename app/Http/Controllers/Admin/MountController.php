<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MountController extends Controller
{
    public function index()
    {
        $mounts = Mount::paginate(10);
        return view('admin.mounts.index', compact('mounts'));
    }

    public function create()
    {
        return view('admin.mounts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:mounts',
            'type' => 'required|string|max:255',
            'faction' => 'nullable|string|max:255',
            'xpac' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'icon_url' => 'nullable|url',
        ]);

        Mount::create($validatedData);
        return redirect()->route('admin.mounts.index')->with('success', 'Montaria criada com sucesso.');
    }

    public function show(Mount $mount)
    {
        return view('admin.mounts.show', compact('mount'));
    }

    public function edit(Mount $mount)
    {
        return view('admin.mounts.edit', compact('mount'));
    }

    public function update(Request $request, Mount $mount)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('mounts')->ignore($mount->id)],
            'type' => 'required|string|max:255',
            'faction' => 'nullable|string|max:255',
            'xpac' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'icon_url' => 'nullable|url',
        ]);

        $mount->update($validatedData);
        return redirect()->route('admin.mounts.index')->with('success', 'Montaria atualizada com sucesso.');
    }

    public function destroy(Mount $mount)
    {
        $mount->delete();
        return redirect()->route('admin.mounts.index')->with('success', 'Montaria apagada com sucesso.');
    }
}