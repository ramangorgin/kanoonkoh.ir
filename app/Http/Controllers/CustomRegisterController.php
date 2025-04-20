<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomRegisterController extends Controller
{
        public function showForm()
        {
            return view('auth.register');
        }

        

        public function register(RegisterUserRequest $request)
        {
            try {
                // ✅ Convert Persian numbers + normalize to slash
                $birthDateRaw = strtr($request->birth_date, [
                    '۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4',
                    '۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9',
                    '-' => '/'
                ]);
        
                // ✅ Parse and convert to Gregorian
                $gregorianBirthDate = Jalalian::fromFormat('Y/m/d', $birthDateRaw)->toCarbon()->toDateString();
        
                // ✅ Inject into request
                $request->merge(['birth_date' => $gregorianBirthDate]);
        
            } catch (\Exception $e) {
                return back()->withErrors(['birth_date' => 'فرمت تاریخ تولد معتبر نیست.']);
            }
        
            $data = $request->validated();
        
            if ($request->hasFile('profile_photo')) {
                $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
            }
        
            $data['password'] = \Hash::make($data['password']);
            $user = \App\Models\User::create($data);
        
            \Auth::login($user);
        
            return redirect()->route('dashboard');
        }
        
        
}
