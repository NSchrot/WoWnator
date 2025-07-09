<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with('character')->paginate(10);
        return view('admin.quotes.index', compact('quotes'));
    }

    public function create()
    {
        $characters = Character::orderBy('name')->get();
        return view('admin.quotes.create', compact('characters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|string|unique:quotes',
            'character_id' => 'required|exists:characters,id',
        ]);

        Quote::create($validatedData);
        return redirect()->route('admin.quotes.index')->with('success', 'Citação criada com sucesso.');
    }

    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        $characters = Character::orderBy('name')->get();
        return view('admin.quotes.edit', compact('quote', 'characters'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validatedData = $request->validate([
            'text' => ['required', 'string', Rule::unique('quotes')->ignore($quote->id)],
            'character_id' => 'required|exists:characters,id',
        ]);

        $quote->update($validatedData);
        return redirect()->route('admin.quotes.index')->with('success', 'Citação atualizada com sucesso.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('admin.quotes.index')->with('success', 'Citação apagada com sucesso.');
    }
}