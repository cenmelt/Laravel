<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\joinTeam;

class joinTeamController extends Controller
{
    public function joinTeam(Request $request)
    {
        $rules = [
            'member' => 'required|string',
            'team' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/password')->withErrors($validator);
        }
        $user_id = Auth::user()->id;
        $member = $request['member'];
        $team = $request['team'];
        $idmember = User::select('id')->where('name', $member);
        $idteam = Team::select('id')->where('name', $team);
        
        if ($idmember !== null && $idteam !== null){
            if($user_id == $idmember->first()->id){
                return redirect('/password');
            }else{
                //dd($idmember->first(), $idteam->first());
                $user = User::find($idmember);
                $tms = Team::find($idteam);
                $user_name = Auth::user()->name;
                $usersTeam = Team::find($idteam)->users;
                foreach ($usersTeam as $member) {
                    $member->notify(new joinTeam($user->name, $tms->name, date('d M Y à H:i:s'), $user_name));
                }
                $user->teams()->syncWithoutDetaching([$tms->id]);
                return redirect('/');
            }
        }else{
            return redirect('/password');
        }
    }
}
