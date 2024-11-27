<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function index()
    {
        $data['header_left'] = 'Unit Section';
        $data['header_right'] = 'Add New Unit';
        $data['header_right_route'] = 'unit_create';
        $units = Unit::all();
        $user_volunteer = Volunteer::where('user_id', Auth::user()->id)->first();
        $volunteer = $user_volunteer? $user_volunteer : null;
        $common_user = $volunteer;
        return view('unit.index', $data, compact('units', 'common_user'));
    }

    public function unit_create()
    {
        $data['header_left'] = 'Unit Create';
        $data['header_right'] = 'Back to List';
        $data['header_right_route'] = 'units';
        return view('unit.create', $data);
    }


    public function unit_store()
    {
        request()->validate([
            'unit_name' => 'required|string|max:255',
        ]);

        Unit::create([
            'unit_name'=>request()->unit_name,
        ]);

        return redirect()->route('units');
    }
}
