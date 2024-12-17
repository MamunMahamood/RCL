<?php

namespace App\Http\Controllers;

use App\Models\ExternalTraining;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use App\Models\Volunteer;
use App\Models\Trainer;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use App\Models\TrainingMember;

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
        $external_trainings = ExternalTraining::where('volunteer_id', $volunteer->id)->get();
        $internal_trainings = $user_volunteer->trainings()->get();
        $total_trainings = Training::all();
        return view('volunteer.dashboard', $data, compact('volunteer', 'external_trainings', 'internal_trainings', 'total_trainings'));
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

        $volunteer = Volunteer::where('user_id', Auth::user()->id)->first();

        $volunteer->update([
            'designation' => request()->designation,
            'unit_id' => request()->unit_id,
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
        $external_trainings = ExternalTraining::where('volunteer_id', $volunteer->id)->get();
        $internal_trainings = $volunteer->trainings()->get();
        $total_trainings = Training::all();
        return view('volunteer.volunteer_profile', $data, compact('volunteer', 'external_trainings', 'internal_trainings', 'total_trainings'));
    }

    public function show_public($id){
        $volunteer = Volunteer::findorfail($id);
        $external_trainings = ExternalTraining::where('volunteer_id', $volunteer->id)->get();
        $internal_trainings = $volunteer->trainings()->get();
        $total_trainings = Training::all();
        return view('volunteer.volunteer_public', compact('volunteer', 'external_trainings', 'internal_trainings', 'total_trainings'));
    }


    public function show_performance($id){
        $data['header_left'] = "Volunteer's Performance Leader Board";
        $data['header_right'] = 'Back to Volunteers Leader Board List';
        $data['header_right_route'] = 'volunteer.index';
        $volunteer = Volunteer::findorfail($id);
        return view('volunteer.performance', $data, compact('volunteer'));
    }




    public function internal_training_store(){
        if(!empty(request())){
            TrainingMember::create([
                'volunteer_id'=>request()->volunteer_id,
                'training_id'=>request()->training_id,
                'designation'=>request()->designation,
                'status'=>request()->status,
            ]);
        }
        $volunteer = Volunteer::findorfail(request()->volunteer_id);
        $internal_trainings = $volunteer->trainings()->get();
        return response()->json(['status'=>true, 'message' => 'Internal Training is Saved', 'internal_trainings'=>$internal_trainings,]);
    }

    public function approve_volunteer($id){
        $volunteer = Volunteer::findorfail($id);
        $user = $volunteer->user;
        $user->is_admin = 1;
        $user->save();

        $volunteer->volunteer_id = Volunteer::generateVolunteerId();
        $volunteer->save();
        return redirect()->back();
    }

    public function set_admin($id){
        $volunteer = Volunteer::findorfail($id);
        $user = $volunteer->user;
        $user->is_admin = 2;
        $user->save();
        return redirect()->back();
    }

    public function unset_admin($id){
        $volunteer = Volunteer::findorfail($id);
        $user = $volunteer->user;
        $user->is_admin = 1;
        $user->save();
        return redirect()->back();
    }

    public function central_dashboard(){
        $data['header_left'] = "Dashboard";
        $data['header_right'] = '';
        $data['header_right_route'] = 'dashboard';
        $volunteers = Volunteer::all();
        $total_programs = Training::all();
        $total_units = Unit::all();
        $total_admins = User::where('is_admin',2)->get();
        $total_trainers = Trainer::all();
        return view('volunteer.central_dashboard', $data, compact('volunteers', 'total_programs', 'total_units', 'total_admins', 'total_trainers'));
    
    }
}
