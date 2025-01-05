<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function aboutPage()
    {
        $aboutContent = AboutContent::getContent();
        $sections = AboutSection::all()->toArray();

        // dd($sections);
    
        return view('about.index', compact('aboutContent', 'sections'));
    }
    
    
}