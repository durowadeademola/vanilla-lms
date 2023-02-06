@extends('layouts.app')


@section('title_postfix')
@if (isset($department) && $department!=null)
{{ $department->name }}
@endif
@stop

@section('page_title')
@if (isset($department) && $department!=null)
{{ $department->name }}  <a id="btn-show-bulk-student-courseClass-enrollment-modal" href="#" class="btn btn-danger btn-xs pull-right" style="color: white"><i class="icon wb-reply" aria-hidden="true"></i>Bulk Student Course Class Enrollment</a>
@endif
@stop



@section('content')
    
    @include('flash::message')

    <div class="col-sm-9">
        <div class="row">
            @include('dashboard.manager.partials.department-stats')
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        @include('dashboard.manager.partials.pending_enrollment')
                    </div>
                    <div class="col-sm-12">
                        @include('dashboard.manager.partials.announcements')
                    </div>
                    
                     <div class="col-sm-12">
                         @include('dashboard.manager.partials.course-catalog')
                    </div>
                   
                </div>
               
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        @include('dashboard.manager.partials.class-schedule')
                    </div>
                    <div class="col-sm-12">
                        @include('dashboard.manager.partials.department-calendar')
                    </div>
                </div>
            </div>
        </div>
              
    </div>
    <div class="col-sm-3">
        @include("dashboard.partials.side-panel")
    </div>
    @include('dashboard.manager.modals.modify-student')
@endsection

@push('app_js')
<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
@endpush