<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClearCacheController extends Controller
{
    public function __invoke()
    {
        return $this->clear_cache();
    }
}
