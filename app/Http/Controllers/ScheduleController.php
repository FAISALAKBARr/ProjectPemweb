<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getSchedulesByItemNumber(Request $request)
    {
        $itemNumber = $request->query('item_number');
        $schedules = Payment::where('item_number', $itemNumber)->get();

        return response()->json(['schedules' => $schedules]);
    }
    
    public function checkOverlap(Request $request)
    {
        $startTime = Carbon::parse($request->date . ' ' . $request->time);
        $endTime = $startTime->copy()->addMinutes(intval($request->duration));
    
        $existingPayment = Payment::where('place', $request->place)
            ->where('item_number', $request->item_number) // Tambahkan pengecekan item_number
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                    ->orWhereRaw('ADDTIME(time, SEC_TO_TIME(duration * 60)) > ?', [$startTime->format('H:i:s')]);
            })
            ->first();
    
        return response()->json(['overlap' => (bool) $existingPayment]);
    }
    
}