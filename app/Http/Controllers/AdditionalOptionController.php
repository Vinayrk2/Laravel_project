<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Session;

class AdditionalOptionController extends Controller
{
    public function galleryList()
    {
        $items = GalleryItem::all();
        return view('gallery_view', ['items' => $items]);
    }

    public function galleryDetail($id)
    {
        try {
            $item = GalleryItem::findOrFail($id);
            $subitems = $item->details; // Assuming a `subitems` relationship is defined in the model

            // $gallery = GalleryItem::find(1)->details; // Static gallery item for debugging
            // if ($gallery) {
            //     foreach ($gallery->subitems as $image) {
            //         logger($image->description, ['url' => $image->image]);
            //     }
            // }

            return view('gallery_item', ['item' => $item, 'subitems' => $subitems]);
        } catch (\Exception $e) {
            return view('404', ['error' => $e->getMessage()]);
        }
    }

    public function service($id)
    {
        $service = Service::find($id);
        if ($service) {
            return view('service', ['service' => $service]);
        } else {
            session()->flash('info', 'Service not found');
            return redirect()->route('home');
        }
    }

    public function setCurrency(Request $request)
    {
        try {
            $currency = $request->input('currency');

            logger('Received currency:', ['currency' => $currency]); // Debugging output

            if (in_array($currency, ['USD', 'CAD'])) {
                Session::put('currency', $currency);
                return response()->json(['success' => true, 'currency' => $currency]);
            } else {
                return response()->json(['success' => false, 'error' => 'Invalid currency'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Invalid request'], 400);
        }
    }
}
