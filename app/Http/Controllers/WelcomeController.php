<?php
namespace App\Http\Controllers;
use App\Models\HomepageSection;
use App\Models\Slider;
use App\Models\RelatedLink;

class WelcomeController extends Controller
{
    public function index()
    {
        $sections = \App\Models\HomepageSection::all()->keyBy('key');
        $sliders = Slider::orderBy('order')->get();
        $relatedLinks = RelatedLink::orderBy('order')->get();

    return view('welcome', compact('sections', 'sliders', 'relatedLinks'));
    }

}
