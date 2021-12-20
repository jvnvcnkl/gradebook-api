<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradebookRequest;
use App\Http\Requests\UpdateGradebookRequest;
use Illuminate\Http\Request;
use App\Models\Gradebook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GradebookController extends Controller
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
        $filter = $request->query('filter', '');
        $gradebooks = Gradebook::with('user')->filterByName($filter)->paginate(10);

        return response()->json($gradebooks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradebookRequest $request)
    {
        $data = $request->validated();

        $user = User::with('gradebook')->findOrFail($data['user_id']);
        if ($user->gradebook) {
            return response()->json(['message' => "User already has a gradebook"], 400);
        }

        $gradebook = $user->gradebook()->create($data);

        return response()->json($gradebook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gradebook $gradebook){

        $gradebookDetailed = Gradebook::with('user','comments','students')->findOrFail($gradebook->id);

        return response()->json($gradebookDetailed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradebookRequest $request, Gradebook $gradebook)
    {
        $data = $request->validated();
        $gradebook->update($data->all());

        return response()->json($gradebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradebook $gradebook)
    {
        if ($gradebook->user_id != Auth::id()) {
            throw new AccessDeniedHttpException("You can only delete your own gradebook.");
        }
        $gradebook->delete();

        return response()->json($gradebook);
    }
}
