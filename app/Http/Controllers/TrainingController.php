<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\Volunteer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function index()
    {
        $data['header_left'] = 'Training Section';
        $data['header_right'] = 'Add New Training';
        $data['header_right_route'] = 'training_event_create';
        $trainings = Training::all();
        return view('training.index', $data, compact('trainings'));
    }

    public function training_event_create()
    {
        $data['header_left'] = 'Training Event Creation';
        $data['header_right'] = 'Back to Training Event List';
        $data['header_right_route'] = 'training_events';
        $trainers = Trainer::all();
        $volunteers = Volunteer::all();
        return view('training.create', $data, compact('trainers', 'volunteers'));
    }

    public function training_event_store()
    {
        // dd(request()->input());
        // dd(request()->input('training_event_trainers'));
        request()->validate([
            'training_event_name' => 'required|max:255',
            'training_event_type' => 'required',
            'training_event_duration' => 'required',
            'training_event_location' => 'required',
            'training_event_total_members' => 'required',
        ]);

        $file = '';

        if (request()->hasFile('training_event_banner_img')) {
            $filename = time() . '.' . request()->training_event_banner_img->extension();
            // Move the uploaded file to the public/assets/img directory
            request()->training_event_banner_img->move(public_path('/assets/img'), $filename);
            // Store the relative file path
            $file = '/assets/img/' . $filename;
        }

        $training_event = Training::create([
            'training_event_name' => request()->training_event_name,
            'training_event_type' => request()->training_event_type,
            'training_event_duration' => request()->training_event_duration,
            'training_event_location' => request()->training_event_location,
            'training_event_total_members' => request()->training_event_total_members,
            'training_event_description' => request()->training_event_description,
            'training_event_schedule' => request()->training_event_schedule,
            'training_event_banner_img' => $file,
            'note'=>request()->note,
            'budget_amount'=> request()->budget_amount,
        ]);

        foreach (request()->input('training_event_trainers') as $trainer_id) {
            $trainer = Trainer::findorfail($trainer_id);
            TrainingMember::create([
                'training_id'=>$training_event->id,
                'volunteer_id'=> $trainer->volunteer_id,
                'designation'=> 'Trainer',
                'status'=> 'active',
            ]);
        }

        $designations = request()->input('designation');
        foreach(request()->input('volunteer_id') as $index=>$volunteer_id){
            TrainingMember::create([
                'training_id'=>$training_event->id,
                'volunteer_id'=> $volunteer_id,
                'designation'=> $designations[$index],
                'status'=> 'active',
            ]);
        }





        return redirect()->route('training_events');
    }

    public function training_event_show($id)
    {
        $training_event = Training::findorfail($id);
        $data['header_left'] = 'Training Event Details';
        $data['header_right'] = 'Back to Training Event List';
        $data['header_right_route'] = 'training_events';
        $trainers = $training_event->trainers()->get();
        $gallery = $training_event->galleries()->first();
        $training_members = TrainingMember::where('training_id', $training_event->id)->get();
        $total_training_members_count = TrainingMember::getMembers()->count();
        return view('training.show', $data, compact('training_event', 'trainers', 'gallery', 'training_members', 'total_training_members_count'));
    }



    public function training_event_edit($id)
    {
        $training_event = Training::findorfail($id);
        $data['header_left'] = 'Training Event Edit';
        $data['header_right'] = 'Back to Training Event List';
        $data['header_right_route'] = 'training_events';
        $trainers = Trainer::all();
        $selected_trainers = $training_event->trainers()->get();
        return view('training.edit', $data, compact('training_event', 'trainers', 'selected_trainers'));
    }


    public function training_event_update()
    {
        return request();
    }


    public function training_event_search()
    {
        $trainings = Training::all();
        if (request()->keyword != '') {
            $trainings = Training::where('training_event_name', 'LIKE', '%' . request()->keyword . '%')->get();
        }
        return response()->json(['trainings' => $trainings]);
    }
}
