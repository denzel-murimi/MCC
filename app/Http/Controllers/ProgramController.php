<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Program;
use GPBMetadata\Google\Api\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        try {
            $program = Program::with('event')->latest()->paginate(8);
            return view('program', compact('program'));
        }catch (\Exception $exception){
            \Illuminate\Support\Facades\Log::error('Error fetching programs (program.index):',[$exception->getMessage()]);
            return back()->with('error', 'Whoops!! Something happened!...Try again later');
        }
    }

    public function show(Program $program){
        //return response()->json($program);
        return view('slug', compact('program'));
    }

    public function eventsAPI(): JsonResponse
    {
        try {
            $events = Event::all();
            $all = [];
            foreach ($events as $event) {
                $all = array_merge($all, $event->generateRecurringEvents(now()->startOfMonth(), now()->endOfMonth()));
            }
            return response()->json($all);
        } catch (\Exception $exception){
            \Illuminate\Support\Facades\Log::error('Error fetching events (events.index):',[$exception->getMessage()]);
            return response()->json('Error fetching events',400);
        }

    }
}
