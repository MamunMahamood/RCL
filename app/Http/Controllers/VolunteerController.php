<?php

namespace App\Http\Controllers;

use App\Models\ExternalTraining;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(){
        $data['header_left'] = 'Volunteers Performances';
        $data['header_right'] = 'Create Volunteer';
        $data['header_right_route'] = 'volunteer.create_profile';
        $volunteers = Volunteer::all();
        return view('volunteer.index', $data, compact('volunteers'));
    }
    public function dashboard(){
        $data['header_left'] = 'Dashboard';
        $data['header_right'] = 'Edit Profile';
        $data['header_right_route'] = 'volunteer.create_profile';
        $user_volunteer = Volunteer::where('user_id', Auth::user()->id)->first();
        $volunteer = $user_volunteer? $user_volunteer : null;
        $external_trainings = ExternalTraining::where('volunteer_id', Auth::user()->id)->get();
        return view('volunteer.dashboard', $data, compact('volunteer', 'external_trainings'));
    }

    public function create_profile(){
        $data['header_left'] = 'Edit Profile';
        $data['header_right'] = 'Back to Dashboard';
        $data['header_right_route'] = 'volunteer.dashboard';
        $units = Unit::all();
        return view('volunteer.create', $data, compact('units'));
    }

    public function store_profile(){
        request()->validate([
            'designation' => 'string|max:255',
            'email' => 'email|max:255',
        ]);

        $file = '';

        if (request()->hasFile('profile_picture')) {
            $filename = time() . '.' . request()->profile_picture->extension();
            // Move the uploaded file to the public/assets/img directory
            request()->profile_picture->move(public_path('/assets/img'), $filename);
            // Store the relative file path
            $file = '/assets/img/' . $filename;
        }

        Volunteer::create([
            'designation' => request()->designation,
            'unit_id' => request()->unit_id,
            'user_id' => Auth::user()->id,
            'phone_number' => request()->phone_number,
            'joining_date' => request()->joining_date,
            'email' => request()->email,
            'blood_group' =>request()->blood_group,
            'blood_donation_count' => request()->blood_donation_count,
            'profile_picture' => $file,
        ]);

        return redirect()->route('volunteer.dashboard');

    }

    public function show($id){
        $data['header_left'] = "Volunteer's Info";
        $data['header_right'] = 'Back to Volunteers Leader Board List';
        $data['header_right_route'] = 'volunteer.index';
        $volunteer = Volunteer::findorfail($id);
        return view('volunteer.dashboard', $data, compact('volunteer'));
    }


    public function show_performance($id){
        $data['header_left'] = "Volunteer's Performance Leader Board";
        $data['header_right'] = 'Back to Volunteers Leader Board List';
        $data['header_right_route'] = 'volunteer.index';
        $volunteer = Volunteer::findorfail($id);
        return view('volunteer.dashboard', $data, compact('volunteer'));
    }
}
