@extends('layouts.app')


@section('title_postfix')
FAQs and Help
@stop

@section('page_title')
FAQs and Help
@stop

@php
$current_user = Auth()->user();
@endphp
@section('content')

@include('flash::message')

<div class="col-sm-9">
  <div class="panel panel-default card-view">

    <div class="panel-heading" style="padding: 10px 15px;">
      <div class="pull-left"></div>
      @if($current_user->is_platform_admin == true)
      <div class="pull-right">
        <a id="btn-new-mdl-faq-modal" href="#" class="btn btn-xs btn-default btn-new-mdl-faq-modal"><i
            class="zmdi zmdi-help"></i>&nbsp;Add FAQ or Help</a>
      </div>
      @endif
      <div class="clearfix"></div>
    </div>

    <div class="panel-wrapper collapse in">
      <div class="panel-body">

        <div class="row">
          <h1>Helpful Information</h1>
          <div class="faq-container">
            @foreach($helps as $help)
            <div class="faq">
              <h3 class="faq-title">{{ $help->question }}?</h3>
              <p class="faq-text">{{ $help->answer }}</p>
              <button class="faq-toggle">
                <i class="fa fa-chevron-down"></i>
              </button>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <script type="text/javascript">
      const toggles = document.querySelectorAll(".faq-toggle");
        toggles.forEach((toggle) => {
          toggle.addEventListener("click", () => {
            toggle.parentNode.classList.toggle("active");
          });
        });
    </script>
  </div>
</div>
<div class="col-sm-3">
  @include("dashboard.partials.side-panel")
</div>
@include('faqs.modal')
@endsection