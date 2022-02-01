<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyEvent;

class DbController extends Controller
{

    public function deleteTodoById($id, Request $request)
  {
    //   find task
     $todo = EmergencyEvent::find($id);

      // delete
     $todo->delete();
  }
    public function updateTodoById( Request $request)
  {
   $validatedData = $request->validate([
      'event_title' => 'required',
      'event_name' => 'required',
      'event_body' => 'required',      
    ]); 
  
    // find
    $todo = EmergencyEvent::find($request['id']);
  
    // set data
    if (isset($request['event_title'])) {
      $todo->event_title = $request['event_title'];
    }
    if (isset($request['event_name'])) {
      $todo->event_name = $request['event_name'];
    }
    if(isset($request['event_body'])){
      $todo->event_body = $request['event_body'];
    }
    if (isset($request['todo-status'])) {
      $todo->event_date = $request['todo-status'];
    }
    if($image = $request->file('event_img')){   
      $destinationPath = 'images/';
      $event_img = date('YmdHis').'.'.$image->getClientOriginalExtension();     
      $image->move($destinationPath, $event_img);
      
      $todo->event_img = $event_img;             
    }else {
      unset($todo['event_img']);
    }
 
    // // update
     $todo->update();
  
    // redirect to todo/id page
    // return redirect('edit/change');
    $emergencyEvent = EmergencyEvent::all();
        
    return view('event.edit', [
        'emergencyEvent' => $emergencyEvent,
    ]);
    }

   public function create( Request $request)
   {

    $validatedData = $request->validate([
        'event_title' => 'required',
        'event_name' => 'required',
        'event_body' => 'required',
        'event_date' => 'required',
        'event_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      ]); 
       $todo=new EmergencyEvent();
    
      // set data
      if (isset($request['event_title'])) {
        $todo->event_title = $request['event_title'];
      }
      if (isset($request['event_date'])) {
        $todo->event_date = $request['event_date'];
      }
      if (isset($request['event_name'])) {
        $todo->event_name = $request['event_name'];
      }
      if (isset($request['event_body'])){
        $todo->event_body = $request['event_body'];
      }                                                 
          var_export($request->file('event_img'));
          // exit; 
        if($image = $request->file('event_img')){   
          $destinationPath = 'images/';
          $event_img = date('YmdHis').'.'.$image->getClientOriginalExtension();     
          $image->move($destinationPath, $event_img);
          
          $todo->event_img = $event_img;         
        
      }
    
      // // update
       $todo->save();
    
      // redirect to todo/id page
      return redirect('edit/');
       
      }

}
