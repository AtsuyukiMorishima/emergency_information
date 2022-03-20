@extends('layouts.base')

@section('title',  "災害情報ポータルサイト")
@section('template_linked_css')
<link href="{{ asset('plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
            <p class="card-text text-secondary">
            <div class="container">
                  <div>
                    <h2 style="text-align:center;">災害Eventページ</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">追加</button>
                    <button type="button" class="btn btn-success" onclick="show_csv_modal();"><i class="fa fa-file-csv"></i><i class="fas fa-file-excel"></i>csv,xlsxファイルから追加</button>
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
                                
                                <div class="modal" id="myModal-{{ $siteUrl->site_id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                             <label class="form-group-text">Url<span class="require">*</span></label>
                                             <input type="text" class="form-control" value="{{$siteUrl->URL}}" name="URL" required>
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
                  <div class="modal" id="myModal"  data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="/urledit/create" method="POST" enctype="multipart/form-data" class="form-group">
                          @csrf
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">追加</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="form-group">
                                <label class="form-group-text">日付<span class="require">*</span></label>
                                <input type="date" class="form-control" name="registration_date" required>
                            </div>
                            <div class="form-group">
                                <label class="form-group-text">種類<span class="require">*</span></label>
                                <select name="event_tag" class="custom-select" required>
                                  <option value="1">地震</option>
                                  <option value="2">水害</option>
                                  <option value="3">台風</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-group-text">災害名<span class="require">*</span></label>
                                <input type="text" class="form-control" name="site_name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-group-text">Url<span class="require">*</span></label>
                                <input type="text" class="form-control" name="URL" required>
                            </div>
                            <div class="form-group">
                                <label class="form-group-text">タイトル<span class="require">*</span></label>
                                <input type="text" class="form-control" name="site_title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-group-text">画像<span class="require">*</span></label>
                                <input type="file" class="form-control" name="event_img" required>    
                              </div>
                            <input type="hidden" value="{{$emergencyEvent}}" name="ee_id">
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
                        <form action="/urledit/import" enctype="multipart/form-data" method="POST" class="form-group">
                          @csrf
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">csvまたはxlsxファイルからデータ追加</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="form-group">
                              <div class="upload-guide-msg">[日付,種類,災害名,Url,タイトル,画像]順序の内容を含む csvまたはxlsxファイルを選択してください。</div>
                              <div class="file-loading">
                                <input id="input-csv-file" name="input-csv-file" type="file" required>
                              </div>
                              <p>追加されるデータは以下の通りです。</p>
                              <input type="hidden" id="import_item_count" name="import_item_count" value="0">
                              <input type="hidden" name="ee_id" value="{{$emergencyEvent}}">
                              <table class="table table-responsive-xl table-striped mt-2 import-table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">日付</th>
                                        <th scope="col" width="10%">種類</th>
                                        <th scope="col" width="15%">災害名</th>
                                        <th scope="col" width="15%">Url</th>
                                        <th scope="col" width="15%">タイトル</th>
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
              </p>
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
            url: "{{ url('urledit/uploadcsv') }}",
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
                      sHTML += '<td>'+logo_data.arrCsvData[i][0]+'<input type="hidden" name="import_registration_date_'+i+'" value="'+logo_data.arrCsvData[i][0]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][1] != undefined){
                      var event_tag = '';
                      if(logo_data.arrCsvData[i][1] == '1')
                        event_tag = '地震';
                      else if(logo_data.arrCsvData[i][1] == '2')
                        event_tag = '水害';
                      else if(logo_data.arrCsvData[i][1] == '3')
                        event_tag = '台風';

                      sHTML += '<td>'+event_tag+'<input type="hidden" name="import_event_tag_'+i+'" value="'+logo_data.arrCsvData[i][1]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][2] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][2]+'<input type="hidden" name="import_site_name_'+i+'" value="'+logo_data.arrCsvData[i][2]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][3] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][3]+'<input type="hidden" name="import_url_'+i+'" value="'+logo_data.arrCsvData[i][3]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][4] != undefined){
                      sHTML += '<td>'+logo_data.arrCsvData[i][4]+'<input type="hidden" name="import_site_title_'+i+'" value="'+logo_data.arrCsvData[i][4]+'"></td>';
                    }else{
                      sHTML += '<td></td>';
                    }
                    if(logo_data.arrCsvData[i][5] != undefined){
                      sHTML += '<td><img src="'+logo_data.arrCsvData[i][5]+'"><input type="hidden" name="import_event_img_'+i+'" value="'+logo_data.arrCsvData[i][5]+'"></td>';
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
                $.post("{{ url('urledit/deletecsv') }}", {
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
