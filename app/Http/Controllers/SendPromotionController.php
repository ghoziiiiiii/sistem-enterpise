<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Promotion;
use App\Models\SendPromotion;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class SendPromotionController extends Controller
{
    // Menampilkan form untuk memilih promosi dan pelanggan
    public function create()
    {
        $promotions = Promotion::all();
        $customers = Customer::all();
        return view('send_promotions.create', compact('promotions', 'customers'));
    }

    // Mengirim promosi ke pelanggan yang dipilih
    public function send(Request $request)
{
    $request->validate([
        'promotion_id' => 'required|exists:promotions,id',
        'customer_ids' => 'required|array',
        'customer_ids.*' => 'exists:customers,id',
    ]);

    // Ambil data promosi berdasarkan ID
    $promotion = Promotion::findOrFail($request->promotion_id);
    $customers = Customer::whereIn('id', $request->customer_ids)->get();

    foreach ($customers as $customer) {
        try {
            // Pastikan data yang dikirim sesuai dengan konstruktor TestMail
            Mail::to($customer->email)->send(new TestMail(
                $promotion->title, 
                $promotion->title,  // Gunakan title sebagai subject dan judul
                $promotion->description // Deskripsi promosi sebagai konten
            ));

            // Mencatat status pengiriman sebagai "sent"
            SendPromotion::create([
                'customer_id' => $customer->id,
                'promotion_id' => $promotion->id,
                'send_date' => now(),
                'status' => 'sent',
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error, catat sebagai "failed"
            SendPromotion::create([
                'customer_id' => $customer->id,
                'promotion_id' => $promotion->id,
                'send_date' => now(),
                'status' => 'failed',
            ]);
        }
    }

    return redirect()->route('send_promotions.create')->with('success', 'Promotion sent successfully.');
}

}
