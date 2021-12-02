@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'event-edit')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
    災害イベントページの   
        <br class="d-sm-none">
        編集
    </span>
    <span></span>
@endsection

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <div class="container">
                  <div>
                    <h2 style="text-align:center;">災害イベントページの編集</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">追加</button>
                    <div class="modal" id="myModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/edit/create" method="POST" class="form-group">
                                        @csrf
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">追加</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">

                                           <div class="form-group">
                                             <label class="form-group-text">災害名:</label>
                                             <input type="text" class="form-control" name="event_name">    
                                           </div>
                                           <div class="form-group">
                                             <label class="form-group-text">タイトル:</label>
                                             <input type="text" class="form-control" name="event_title">
                                           </div>
                                          <div class="form-group">
                                             <label class="form-group-text">内容:</label>
                                             <input type="text" class="form-control" name="event_body">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">日付:</label>
                                             <input type="date" class="form-control" name="event_date">
                                          </div>

                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >追加</button>
                                     </div>
                                     </form>
                                    </div>
                                  </div>
                                </div>                          
                  </div>
                  <div>
                  <table class="table table-bordered" style="text-align:center;overflow-wrap:anywhere;">
                    <thead class="table-primary">
                      <tr>
                         <th>災害名</th>
                         <th>タイトル</th>
                         <th>内容</th>
                         <th>編集</th>
                      </tr>
                    </thead>
                    @forelse ($emergencyEvent->sortByDesc('event_date') as $emergencyEvent)
                    <tbody>
                      <tr>
                         <td>{{$emergencyEvent->event_name}}</td>
                         <td>{{$emergencyEvent->event_title}}</td>
                         <td>{{$emergencyEvent->event_body}}</td>

                         <td>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-success" data-toggle="modal" data-target="#myModal-{{ $emergencyEvent->ee_id }}">変更</a>
                                
                                <div class="modal" id="myModal-{{ $emergencyEvent->ee_id }}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/edit" method="POST" class="form-group">
                                        @csrf
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">変更</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                           <div class="form-group">
                                             <label class="form-group-text">災害名:</label>
                                             <input type="text" class="form-control" id="event_name" value="{{$emergencyEvent->event_name}}" name="event_name">    
                                           </div>
                                           <div class="form-group">
                                             <label class="form-group-text">タイトル:</label>
                                             <input type="text" class="form-control" value="{{$emergencyEvent->event_title}}" name="event_title">
                                           </div>
                                          <div class="form-group">
                                             <label class="form-group-text">内容:</label>
                                             <input type="text" class="form-control" value="{{$emergencyEvent->event_body}}" name="event_body">
                                          </div>
                                          <input style="display:none;" value="{{$emergencyEvent->ee_id}}" name="id">
                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >変更</button>
                                     </div>   
                                     </form>
                                    </div>
                                  </div>
                                </div>       
                                <button type="button" class="btn btn-danger todo-delete-btn" data-id="{{$emergencyEvent->ee_id}}">削除</button>
                             </div>
                         </td>
                      </tr>
                    </tbody>
                    @empty
                    <span>No Found.</span>
                    @endforelse
                  </table>
                  </div>
            </div>
        </div>
    </div>
@endsection