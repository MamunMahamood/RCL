<?php

namespace App\Http\Controllers;
use App\Models\User;


class AdminController extends Controller {
    public function index(){
        $data['header_left'] = 'Admins Section';
        $data['header_right'] = 'Add New Admin';
        $data['header_right_route'] = 'trainer.create';
        $admins = User::where('is_admin', 2)->get();
        return view('admin.index', $data, compact('admins'));
    }
}