@extends('layout/home')

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
            </div>
            <!--end:Title-->

            <!--begin:Stats-->
            <div class="d-flex flex-column w-100 mt-12">
                <span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">
                    Rating
                </span>

                <!-- <div class="progress progress-xs w-100">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
            </div>
            <!--end:Stats-->

            <!--begin:Team-->
            <div class="d-flex flex-column mt-10">
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
            </div>
            <!--end:Team-->
        </div>
    </div>
    <!--end::Body-->
</div>

@endsection
