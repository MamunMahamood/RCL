<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
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
        return view('trainer.create', $data);
    }

    public function trainer_store(){
        request()->validate([
            'trainer_name' => 'required|max:255',
            'trainer_designation' => 'required',
        ]);

        Trainer::create([
            'trainer_name' => request()->trainer_name,
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
