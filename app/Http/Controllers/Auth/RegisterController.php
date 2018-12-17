<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

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

        /*return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'lname' => 'required|string|max:255',
            'role' => 'required',
            'tel' => 'required',
            'city' => 'required',
            'previous_work' => 'required',
            'availability' => 'required',
            'citations' => 'required',
            'highest_qualification' => 'required',
            'proficiencies' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'password' => 'required|string|min:6|confirmed',
        ]);*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $image = time().$data['image']->getClientOriginalName();
        //dd($image);

        $data['image']->move(public_path('profileImgs'),$image);
        //dd();
        return User::create([
            'fname' => $data['fname'],
            'email' => $data['email'],
            'lname' => $data['lname'],
            'role' => $data['role'],
            'age' => $data['yob'],
            'tel' => $data['tel'],
            'image_path' => $image,
            'passport' => $data['passport'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
