<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $teachers = User::with('gradebook')->filterByName($filter)->get();

        return response()->json($teachers);
    }

    public function showAvailable()
    {

        $availableTeachers = User::whereDoesntHave('gradebook', function ($query) {
            $query->where('id', '!=', 'user_id');
        })->get();

        return response()->json($availableTeachers);
    }
}
