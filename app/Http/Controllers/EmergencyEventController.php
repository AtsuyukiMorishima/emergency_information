<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use Illuminate\Contracts\View\View;
use DB;

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
        $sort_by_favor = 'site_favor';
        // var_dump($sort_by_favor);

        return view(
            'event.show', [
            'emergencyEvent' => $emergencyEvent,
            'sort' => $sort,
            'sort_by_favor' => $sort_by_favor
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
        // $selectedSite = SiteUrl::find();
        // $sitename = "new wind";
        $favorNum = $selectedSite[0]['site_favor'];
        $favorNum = $favorNum + 1; 
        DB::update('UPDATE site_url SET site_favor = ? WHERE site_name = ?', [$favorNum, $sitename]);  
        $data = DB::select('select site_favor from site_url where site_name =?', [$sitename]);   
             
        echo json_encode($data);
    }

}
