<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class Controllers extends Controller
{
    
    public function getService(Service $id)
    {
        $service = Service::where('id', $id);

        return $service;
    }
}
