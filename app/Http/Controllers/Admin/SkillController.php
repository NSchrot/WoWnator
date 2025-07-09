<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::paginate(10);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'type' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'class' => 'required|string|max:255',
            'description' => 'required|string',
            'xpac' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        Skill::create($validatedData);
        return redirect()->route('admin.skills.index')->with('success', 'Habilidade criada com sucesso.');
    }

    public function show(Skill $skill)
    {
        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('skills')->ignore($skill->id)],
            'type' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'class' => 'required|string|max:255',
            'description' => 'required|string',
            'xpac' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
        ]);

        $skill->update($validatedData);
        return redirect()->route('admin.skills.index')->with('success', 'Habilidade atualizada com sucesso.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Habilidade apagada com sucesso.');
    }
}
