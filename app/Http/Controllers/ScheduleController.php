<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_number' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30',
        ]);
    
        // Check if there's any schedule overlapping with the new schedule
        $existingSchedule = Schedule::where('item_number', $validated['item_number'])
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->where('time', '<=', $validated['time'])
                    ->whereRaw('ADDTIME(time, SEC_TO_TIME(duration * 60)) > ?', [$validated['time']]);
            })
            ->first();
    
        if ($existingSchedule) {
            return response()->json(['message' => 'Failed to save schedule. Overlapping schedule exists.'], 400);
        }
    
        Schedule::create($validated);
    
        return response()->json(['message' => 'Schedule saved successfully!']);
    }   
    
    public function getByItemNumber(Request $request)
    {
        $itemNumber = $request->input('item_number');
        $schedules = Schedule::where('item_number', $itemNumber)->get();
        return response()->json(['schedules' => $schedules]);
    }
}