<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Request $request)
    {
        return view('payment.show');
    }

    public function uploadPaymentProof(Request $request)
    {
        // Validasi input yang diunggah
        $request->validate([
            'proofPath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'required|numeric',
            'place' => 'required|string',
            'item_number' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:30',
            'user_id' => 'required|exists:users,id',
        ]);

        // Simpan gambar ke penyimpanan yang diinginkan (dalam contoh ini disimpan di storage/app/public)
        if ($request->hasFile('proofPath')) {
            $proofPath = $request->file('proofPath')->store('proofPaths', 'public');
            $validatedData['proofPath'] = $proofPath;
        }

        // Buat entri baru dalam tabel Payment
        Payment::create([
            'amount' => $request->amount,
            'place' => $request->place,
            'item_number' => $request->item_number,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration,
            'proofPath' => $proofPath,
            'user_id' => $request->user_id,
        ]);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Your payment proof has been submitted. Please wait for admin confirmation.');
    }

    public function confirm($id)
    {
        // Menandai pembayaran sebagai dikonfirmasi
        $payment = Payment::findOrFail($id);
        $payment->confirmed = true;
        $payment->save();

        // Redirect ke halaman admin.payments
        return redirect()->route('admin.payments');
    }
}

