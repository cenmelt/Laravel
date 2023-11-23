<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class teamsController extends Controller
{
    public function team(Request $request)
    {
        $rules = [
            'teams' => 'required|string|unique:teams,name',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/password')->withErrors($validator);
        }

        // Save the data to the database
        $team = $rules['teams'];
        $user_id = Auth::user()->id;

        $tms = new Team;
        $tms->name = $team;
        $tms->save();

        $user = User::find($user_id);
        $user->teams()->syncWithoutDetaching([$tms->id]);



        // return redirect("/welcome")->withErrors($validator);
        // return redirect('welcome')->route('welcome');
        return redirect('/password');
    }

}
