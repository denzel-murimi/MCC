<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentMediaManager\Models\Folder as Base;
use TomatoPHP\FilamentMediaManager\Traits\InteractsWithMediaFolders;

class Folder extends Base
{
    use InteractsWithMediaFolders;
}
