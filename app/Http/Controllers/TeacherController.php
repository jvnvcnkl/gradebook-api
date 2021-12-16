<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::all();

        return response()->json($teachers);

    }

    public function showAvailable(){

        $availableTeachers = User::whereDoesntHave('gradebook', function ($query) {
            $query->where('id', '!=', 'user_id');
        })->get();

        return response()->json($availableTeachers);

    }

}