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
        $user = User::with('gradebook')->findOrFail($request->get('user_id'));

        if ($user->gradebook) {
            return response()->json(['message' => "User already has a gradebook"], 400);
        }

        $gradebook = $user->gradebook()->create([
            'name' => $request->get('name'),
        ]);

        return response()->json($gradebook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gradebook $gradebook)
    {
        $gradebookComments = $gradebook->comments()->get();
        return response()->json($gradebookComments);
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
        $gradebook->update($request->all());

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
