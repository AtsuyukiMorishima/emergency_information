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
    // if (isset($request['todo-status'])) {
    //   $todo->event_date = $request['todo-status'];
    // }
  
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
    
      // // update
       $todo->save();
    
      // redirect to todo/id page
      return redirect('edit/');
       
      }

}
