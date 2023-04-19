@extends('layout/home')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="card card-custom gutter-b card-stretch">
    <!--begin::Body-->
    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center py-1">
            <!--begin:Pic-->
            <div class="symbol symbol-80 symbol-light-danger mr-5">
                <span class="symbol-label">
                    <img src="/storage/{{$user->profile_photo}}" class="h-50 align-self-center" alt="">
                </span>
            </div>
            <!--end:Pic-->

            <!--begin:Title-->
            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                <a  class="text-dark font-weight-bolder text-hover-primary font-size-h5">
                    {{$user->name}}<br>
                </a>
                <p>{{$user->email}}</p>
                <span class="text-muted font-weight-bold font-size-lg">
                    Joined On: {{Str::substr($user->created_at, 0, 10)}}
                </span>
                <span class="total-followers text font-weight-bold font-size-lg mt-2">
                    {{$user->counts_count}} Followers
                </span>
            </div>
            @php
             $containsUser = $user->counts->contains(function ($count, $key) {
                 return $count->user_id === Auth::user()->id;
             });
             @endphp
            <span id="follow{{$user->id}}" class="follow label label-xl  label-pill label-inline mr-2
            @if(Auth::check() && $containsUser)
              label-success " > Following </span>
            @else
                label-info " style="cursor:pointer"> + Follow</span>
            @endif 
            
            <!--end:Title-->

            <!--begin:Stats-->
            
                <!-- <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">
                    Rating
                </span> -->
                <!-- <div class="progress progress-xs w-100">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
            </div>
            <div class="d-flex" id="user_rating">
            @for ($i = 1 ; $i <= floor($rating); $i++)
            <div  class="d-flex flex-row  my-5">
                        <div class="fa-item col-md-3 col-sm-4">
                          <i class="fa fa-star"></i></div>                         
                        </div>
               @endfor
           
            
            </div>
    <form id="rating_form" action="/ratings" method="POST">
  @csrf
  <input type="hidden" name="rated_user_id" value="{{ $user->id }}">
  <div class="form-group ">
  <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">
                    Rating
                </span>
            
    <select class="form-control w-25" id="rating" name="rating">
      <option value="1">1 star</option>
      <option value="2">2 stars</option>
      <option value="3">3 stars</option>
      <option value="4">4 stars</option>
      <option value="5">5 stars</option>
    </select>
  </div>
  <!-- <button type="submit" class="btn btn-primary">Submit Rating</button> -->
  <button id="rateUser" class="btn btn-light-dark font-weight-bold ">Rate User</button>
</form>
            <!--end:Stats-->

            
            <!--begin:Team-->
            <!-- <div class="d-flex flex-column mt-10">
                <div class="text-dark mr-2 font-size-lg font-weight-bolder pb-4">
                    Team
                </div>

                <div class="d-flex">
                    <a href="#" class="symbol symbol-50 symbol-light-danger mr-3">
                        <div class="symbol-label">
                            <img src="/metronic/theme/html/demo8/dist/assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" alt="">
                        </div>
                    </a>

                   
                </div>
            </div> -->
            <!--end:Team-->
        </div>
    </div>
    <!--end::Body-->
</div>

@endsection
