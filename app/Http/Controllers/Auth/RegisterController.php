<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:10'],
            'center' => ['required', 'string', 'max:255'],
            'promotion' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:etudiant,admin,pilot'],
            'profile_picture' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
    }
	

    protected function create(array $data)
    {
		$profilePicture = null;

		if (isset($data['profile_picture'])) {
			$extension = $data['profile_picture']->getClientOriginalExtension();
			$fileName = $data['name'] . '.jpg';
			$path = $data['profile_picture']->storeAs('public/profile_pictures', $fileName);
			$profilePicture = Storage::url($path);
		}

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'center' => $data['center'],
            'promotion' => $data['promotion'],
            'role' => $data['role'],
            'profile_picture' => $profilePicture,
        ]);
    } 
 
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($user){
            return redirect()->back()->with('success','Bravo vous avez bien créé le compte !');
        }else{
            return redirect()->back()->with('error','Création échouée.');
        }
    }
}
