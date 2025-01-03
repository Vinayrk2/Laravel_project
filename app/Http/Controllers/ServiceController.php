<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Import the Service model
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function service($id)
    {
        // Fetch the service by ID
        $service = Service::find($id);
       
        if ($service) {
            // Pass the service data to the view
            return view('service.index', ['service' => $service]);
        } else {
            // Flash a message and redirect to the home page
            Session::flash('info', 'Service not found');
            return redirect()->route('home');
        }
    }
}