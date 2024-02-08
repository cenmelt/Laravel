<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Password;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

 
class ListingController extends Controller
{
    public function getInfo(Request $request){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $info_pass = Password::where('user_id', $user_id)->get();
        foreach($info_pass as $key => $val){
            $info_pass[$key]->password = Crypt::decryptString($info_pass[$key]->password);
        }
        return view('password', ["info_pass"=>$info_pass], ["info_teams"=>$user->teams]);
    }
}
 