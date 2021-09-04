<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\VisitorInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Stevebauman\Location\Facades\Location;

class ProfileController extends Controller
{

    public function land(){

        // if (isset($_SERVER['HTTP_REFERER'])) {
        //     $refURL = $_SERVER['HTTP_REFERER'];
        //     echo $refURL;
        //   } else {
        //     echo "No referer URL";
        //   }

        // $referer = request()->headers->get('referer');
        // dd(parse_url($referer));
        // echo $referer;

        return view('welcome');

    }
    
    public function profile(Request $request, $id)
    {
        $request->session()->forget('visitor');
        
        $random = Str::random(100);
        $request->session()->put('visitor', $random);
        
        $ip = $request->visitor()->ip();
        $browser = $request->visitor()->browser();
        $device = $request->visitor()->device();
        $platfom = $request->visitor()->platform();
        
        // $useragent=$_SERVER['HTTP_USER_AGENT'];
        // dd($useragent);
        
        $referrelSource = array("google.com", "facebook.com", "adf.ly", "others");
        $randomSource = array_rand($referrelSource);
        
        $location = Location::get($ip);
        
        $visitor = new VisitorInfo();
        $visitor->profile_id = $id;
        $visitor->ip = $ip;
        $visitor->browser = $browser;
        $visitor->device = $device;
        $visitor->platfom = $platfom;
        $visitor->country = $location->countryName;
        $visitor->session_in = Carbon::now();
        $visitor->date_time = Carbon::now();
        $visitor->referral = $referrelSource[$randomSource];
        $visitor->custom_session = $random;
        
        $visitor->save();
        
        return view('profile',);
    }
    
    public function sessionOut(Request $request){
        
        $session = $request->session()->get('visitor');
        $visitor = VisitorInfo::where('custom_session', $session)->first();
        $visitor->session_out = Carbon::now();
        $visitor->save();
        
        return true;
    }
    
    // public function history(){
        //     $visitors = VisitorInfo::whereNotNull('session_out')->get();
        //     return view('history', compact('visitors'));
        // }
        
        public function dashboard($id){
            // $byConutry = VisitorInfo::where('profile_id', $id)->select('country')->groupBy('country')->count();
            
            
            $byConutry = $this->getByConutry(1, $id);

            $byDevice = $this->getByDevice(1, $id);
            
            $trafficChannel = $this->getTrafficChannel(1, $id);
            
            $marketingOverview = $this->getMarketingOverview(1, $id);

            $marketingPerformance = $this->getMarketingPerformance(1, $id);

            $reachSummary = $this->getreachSummary(1, $id);

            $sources = $this->getSource(1, $id);


            // dd($source);
            // return view('dash', compact('byConutry', 'id', 'byDeviceMobile', 'byDeviceTablet', 'byDeviceDesktop'));
            return view('dash', compact('byConutry', 'id', 'byDevice', 'trafficChannel', 'marketingOverview', 'marketingPerformance', 'reachSummary', 'sources'));
        }
        
        
        public function ajaxRecord(Request $request){
            // return $request->all();
            if ($request->type == 'byConutryDropdown') {
                return $this->getByConutry($request->value, $request->profileId);
            }
            if ($request->type == 'byDeviceDropdown') {
                return $this->getByDevice($request->value, $request->profileId);
            }
            if ($request->type == 'trafficChannelDropdown') {
                return $this->getTrafficChannel($request->value, $request->profileId);
            }
            if ($request->type == 'marketingOverviewDropdown') {
                return $this->getMarketingOverview($request->value, $request->profileId);
            }
            if ($request->type == 'sourceDropdown') {
                return $this->getSource($request->value, $request->profileId);
            }
            
        }
        
        
        public function getByConutry($value, $profileId){
            
            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));
            
            $result = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();

            // for percentage
            $total = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->count();

            foreach ($result as $value) {
                $value->percentage = ($total == 0) ? 0 : number_format(($value->total/$total)*100, 1);
            }
            
            return $result;
        }
        
        
        public function getByDevice($value, $profileId){
            
            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));
            
            $byDeviceMobile1 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('platfom', 'AndroidOS')
            ->count();
            $byDeviceMobile2 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('device', '!=', 'iPad')->where('platfom', 'iOS')
            ->count();
            $byDeviceMobile = $byDeviceMobile1+$byDeviceMobile2;
            
            $byDeviceTablet = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('device', 'iPad')
            ->count();
            $byDeviceDesktop = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('platfom', '!=', 'iOS')->where('platfom', '!=', 'AndroidOS')
            ->count();

            // for percentage
            $total = $byDeviceMobile + $byDeviceTablet + $byDeviceDesktop;

            $byDeviceMobilePercentage = ($total == 0) ? 0 : number_format(($byDeviceMobile/$total)*100, 1);
            $byDeviceTabletPercentage = ($total == 0) ? 0 : number_format(($byDeviceTablet/$total)*100, 1);
            $byDeviceDesktopPercentage = ($total == 0) ? 0 : number_format(($byDeviceDesktop/$total)*100, 1);
            
            $result = array("byDeviceMobile"=>$byDeviceMobile, "byDeviceTablet"=>$byDeviceTablet, "byDeviceDesktop"=>$byDeviceDesktop, "byDeviceMobilePercentage"=>$byDeviceMobilePercentage, "byDeviceTabletPercentage"=>$byDeviceTabletPercentage, "byDeviceDesktopPercentage"=>$byDeviceDesktopPercentage);
            
            return $result;
            
        }
        
        
        public function getTrafficChannel($value, $profileId){
            
            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));
            
            $google = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('referral', 'google.com')
            ->count();
            $facebook = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('referral', 'facebook.com')
            ->count();
            $adf = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('referral', 'adf.ly')
            ->count();
            $others = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where('referral', 'others')
            ->count();

            // for yesterday
            $subtractTimeVs = ($value == '1') ? Carbon::now()->subDays(2) : (($value == '7') ? Carbon::now()->subDays(14) : Carbon::now()->subDays(60));
            
            $googleVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where('referral', 'google.com')
            ->count();
            $facebookVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where('referral', 'facebook.com')
            ->count();
            $adfVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where('referral', 'adf.ly')
            ->count();
            $othersVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where('referral', 'others')
            ->count();

            $googlePercentage = ($googleVs == 0) ? 0 : number_format(($google/$googleVs)*100, 1);
            $facebookPercentage = ($facebookVs == 0) ? 0 : number_format(($facebook/$facebookVs)*100, 1);
            $adfPercentage = ($adfVs == 0) ? 0 : number_format(($adf/$adfVs)*100, 1);
            $othersPercentage = ($othersVs == 0) ? 0 : number_format(($others/$othersVs)*100, 1);
            
            $result = array("google"=>$google, "facebook"=>$facebook, "adf"=>$adf, "others" => $others, "googleVs"=>$googleVs, "facebookVs"=>$facebookVs, "adfVs"=>$adfVs, "othersVs" => $othersVs, "googlePercentage"=>$googlePercentage, "facebookPercentage"=>$facebookPercentage, "adfPercentage"=>$adfPercentage, "othersPercentage" => $othersPercentage);
            
            return $result;
            
        }
        
        public function getMarketingOverview($value, $profileId){
            
            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));
            
            
            // $impressions = DB::table('visitor_infos')
            // ->where('profile_id', $profileId)
            // ->where('created_at', '>', $subtractTime)
            // ->select(DB::raw('TIMESTAMPDIFF(second, session_in, session_out) as duration'))
            // ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>=', 10)
            // ->get();
            $impressions = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>=', 5)
            ->count();
            $reach = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->count();
            $engagement = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 10)
            ->count();
            $duration = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(session_out, session_in))) AS durationAvg"))
            ->get();

            // vs yesterday
            $subtractTimeVs = ($value == '1') ? Carbon::now()->subDays(2) : (($value == '7') ? Carbon::now()->subDays(14) : Carbon::now()->subDays(60));

            $impressionsVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>=', 5)
            ->count();
            $reachVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->count();
            $engagementVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 10)
            ->count();
            $durationVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(session_out, session_in))) AS durationAvg"))
            ->get();

            $impressionsPercentage = ($impressionsVs == 0) ? 0 : number_format(($impressions/$impressionsVs)*100, 1);
            $reachPercentage = ($reachVs == 0) ? 0 : number_format(($reach/$reachVs)*100, 1);
            $engagementPercentage = ($engagementVs == 0) ? 0 : number_format(($engagement/$engagementVs)*100, 1);
            $durationPercentage = ($durationVs[0]->durationAvg == 0) ? 0 : number_format(($duration[0]->durationAvg/$durationVs[0]->durationAvg)*100, 1);
            
                 
            $result = array("impressions"=>$impressions, "reach"=>$reach, "engagement"=>$engagement, "duration"=>number_format($duration[0]->durationAvg, 1), "impressionsPercentage"=>$impressionsPercentage, "reachPercentage"=>$reachPercentage, "engagementPercentage"=>$engagementPercentage, "durationPercentage"=>$durationPercentage);
            
            return $result;
            
        }

        public function getMarketingPerformance($value, $profileId){

            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));


            $totalVisitors = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->count();

            $bouceRate1 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '<=', 2)
            ->count();
            $bounceRate =($totalVisitors == 0) ? 0 : number_format(($bouceRate1/$totalVisitors)*100, 1);

            $engagement1 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 10)
            ->count();
            $engagement =($totalVisitors == 0) ? 0 : number_format(($engagement1/$totalVisitors)*100, 1);

            $newViewers1 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>=', 5)
            ->count();
            $newViewers =($totalVisitors == 0) ? 0 : number_format(($newViewers1/$totalVisitors)*100, 1);

            $retention1 = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 5)
            ->count();
            $retention =($totalVisitors == 0) ? 0 : number_format(($retention1/$totalVisitors)*100, 1);


            // vs yesterday
            $subtractTimeVs = ($value == '1') ? Carbon::now()->subDays(2) : (($value == '7') ? Carbon::now()->subDays(14) : Carbon::now()->subDays(60));

            $totalVisitorsVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->count();

            $bouceRate1Vs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '<=', 2)
            ->count();
            $bounceRateVs =($totalVisitorsVs == 0) ? 0 : number_format(($bouceRate1Vs/$totalVisitorsVs)*100, 1);

            $engagement1Vs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 10)
            ->count();
            $engagementVs =($totalVisitorsVs == 0) ? 0 : number_format(($engagement1Vs/$totalVisitorsVs)*100, 1);

            $newViewers1Vs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>=', 5)
            ->count();
            $newViewersVs =($totalVisitorsVs == 0) ? 0 : number_format(($newViewers1Vs/$totalVisitorsVs)*100, 1);

            $retention1Vs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTimeVs)
            ->where('created_at', '<', $subtractTime)
            ->where(DB::raw('TIMESTAMPDIFF(second, session_in, session_out)'), '>', 5)
            ->count();
            $retentionVs =($totalVisitorsVs == 0) ? 0 : number_format(($retention1Vs/$totalVisitorsVs)*100, 1);


            $result = array("bounceRate"=>$bounceRate, "engagement"=>$engagement, "newViewers"=>$newViewers, "retention"=>$retention, "bounceRateVs"=>$bounceRateVs, "engagementVs"=>$engagementVs, "newViewersVs"=>$newViewersVs, "retentionVs"=>$retentionVs);


            return $result;

        }

        public function getreachSummary($value, $profileId){

            $monthly = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->count();
            $weekly = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->count();
            $daily = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDay())
            ->count();

            // for yesterday
            $monthlyVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDays(60))
            ->where('created_at', '<', Carbon::now()->subDays(30))
            ->count();
            $weeklyVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDays(14))
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->count();
            $dailyVs = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', Carbon::now()->subDays(2))
            ->where('created_at', '<', Carbon::now()->subDay())
            ->count();

            $monthlyPercentage = ($monthlyVs == 0) ? 0 : number_format(($monthly/$monthlyVs)*100, 1);
            $weeklyPercentage = ($weeklyVs == 0) ? 0 : number_format(($weekly/$weeklyVs)*100, 1);
            $dailyPercentage = ($dailyVs == 0) ? 0 : number_format(($daily/$dailyVs)*100, 1);

            $result = array("monthly"=>$monthly, "weekly"=>$weekly, "daily"=>$daily, "monthlyPercentage"=>$monthlyPercentage, "weeklyPercentage"=>$weeklyPercentage, "dailyPercentage"=>$dailyPercentage);

            return $result;

        }

        public function getSource($value, $profileId){

            $subtractTime = ($value == '1') ? Carbon::now()->subDay() : (($value == '7') ? Carbon::now()->subDays(7) : Carbon::now()->subDays(30));

            $result = DB::table('visitor_infos')
            ->where('profile_id', $profileId)
            ->where('created_at', '>', $subtractTime)
            ->select('referral', DB::raw('count(*) as total'))
            ->groupBy('referral')
            ->get();

            return $result->sortByDesc('total')->take(10)->values();

        }
        
    }
