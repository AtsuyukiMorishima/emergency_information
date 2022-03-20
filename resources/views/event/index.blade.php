@extends('layouts.base')

@section('title', '災害情報ポータルサイト')

@section('body_id', 'event-index')

@section('navbar')
    <span class="navbar-brand mx-0 text-center text-light">災害情報ポータルサイト</span>
    <span></span>
    <span>
		@auth
        <?php if(intval(Auth::user()->authority_level) >= 30){ ?>
        <a href="{{ route('event.edit') }}" title="イベントページの編集">
            <i class="fas fa-lg fa-edit text-light"></i>
        </a>
        <a href="{{ route('user.index') }}" title="ユーザー管理">
            <i class="fas fa-lg fa-user-edit text-light"></i>
        </a>
        <?php } ?>
		@endauth
        <a href="{{ route('event.about') }}" title="災害情報ポータル プロジェクトについて">
            <i class="fas fa-lg fa-info-circle text-light"></i>
        </a>
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
    <div class="row row-cols-1 row-cols-md-2 mx-0"  id="data-wrapper">
        <!-- Data Loader -->
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>
@endsection

@section('script')
<script>
    
    var ENDPOINT = "{{ url('/') }}";
    var page = 1;
    infinteLoadMore(page);
    $('.auto-load').hide();

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    // $('.auto-load').html("We don't have more data to display :(");
                    $('.auto-load').hide();
                    return;
                }
                $('.auto-load').hide();
                
                $("#data-wrapper").append(response);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
@endsection

