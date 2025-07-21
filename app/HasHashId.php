<?php

namespace App;


use App\Support\Facade\Hashids;

trait HasHashId
{
    public function initializeHashId()
    {
        $this->appends[] = 'hashid';
        $this->hidden[] = 'id';
    }

    public function getHashIdAttribute(): string
    {
        return Hashids::encode($this->id);
    }

    public function getRouteKeyName()
    {
        return 'hashid';
    }
}
