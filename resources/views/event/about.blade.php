@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'event-about')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        災害情報ポータル
        <br class="d-sm-none">
        プロジェクトについて
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
    <div class="card shadow">
        <div class="card-head text-center">
            <h2 class="head-title">緊急ポータルサイト</h2>
        </div>
        <div class="card-body">
            <p class="card-text text-secondary">
                災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。
                災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。
                災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。災害情報ポータルプロジェクトについての説明。
            </p>
        </div>
    </div>
@endsection