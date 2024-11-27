<?php

namespace App\Http\Controllers;

use App\Models\ExternalTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExternalTrainingController extends Controller
{
    public function external_training_store(){
        if(!empty(request())){
            ExternalTraining::create([
                'volunteer_id'=>Auth::user()->id,
                'training_name'=>request()->training_name,
                'duration'=>request()->duration,
                'attend_date'=>request()->attend_date,
                'organization_name'=>request()->organization_name,
            ]);
        }

        $external_trainings = ExternalTraining::all();
        return response()->json(['status'=>true, 'message' => 'External Training is Saved', 'external_trainings'=>$external_trainings,]);
    }
}
