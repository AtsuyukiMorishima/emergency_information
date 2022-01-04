@extends('layouts.base')

@section('title', "{$emergencyEvent->event_title} - 災害情報ポータルサイト")

@section('body_id', 'event-show')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        {{ $emergencyEvent->event_date->format('n月j日') }}
        <br class="d-sm-none">
        {{ $emergencyEvent->event_title }}
    </span>
    <span>
        <a href="{{ route('event.urledit', ['ee_id' => $emergencyEvent->ee_id])  }}">
            <i class="fas fa-lg fa-edit text-light"></i>
        </a>
    </span>
@endsection

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-secondary">ニュース一覧</h5>
            <div class="navbar navbar-light bg-light fixed-bottom cust-header navbar-urledit">
           <div class="input-group mt-3 mb-3">
                <div class="input-group-prepend">
                 <form action='{{$emergencyEvent->ee_id}}' method="POST">
                  {{csrf_field()}}
                   <select type="button" class="form-control btn-primary" id="event_tag" name="event_tag" onchange="this.form.submit()">
                     <!-- <option type="hidden" style="display:none;"></option> -->
                     <option value="0" @if ($sort==0) selected="selected" @endif>全体</option>
                     <option value="1" @if ($sort==1) selected="selected" @endif>地震</option>
                     <option value="2" @if ($sort==2) selected="selected" @endif>水害</option>
                     <option value="3" @if ($sort==3) selected="selected" @endif>台風</option>
                   </select>
                 </form>
                </div>
                <input type="text" id="myInput" class="form-control" placeholder="検索">
                <div class="input-group-append">
                  <div class="form-group form-check">
                    <div class="row">
                      <div class="col-sm-6">
                        <i class="fas fa-lg fa-thumbs-up text-primary"></i>
                      </div>
                      <div class="col-sm-6">
                       <input type="checkbox" class="form-check-input" name="event_allow">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
            <ul class="list-group list-group-flush"   id="keyword_serch">
              @if($sort==0||null)
                  @forelse ($emergencyEvent->SiteUrls->sortByDesc('registration_date') as $siteUrl)
                  <li class="list-group-item">
                     <div class="row">
                      <div class="col-sm-10" >
                          <div class="container">
                           <div class="media p-3">
                             <a href="{{$emergencyEvent->event_title}}/{{ $siteUrl->URL }}" >
                               <img src="img/2.jpg" class="mr-3 rounded-circle" style="width:47px;">
                             </a>
                             <div class="media-body">
                              <h5 class="text-secondary" id="sitename" style="overflow-wrap:anywhere;">{{$siteUrl->site_name}}</h5>
                              <h6 class="card-text text-secondary">{{ $siteUrl->site_title }}</h6>
                              <button class="btn btn-outline-danger allow" id="favorBtn">
                                <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light" id="site_favor">{{ $siteUrl->site_favor }}</span></i>
                              </button>
                             </div>
                           </div>
                          </div>
                      </div>
          
                     </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <span class="text-secondary">Not found.</span>
                    </li>
                @endforelse
              @else
                  @forelse ($emergencyEvent->SiteUrls->where('event_tag',$sort)->sortByDesc('registration_date') as $siteUrl)              
                    <li class="list-group-item">
                     <div class="row">
                      <div class="col-sm-10" >
                          <div class="container">
                           <div class="media p-3" >
                           <a href="{{$emergencyEvent->event_title}}/{{ $siteUrl->URL }}" >
                             <img src="img/2.jpg" class="mr-3 rounded-circle" style="width:47px;">
                           </a>
                             <div class="media-body">
                              <h5 class="text-secondary" id="sitename"  style="overflow-wrap:anywhere;">{{$siteUrl->site_name}}</h5>
                              <h6 class="card-text text-secondary">{{ $siteUrl->site_title }}</h6>
                              <button class="btn btn-outline-danger allow" id="favorBtn">
                                   <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light" id="site_favor"></span>{{$siteUrl->site_favor}}</i>
                              </button>
                             </div>
                           </div>
                          </div>
                      </div>
                      <!-- <div class="col-sm-2">
                        <div class="btn-group btn-group-sm">   
                         <button class="btn btn-outline-danger">
                          <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light">4</span></i>
                         </button>
                        </div>
                      </div> -->
                     </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        <span class="text-secondary">Not found.</span>
                    </li>
                @endforelse
                @endif
            </ul>
        </div>
    </div>
    <script>
      $("#favorBtn").click(function(){
        console.log("ere")
      })
    </script>
@endsection

