<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::paginate(10);
        return view('admin.characters.index', compact('characters'));      
    }


    public function create()
    {
        return view('admin.characters.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255|unique:characters',
        'gender' => 'required|string',
        'class' => 'required|string',
        'race' => 'required|string',
        'faction' => 'required|string',
        'realm' => 'required|string',
        'xpac' => 'required|string',
        'image_url' => 'nullable|url',
        'splash_url' => 'nullable|url',
        ]);

        Character::create($validatedData);

        return redirect()->route('admin.characters.index')->with('success', 'Personagem criado com sucesso!');
    }


    public function show(Character $character)
    {
        return view('admin.characters.show', compact('character'));
    }


    public function edit(Character $character)
    {
        return view('admin.characters.edit', compact('character'));
    }


    public function update(Request $request, Character $character)
    {
        $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique('characters')->ignore($character->id)],
                'gender' => 'required|string',
                'class' => 'required|string',
                'race' => 'required|string',
                'faction' => 'required|string',
                'realm' => 'required|string',
                'xpac' => 'required|string',
                'image_url' => 'nullable|url',
                'splash_url' => 'nullable|url',
        ]);

        $character->update($validatedData);

        return redirect()->route('admin.characters.index')->with('success', 'Personagem atualizado com sucesso!');        
    }

    public function destroy(Character $character)
    {
        $character->delete();
        return redirect()->route('admin.characters.index')->with('success', 'Personagem excluído com sucesso!');   
    }

}
