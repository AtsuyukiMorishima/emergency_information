@extends('layouts.base')

@section('title',  "災害情報ポータルサイト")

@section('body_id', 'event-urledit')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
    災害Event   
        <br class="d-sm-none">
        ページ
    </span>
    <span></span>
@endsection

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <p class="card-text text-secondary">
            <div class="container">
                  <div>
                    <h2 style="text-align:center;">災害Eventページ</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">追加</button>
                  </div>
                  <table class="table table-bordered" style="text-align:center;overflow-wrap:anywhere;}">
                    <thead class="table-primary">
                      <tr>
                         <th>タイトル</th>
                         <th>URL</th>
                         <th>災害名</th>
                         <th>編集</th>
                      </tr>
                    </thead>
                    @forelse ($SiteUrls->sortByDesc('registration_date') as $siteUrl)
                    <tbody>
                      <tr style="overflow-wrap:anywhere;">
                         <td>{{$siteUrl->site_title}}</td>
                         <td>{{$siteUrl->URL}}</td>
                         <td>{{$siteUrl->site_name}}</td>
                         <td>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-success" data-toggle="modal" data-target="#myModal-{{ $siteUrl->site_id }}">変更</a>
                                
                                <div class="modal" id="myModal-{{ $siteUrl->site_id }}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/urledit" method="POST" class="form-group">
                                        @csrf
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">変更</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                          <div class="form-group">
                                             <label class="form-group-text">Url:</label>
                                             <input type="text" class="form-control" value="{{$siteUrl->URL}}" name="URL">
                                          </div>
                                          <input style="display:none;" value="{{$siteUrl->site_id}}" name="id">
                                          <input style="display:none;" value="{{$siteUrl->ee_id}}" name="ee_id">
                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >変更</button>
                                     </div>
                                     </form>
                                    </div>
                                  </div>
                                </div>
                                                            
                                <button type="button" class="btn btn-danger url-delete-btn" data-ID="{{$siteUrl->site_id}}">削除</button>
                             </div>
                         </td>
                      </tr>
                    </tbody>
                    @empty
                    <span>No Found.</span>
                    @endforelse
                  </table>
                  <div class="modal" id="myModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/urledit/create" method="POST" class="form-group">
                                        @csrf
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">追加</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                          <div class="form-group">
                                             <label class="form-group-text">日付:</label>
                                             <input type="date" class="form-control" name="registration_date">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">種類:</label>
                                             <select name="event_tag" class="custom-select">
                                               <option value="1">地震</option>
                                               <option value="2">水害</option>
                                               <option value="3">台風</option>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">災害名:</label>
                                             <input type="text" class="form-control" name="site_name">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">Url:</label>
                                             <input type="text" class="form-control" name="URL">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">タイトル:</label>
                                             <input type="text" class="form-control" name="site_title">
                                          </div>
                                          <input style="display:none;" value="{{$emergencyEvent}}" name="ee_id">
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
            </p>
        </div>
    </div>
@endsection
