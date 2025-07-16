<?php

namespace App\Exceptions;

use BezhanSalleh\FilamentExceptions\Facades\FilamentExceptions;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{
    public function register(): void
    {
        $this->reportable(function (\Throwable $e) {
            if ($this->shouldReport($e)){
                FilamentExceptions::report($e);
            }
        });
    }
}
