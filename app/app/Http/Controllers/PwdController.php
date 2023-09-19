<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

 
class PwdController extends Controller
{
    public function form(Request $request)
    {
        $rules = [
            'url' => 'required|string|url',
            'mail' => 'required|string|email',
            'mdp' => 'required|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/gestionMdp')->withErrors($validator);
        }

        // Save the data to the database
        $url = $_POST['url'];
        $email = $_POST['mail'];
        $mdp = $_POST["mdp"];
        $data = array('URL' => $url,'EMAIL' => $email,'MDP' => $mdp);
        $json = json_encode($data);
        Storage::put(time().'.json', $json);

        // return redirect("/welcome")->withErrors($validator);
        // return redirect('welcome')->route('welcome');
        return redirect('/');
    }
}
 