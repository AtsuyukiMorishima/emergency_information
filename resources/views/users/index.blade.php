@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'user-index')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        ユーザー管理   
    </span>
    <span>
		@auth
        <a href="{{ route('logout') }}" title="ログアウト">
			<i class="fas fa-sign-out-alt text-light"></i>
        </a>
		@else
        <a href="{{ route('login') }}" title="ログイン">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
        </a>
		@endauth
    </span>
@endsection

@section('contents')
@if (session('flash_sucess'))
<div class="alert alert-dismissible alert-success">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{ session('flash_sucess') }}
</div>
@endif

@if (session('flash_error'))
<div class="alert alert-dismissible alert-danger">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{ session('flash_error') }}
</div>
@endif

    <div class="card shadow">
        <div class="card-body">
            <div class="container">
                  <div>
                    <h2 style="text-align:center;">ユーザー管理</h2>
                  </div>
                  <div>
                  <table class="table table-bordered" style="text-align:center;overflow-wrap:anywhere;">
                    <thead class="table-primary">
                      <tr>
                         <th>ユーザー名</th>
                         <th>メールアドレス</th>
                         <th>権限Lv<br>(管理者の場合は30以上)</th>
                         <th>編集</th>
                      </tr>
                    </thead>
                    @forelse ($users as $user)
                    <tbody>
                      <tr>
                         <td>{{$user->name}}</td>
                         <td>{{$user->email}}</td>
                         <td>{{intval($user->authority_level)}}</td>

                         <td>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-success" data-toggle="modal" data-target="#myModal-{{ $user->id }}">変更</a>
                                
                                <div class="modal" id="myModal-{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/useredit" method="POST" class="form-group">
                                        @csrf
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">変更</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                           <div class="form-group">
                                             <label class="form-group-text">権限Lv:</label>
                                             <input type="number" class="form-control" id="authority_level" value="{{$user->authority_level}}" name="authority_level" required>    
                                           </div>
                                          <input type="hidden" value="{{$user->id}}" name="id">
                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >変更</button>
                                     </div>   
                                     </form>
                                    </div>
                                  </div>
                                </div>       
                                <button type="button" class="btn btn-danger todo-delete-btn" data-id="{{$user->ee_id}}">削除</button>
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