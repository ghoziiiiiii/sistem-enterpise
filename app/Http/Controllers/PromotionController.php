<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    // Menampilkan daftar promosi
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotions.index', compact('promotions'));
    }

    // Menampilkan form tambah promosi baru
    public function create()
    {
        return view('promotions.create');
    }

    // Menyimpan data promosi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Promotion::create($request->all());
        return redirect()->route('promotions.index')->with('success', 'Promotion added successfully.');
    }

    // Menampilkan form edit data promosi
    public function edit(Promotion $promotion)
    {
        return view('promotions.edit', compact('promotion'));
    }

    // Mengupdate data promosi di database
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion->update($request->all());
        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    // Menghapus data promosi dari database
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
