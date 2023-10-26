<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


 
class PwdController extends Controller
{
    public function form(Request $request)
    {
        $rules = [
            'url' => 'required|string|url',
            'login' => 'required|string',
            'mdp' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/password')->withErrors($validator);
        }

        // Save the data to the database
        $url = $_POST['url'];
        $login = $_POST['login'];
        $mdp = Crypt::encryptString($_POST["mdp"]);
        $data = array('URL' => $url,'Login' => $login,'MDP' => $mdp);
        $json = json_encode($data);
        Storage::put(time().'.json', $json); 

        $user_id = Auth::user()->id;

        $pwd = new Password;
        $pwd->user_id = $user_id;
        $pwd->site = $url;
        $pwd->login = $login;
        $pwd->password = $mdp;
        $pwd->save();


        // return redirect("/welcome")->withErrors($validator);
        // return redirect('welcome')->route('welcome');
        return redirect('/password');
    }

    public function id(int $idpass){
        return view('change', ['idpass'=>$idpass]);
    }

    public function editPwd(Request $request, $idpass){
        $rules = [
            'mdp' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/password')->withErrors($validator);
        }
        $mdp = $_POST["password"];
        $idpass->update(['password'=>$mdp]);    
        return redirect('/password');
    }
}
 