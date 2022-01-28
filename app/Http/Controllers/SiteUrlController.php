<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteUrl;
use App\Models\EmergencyEvent;

class SiteUrlController extends Controller
{
    public function deleteTodoById($id, Request $request)
    {
        //   find task
        $todo = SiteUrl::find($id);
  
        // delete
        $todo->delete();
    }
    public function updateTodoById( Request $request)
    {

        $validatedData = $request->validate(
            [
            'URL' => 'required',
            ]
        ); 
    
        // find
        $todo = SiteUrl::find($request['id']);
        $emergencyEvent = EmergencyEvent::find($request['ee_id']);
        // set data
        if (isset($request['URL'])) {
            $todo->URL = $request['URL'];
        }
        if($image = $request->file('event_img')){   
            $destinationPath = 'images/';
            $event_img = date('YmdHis').'.'.$image->getClientOriginalExtension();     
            $image->move($destinationPath, $event_img);
            
            $todo->event_img = $event_img;    
        }else{
            unset($todo['event_img']);
        }
        // if (isset($request['todo-status'])) {
        //   $todo->event_date = $request['todo-status'];
        // }
    
        // // update
        $todo->update();
    
        // redirect to todo/id page
        // return redirect('edit/change');
        $SiteUrl = SiteUrl::all();
          
        return view(
            'event.urledit', [
            'SiteUrl' => $SiteUrl,
            'emergencyEvent' => $emergencyEvent,
            ]
        );
    }
    public function create( Request $request)
    {
        $validatedData = $request->validate(
            [
            'URL' => 'required',
            'registration_date' => 'required',
            'event_tag' => 'required',
            'site_title' => 'required',
            'site_name' => 'required',
            'ee_id' => 'required',
            'event_img' => 'required',
            ]
        ); 
        $todo=new SiteUrl();
       
        // set data
        if (isset($request['ee_id'])) {
               $todo->ee_id = $request['ee_id'];
        }
        if (isset($request['URL'])) {
            $todo->URL = $request['URL'];
        }
        if (isset($request['registration_date'])) {
            $todo->registration_date = $request['registration_date'];
        }
        if (isset($request['event_tag'])) {
            $todo->event_tag = $request['event_tag'];
        }
        if (isset($request['site_title'])) {
            $todo->site_title = $request['site_title'];
        }
        if (isset($request['site_name'])) {
            $todo->site_name = $request['site_name'];
        }
        if($image = $request->file('event_img')){   
            $destinationPath = 'images/';
            $event_img = date('YmdHis').'.'.$image->getClientOriginalExtension();     
            $image->move($destinationPath, $event_img);
            
            $todo->event_img = $event_img;    
        }
             // // update
             $todo->save();
       
             // redirect to todo/id page
             return redirect('urledit/'.$request['ee_id']);
          
    }
  
    
  
    
}
