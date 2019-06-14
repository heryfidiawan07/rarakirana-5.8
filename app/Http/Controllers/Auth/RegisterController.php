<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {           
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect('/login')->with('warning', 'Buka email anda untuk verifikasi akun !');
    }
    
    protected function create(array $data)
    {   
        $cekSlug = User::where('slug', str_slug($data['name']))->first();
        if ($cekSlug) {
            $slug = str_slug($data['name']).date('His');
        }else{
            $slug = str_slug($data['name']);
        }
        $user = User::create([
            'name' => $data['name'],
            'slug' => $slug,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => str_random(50),
            'img'   => 'profile.jpg',
            'role' => 0,
            'status' => 0,
        ]);
        // Send Email
        Mail::to($user->email)->send(new Register($user));
    }

    // Email Verify
    public function email_verify($token, $id){
        $user = User::find($id);
        if (!$user) {
            return redirect('/login')->with('warning', 'How are you ?');
        }
        if ($user->token != $token) {
            return redirect('/login')->with('warning', 'What are you doing ?');
        }
        $user->status = 1;
        $user->save();

        $this->guard()->login($user);
        return redirect('/');
    }
}
