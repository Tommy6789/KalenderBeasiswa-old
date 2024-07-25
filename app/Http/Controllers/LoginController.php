<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.login');
    }

    public function register(Request $request)
    {
        return view('login.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'nomer_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'terms' => 'required',
        ], [
            'terms.required' => 'Anda harus menyetujui persyaratan dan ketentuan.',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nomer_telepon = $request->nomer_telepon;
        $user->alamat = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->id_level_user = 3; // Set level user ID to 3

        $user->save();

        // Log the user in after successful registration
        Auth::login($user);

        return redirect()->route('login.index')->with('success', 'Akun Anda berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login_check(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/kalender_beasiswa');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect('/login'); // Redirect to the login page
    }

    // public function forgot_password()
    // {
    //     return view('login.forgot_passsword');
    // }

    // public function send_reset_link(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $token = Str::random(60);
    //     $email = $request->input('email');

    //     // Store the reset token in the database
    //     DB::table('password_resets')->insert([
    //         'email' => $email,
    //         'token' => $token,
    //         'created_at' => now(),
    //     ]);

    //     // Send the reset email
    //     Mail::send('emails.password_reset', ['token' => $token], function ($message) use ($email) {
    //         $message->to($email);
    //         $message->subject('Password Reset Request');
    //     });

    //     return redirect()->back()->with('status', 'We have emailed your password reset link!');
    // }

    // public function recover_password()
    // {
    //     return view('login.recover_password');
    // }

    // public function reset_password(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|min:8|confirmed',
    //         'password_confirmation' => 'required',
    //         'token' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $passwordReset = DB::table('password_resets')->where([
    //         ['token', $request->token],
    //         ['email', $request->email],
    //     ])->first();

    //     if (!$passwordReset) {
    //         return redirect()->back()->withErrors(['email' => 'This password reset token is invalid.']);
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Delete password reset record
    //     DB::table('password_resets')->where(['email' => $request->email])->delete();

    //     return redirect()->route('login.index')->with('status', 'Your password has been reset!');
    // }
}
