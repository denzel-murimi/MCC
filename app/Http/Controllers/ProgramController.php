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
            return response()->json($exception->getMessage());
        }
    }

    public function show(Program $program){
        return response()->json($program);
        //return view('program.show', compact('program'));
    }
}
