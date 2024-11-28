<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\TrainingMember;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(){
        $data['header_left'] = 'Trainers Section';
        $data['header_right'] = 'Add New Trainer';
        $data['header_right_route'] = 'trainer.create';
        $trainers = Trainer::all();
        return view('trainer.index', $data, compact('trainers'));
    }

    public function trainer_create(){
        $data['header_left'] = 'Trainer Creation';
        $data['header_right'] = 'Back to Trainer List';
        $data['header_right_route'] = 'trainer.index';
        $volunteers = Volunteer::all();
        return view('trainer.create', $data, compact('volunteers'));
    }

    public function trainer_store(){
        // dd(request()->input());
        request()->validate([
            'volunteer_id' => 'required',
            'trainer_designation' => 'required',
        ],
        [
            'volunteer_id.required' => 'Please select a volunteer from the list.',
            // 'trainer_designation.required' => 'The trainer designation is required.',
        ]);

        $volunteer = Volunteer::findorfail(request()->volunteer_id);

        Trainer::create([
            'volunteer_id'=>request()->volunteer_id,
            'trainer_name' => $volunteer->user->name,
            'trainer_designation' => request()->trainer_designation,
        ]);

        return redirect()->route('trainer.index');
    }

    public function trainer_show($id){
        $trainer = Trainer::findorfail($id);
        $data['header_left'] = 'Trainer Detail';
        $data['header_right'] = 'Back to Trainer List';
        $data['header_right_route'] = 'trainer.index';
        return view('trainer.show', $data, compact('trainer'));
        
    }
}
