<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\MyTestEmail;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function checkUsername(Request $request)
    {
        $exists = User::where('user_name', $request->username)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function register(Request $request)
    {
        Log::debug('Registration attempt', $request->all());

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z ]*$/',
            'user_name' => 'required|unique:users,user_name|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'whatsapp_number' => 'required',
            'address' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000'
        ], [
            'password.regex' => __('messages.password_requirements')
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imagePath = $request->file('profile_picture')->store('public/images');
            $imageName = basename($imagePath);

            $user = User::create([
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'whatsapp_number' => $request->whatsapp_number,
                'address' => $request->address,
                'password' => bcrypt($request->password),
                'img_name' => $imageName
            ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            Mail::to('magibra490@gmail.com')->send (new MyTestEmail($user));
            

            return redirect()->back()->with('success', __('messages.registration_success'));

        } 
        catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }
}