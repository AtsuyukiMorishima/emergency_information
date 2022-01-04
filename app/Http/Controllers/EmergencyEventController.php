<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use Illuminate\Contracts\View\View;

class EmergencyEventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View 
     */
    
    public function index(Request $request)
    {
        $data = '';
        // $emergencyEvents = EmergencyEvent::all();
            $emergencyEvents = EmergencyEvent::paginate('6'); 
        // return view('event.index', [
        //     'emergencyEvents' => $emergencyEvents,
        // ]);

        if ($request->ajax()) {
            foreach ($emergencyEvents as $result) {
            $data .=  '<div class="card shadow-sm">
                            <div class="card">
                                <a href="/'.$result->ee_id.'">
                                    <img class="card-img-top" src="img/'.$result->ee_id.'.jpg" style="width:100%">
                                </a>
                                    <div class="card-img-overlay" style="position:relative;">
                                        <h5 class="card-text">'. $result->event_name .'</h5>
                                        <h6 class="card-text text-secondary">'. $result->event_title .'</h6>
                                        <h7 class="card-text">'. $result->event_body .'</h7>
                                    </div>
                            </div>
                        </div>';
                }
            return $data;
        }
        return view('event.index');
    }



    /**
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id, Request $request): View
    {
        $emergencyEvent = EmergencyEvent::findOrFail($id);
        $SiteUrl = SiteUrl::all();
        $sort = $request['event_tag'];  

        return view(
            'event.show', [
            'emergencyEvent' => $emergencyEvent,
            'sort' => $sort
            ]
        );
    }
    public function editlist():View
    {
        $emergencyEvent = EmergencyEvent::all();
        
        return view(
            'event.edit', [
            'emergencyEvent' => $emergencyEvent,
            ]
        );
    }
    public function urledit(int $id):View
    {
        $emergencyEvent = EmergencyEvent::where('ee_id', $id)->first();
        if($emergencyEvent == null) {
            var_dump("Error");
            exit;    
        }
        $SiteUrl = SiteUrl::where('ee_id', $id)->get();
        // var_dump($emergencyEvent['ee_id']);
        // var_dump($SiteUrl);
        // exit;
        // consoel.log
        return view(
            'event.urledit', [
            'emergencyEvent' => $emergencyEvent['ee_id'],
            'SiteUrls' => $SiteUrl,
            ]
        );
    }

    
    public function favorVote(Request $request){
        $sitename = $request->input('site_name');            
        $selectedSite = SiteUrl::where('site_name',$sitename)->get();  
        var_export($selectedSite);
        $selectedSite->site_favor = $request->input('sitefavor') ;     
        // $selectedSite = SiteUrl::find($selectedSite->site_id);
        // $selectedSite->site_favor = $request->input('site_favor');   
        // $selectedSite->();

        return $selectedSite;
    }

    public function startwork(Request $req) {

    }
}
