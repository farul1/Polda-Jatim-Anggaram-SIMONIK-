<?php
namespace App\Http\Controllers;

use App\Models\PoliceStation;
use Illuminate\Http\Request;

class LocatorController extends Controller
{
    public function index(Request $request)
    {
        $query = PoliceStation::query();

        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('city', 'like', '%' . $request->q . '%');
        }

        $stations = $query->get();

        return view('locator', compact('stations'));
    }
}
