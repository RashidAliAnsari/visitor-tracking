<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\VisitorInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Stevebauman\Location\Facades\Location;

class ProfileController extends Controller
{
    
    public function profile1(Request $request)
    {
        $request->session()->forget('visitor');
        
        $random = Str::random(100);
        $request->session()->put('visitor', $random);

        $ip = $request->visitor()->ip();
        $browser = $request->visitor()->browser();
        $device = $request->visitor()->device();
        $platfom = $request->visitor()->platform();

        $location = Location::get($ip);

        $visitor = new VisitorInfo();
        $visitor->ip = $ip;
        $visitor->browser = $browser;
        $visitor->device = $device;
        $visitor->platfom = $platfom;
        $visitor->country = $location->countryName;
        $visitor->session_in = Carbon::now();
        $visitor->date_time = Carbon::now();
        $visitor->referral = 'referral value';
        $visitor->custom_session = $random;

        $visitor->save();
        
        return view('profile');
    }

    public function sessionOut(Request $request){
        
        $session = $request->session()->get('visitor');
        $visitor = VisitorInfo::where('custom_session', $session)->first();
        $visitor->session_out = Carbon::now();
        $visitor->save();

        return true;
    }
    
    public function history(){
        $visitors = VisitorInfo::whereNotNull('session_out')->get();
        return view('history', compact('visitors'));
    }
    
}
