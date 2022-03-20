<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyEvent;

class DbController extends Controller
{

  public function deleteTodoById($id, Request $request)
  {
    try {
      //   find task
      $todo = EmergencyEvent::find($id);

        // delete
      $todo->delete();
      session()->flash('flash_sucess', 'データの削除が完了しました');
    } catch (\Throwable $e) {
        session()->flash('flash_error',  'データ削除に失敗しました');
    }
  }
    public function updateTodoById( Request $request)
  {
    try {
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
      session()->flash('flash_sucess', 'データの更新が完了しました');
    } catch (\Throwable $e) {
        session()->flash('flash_error',  'データ登録に失敗しました');
    }

    // redirect to todo/id page
    // return redirect('edit/change');
    $emergencyEvent = EmergencyEvent::all();
        
    return view('event.edit', [
        'emergencyEvent' => $emergencyEvent,
    ]);
    }

  public function create( Request $request)
  {
    try {
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
      session()->flash('flash_sucess', 'データの登録が完了しました');
    } catch (\Throwable $e) {
      session()->flash('flash_error',  'データ登録に失敗しました');
    }
    // redirect to todo/id page
    return redirect('edit/');
  }

  public function import( Request $request)
  {
    try {
      $import_item_count = intval($request['import_item_count']);
      for($i=0; $i<$import_item_count; $i++){
        $todo=new EmergencyEvent();
        if (isset($request['import_event_name_'.$i]) && $request['import_event_name_'.$i] != '') {
          $todo->event_name = $request['import_event_name_'.$i];
        }else{
          continue;
        }
        // set data
        if (isset($request['import_event_title_'.$i])) {
          $todo->event_title = $request['import_event_title_'.$i];
        }
        if (isset($request['import_event_body_'.$i])) {
          $todo->event_body = $request['import_event_body_'.$i];
        }
        if (isset($request['import_event_date_'.$i])) {
          $todo->event_date = $request['import_event_date_'.$i];
        }
        if (isset($request['import_event_img_'.$i])){
          $todo->event_img = $request['import_event_img_'.$i];
        }
        $todo->save();
      }

      session()->flash('flash_sucess', 'データの登録が完了しました');
    } catch (\Throwable $e) {
      session()->flash('flash_error',  'データ登録に失敗しました');
    }
    // redirect to todo/id page
   return redirect('edit/');
  }  
}
