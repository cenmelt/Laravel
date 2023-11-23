<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

 
class ListingController extends Controller
{
    public function getInfo(Request $request){
        $user_id = Auth::user()->id;
        $info = Password::where('user_id', $user_id)->get();
        // mdp ou id du user en ligne = un id ds la table -> recuperer
        foreach($info as $key => $val){
            $info[$key]->password = Crypt::decryptString($info[$key]->password);
        }
        return view('password', ["info"=>$info]);
    }
}
 