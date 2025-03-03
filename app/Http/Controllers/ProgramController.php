<?php

namespace App\Http\Controllers;

use App\Models\Program;
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
}
