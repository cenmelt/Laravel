<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class joinTeamController extends Controller
{
    public function joinTeam(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/password')->withErrors($validator);
        }

        // Save the data to the database
        $team = $request['teams'];
        $user_id = Auth::user()->id;

        $tms = new Team;
        $tms->name = $team;
        $tms->save();

        $user = User::find($user_id);
        $user->teams()->syncWithoutDetaching([$tms->id]);

        return redirect('/password');
    }
}
