@extends('layouts.app')


@section('title_postfix')
Courses
@stop

@section('page_title')
Courses
@stop



@section('content')
    
    @include('flash::message')

    <div class="col-sm-9">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                    <div class="table-wrap">
                        <div class="table-responsive">
                            @include('courses.table')

                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-3">
        @include("dashboard.partials.side-panel")
    </div>

    @include('courses.modal')
@endsection

