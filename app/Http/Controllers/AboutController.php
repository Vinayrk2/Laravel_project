<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent; // Import the AboutContent model

class AboutController extends Controller
{
    public function aboutPage()
    {
        // Fetch the AboutContent record with id = 1
        $about = AboutContent::find(1);

        // Fetch related sections if the AboutContent record exists
        if ($about) {
            $sections = $about->sections; // Assuming a relationship is defined in the AboutContent model
        } else {
            $sections = [];
        }

        // Pass data to the view
        return view('about.index', [
            'content' => $about,
            'sections' => $sections,
        ]);
    }
}