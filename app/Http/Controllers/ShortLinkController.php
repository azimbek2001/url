<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ShortLink;
use App\Models\Userip;
use App\Models\UserAgent;
use DB;
class ShortLinkController extends Controller
{
    //
	 public function index()
    {
        $shortLinks = ShortLink::latest()->get();
        return view('welcome', compact('shortLinks'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validated=$request->validate(['link' => 'required|url']) ;
      $input['link'] = $request->link;
        $input['code'] = str_random(6);
   		if(ShortLink::create($input)){
   			 return redirect('generate-shorten-link')->with('success', 'Shorten Link Generated Successfully!');
   		} 
    }
    public function getState(){
    	$shortLinks = ShortLink::latest()->get();
    	$userIps = DB::table('userips')
    			->orderBy('ip')
                ->get();
        $userAgents = DB::table('user_agents')
    			->orderBy('name')
                ->get();
        
        return view('state', compact(['shortLinks','userIps','userAgents']));
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        //SHORTLINK
        $findshortenLink = ShortLink::where('code', $code)->first();
     	if(!$findshortenLink){
     		return ("404");
     	}
		$findshortenLink->count=$findshortenLink->count+1;
		$code_id=$findshortenLink->id;
		$findshortenLink->save();

		//IP ADRESS
     	$ipAddress = $_SERVER['REMOTE_ADDR'];
     	$result_ip=Userip::where([
     		'ip'=> $ipAddress,
     		'links_id'=>$code_id,
     	])->first();
     	if(!$result_ip){
     		Userip::create(['ip'=>$ipAddress,'links_id'=>$code_id]);
     	}else{
     		$result_ip->count=$result_ip->count+1;
     		$result_ip->save();
     	}
     	
     	//USER AGENT
     	$agent = request()->header('user-agent');
     	$result_ag=UserAgent::where([
     		'name'=> $agent,
     		'links_id'=>$code_id,
     	])->first();
     	if(!$result_ag){
     		UserAgent::create([
     			'name'=>$agent,
     			'links_id'=>$code_id
     		]);
     	}else{
     		$result_ag->count=$result_ag->count+1;
     		$result_ag->save();
     	}
        return redirect($findshortenLink->link);
     	}
    	

}

