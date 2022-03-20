@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')
@section('template_linked_css')
<link href="{{ asset('plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
          <h2 style="text-align:center;">災害イベントページの編集</h2>
					<div class="buttons">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>追加</button>
						<button type="button" class="btn btn-success" onclick="show_csv_modal();"><i class="fa fa-file-csv"></i><i class="fas fa-file-excel"></i>csv,xlsxファイルから追加</button>
					</div>
          <div class="modal" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="/edit/create" enctype="multipart/form-data" method="POST" class="form-group">
                  @csrf
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">追加</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="form-group">
                      <label class="form-group-text">災害名<span class="require">*</span></label>
                      <input type="text" class="form-control" name="event_name" required>    
                    </div>
                    <div class="form-group">
                      <label class="form-group-text">タイトル<span class="require">*</span></label>
                      <input type="text" class="form-control" name="event_title" required>
                    </div>
                    <div class="form-group">
                      <label class="form-group-text">内容<span class="require">*</span></label>
                      <input type="text" class="form-control" name="event_body" required>
                    </div>
                    <div class="form-group">
                      <label class="form-group-text">日付<span class="require">*</span></label>
                      <input type="date" class="form-control" name="event_date" required>
                    </div>
                    <div class="form-group">
                      <label class="form-group-text">画像<span class="require">*</span></label>
                      <input type="file" class="form-control" name="event_img" required>    
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
					<div class="modal" id="csvModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <form action="/edit/import" enctype="multipart/form-data" method="POST" class="form-group">
                  @csrf
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">csvまたはxlsxファイルからデータ追加</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="upload-guide-msg">[災害名,タイトル,内容,日付,画像]順序の内容を含む csvまたはxlsxファイルを選択してください。</div>
                      <div class="file-loading">
                        <input id="input-csv-file" name="input-csv-file" type="file" required>
                      </div>
                      <p>追加されるデータは以下の通りです。</p>
                      <input type="hidden" id="import_item_count" name="import_item_count" value="0">
                      <table class="table table-responsive-xl table-striped mt-2 import-table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="15%">災害名</th>
                                <th scope="col" width="15%">タイトル</th>
                                <th scope="col" width="25%">内容</th>
                                <th scope="col" width="15%">日付</th>
                                <th scope="col" width="15%">画像</th>
                                <th scope="col" width="10%"></th>
                            </tr>
                        </thead>
                        <tbody id="imported_csv_content">
                        </tbody>
                    </table>
                    </div>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-dismiss="" >確認</button>
                  </div>
							 </form>
              </div> 
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
                  <a class="btn btn-success" data-toggle="modal" data-target="#myModal-{{ $emergencyEvent->ee_id }}"><i class="fa fa-edit"></i>変更</a>
                  <div class="modal" id="myModal-{{ $emergencyEvent->ee_id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="/edit" method="POST" enctype="multipart/form-data" class="form-group">
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
                              <input type="text" class="form-control" id="event_name" value="{{$emergencyEvent->event_name}}" name="event_name" required>    
                            </div>
                            <div class="form-group">
                              <label class="form-group-text">タイトル:</label>
                              <input type="text" class="form-control" value="{{$emergencyEvent->event_title}}" name="event_title" required>
                            </div>
                            <div class="form-group">
                              <label class="form-group-text">内容:</label>
                              <input type="text" class="form-control" value="{{$emergencyEvent->event_body}}" name="event_body" required>
                            </div>
                            <div class="form-group">
                              <label class="form-group-text">画像:</label>
                              <input type="file" class="form-control" name="event_img">    
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
                  <button type="button" class="btn btn-danger todo-delete-btn" data-id="{{$emergencyEvent->ee_id}}"><i class="fa fa-trash-alt"></i>削除</button>
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
@endsection
@section('script')
<script src="{{ asset('plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

<script type="text/javascript">
	function show_csv_modal(){
    $('#imported_csv_content').html('');
    $('#import_item_count').val("0");
		$("#csvModal").modal("show");
	}

  $(document).on('ready', function() {
    $("#input-csv-file").filer({
        limit: 1,
        maxSize: 1,
        extensions: ['csv', 'xlsx'],
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>ここにcsvファイルをドラッグ&ドロップ</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn btn btn-custom">ファイルを選択</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                <div class="jFiler-item-container">\
                    <div class="jFiler-item-inner">\
                        <div class="jFiler-item-thumb">\
                            <div class="jFiler-item-status"></div>\
                            <div class="jFiler-item-info">\
                                <span class="jFiler-item-title"><b title="\{\{fi-name\}\}">\{\{fi-name | limitTo: 25\}\}</b></span>\
                                <span class="jFiler-item-others">\{\{fi-size2\}\}</span>\
                            </div>\
                            \{\{fi-image\}\}\
                        </div>\
                        <div class="jFiler-item-assets jFiler-row">\
                            <ul class="list-inline pull-left">\
                                <li>\{\{fi-progressBar\}\}</li>\
                            </ul>\
                            <ul class="list-inline pull-right">\
                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                            </ul>\
                        </div>\
                    </div>\
                </div>\
            </li>',
            itemAppend: '<li class="jFiler-item">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-info">\
                                    <span class="jFiler-item-title"><b title="\{\{fi-name\}\}">\{\{fi-name | limitTo: 25\}\}</b></span>\
                                    <span class="jFiler-item-others">\{\{fi-size2\}\}</span>\
                                </div>\
                                \{\{fi-image\}\}\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row">\
                                <ul class="list-inline pull-left">\
                                    <li><span class="jFiler-item-others">\{\{fi-icon\}\}</span></li>\
                                </ul>\
                                <ul class="list-inline pull-right">\
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
        },
        uploadFile: {
            url: "{{ url('edit/uploadcsv') }}",
            data: {'_token': '{{csrf_token()}}'},
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function() {},
            success: function(data, el) {
                logo_data = JSON.parse(data);
                if(logo_data && Object.keys(logo_data).length === 0 && Object.getPrototypeOf(logo_data) === Object.prototype){
                }else{
                    // $("#logo_img").val(logo_data.initialPreviewConfig[0].downloadUrl);
                }

                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function() {
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"fas fa-plus\"></i> 成功</div>")
                        .hide().appendTo(parent).fadeIn("slow");
                });

                var sHTML = '';
                for(var i=1; i<logo_data.arrCsvData.length; i++){
                  sHTML += '<tr id="data_'+i+'">';
                    sHTML += '<th scope="row">'+i+'</th>';
                    if(logo_data.arrCsvData[i][0] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][0]+'<input type="hidden" name="import_event_name_'+i+'" value="'+logo_data.arrCsvData[i][0]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][1] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][1]+'<input type="hidden" name="import_event_title_'+i+'" value="'+logo_data.arrCsvData[i][1]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][2] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][2]+'<input type="hidden" name="import_event_body_'+i+'" value="'+logo_data.arrCsvData[i][2]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][3] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][3]+'<input type="hidden" name="import_event_date_'+i+'" value="'+logo_data.arrCsvData[i][3]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][4] != undefined){
                      sHTML += '<td><img src="'+logo_data.arrCsvData[i][4]+'"><input type="hidden" name="import_event_img_'+i+'" value="'+logo_data.arrCsvData[i][4]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    sHTML += '<td><button type="button" class="btn btn-danger" onclick="remove_item(\''+i+'\');"><i class="fa fa-trash-alt"></i>削除</button></td>';
                  sHTML += '<tr>';
                }
                $("#import_item_count").val(logo_data.arrCsvData.length);
                $("#imported_csv_content").html( sHTML );
            },
            error: function(el) {
                logo_data = {};
                // $("#logo_img").val("");
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function() {
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"fas fa-minus\"></i> エラー</div>")
                        .hide().appendTo(parent).fadeIn("slow");
                });
                $("#imported_csv_content").html("");
            },
            statusCode: null,
            onProgress: null,
            onComplete: null
        },
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
            //var file = file.name;
            if(logo_data && Object.keys(logo_data).length === 0 && Object.getPrototypeOf(logo_data) === Object.prototype){
            }else{
                var file = logo_data.initialPreviewConfig[0].key;
                $.post("{{ url('edit/deletecsv') }}", {
                    'file': file,
                    '_token': '{{csrf_token()}}'
                });
            }
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "ファイルを選択",
            feedback: "アップロードするファイルを選択",
            feedback2: "ファイルが選択されました",
            drop: "ここにアップロードするファイルをドロップ",
            removeConfirmation: "このファイルを削除しますか？",
            errors: {
                filesLimit: "アップロードできるのは\{\{fi-limit\}\}ファイルのみです。",
                filesType: "アップロードできるのはcsvまたはxlsxファイルのみです。",
                filesSize: "\{\{fi-name\}\}が大きすぎます！ \{\{fi-maxSize\}\}MBまでのファイルをアップロードしてください。",
                filesSizeAll: "選択したファイルが大きすぎます！ \{\{fi-maxSize\}\}MBまでのファイルをアップロードしてください。"
            }
        }
    });
  });
  
  function remove_item(row_number){
    $("#data_"+row_number).remove();
  }
</script>
@endsection
