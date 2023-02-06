

<div class="modal fade" id="mdl-setting-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-setting-modal-title" class="modal-title">Setting</h4>
            </div>

            <div class="modal-body">
                <div id="div-setting-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-setting-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            @csrf

                            <input type="hidden" id="txt-setting-primary-id" value="0" />
                            <div id="div-show-txt-setting-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('settings.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-setting-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('settings.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-setting-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@section('js-113')
<script type="text/javascript">
$(document).ready(function() {

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-setting-modal", function(e) {
        $('#div-setting-modal-error').hide();
        $('.input-border-error').removeClass("input-border-error");
        $('#mdl-setting-modal').modal('show');
        $('#frm-setting-modal').trigger("reset");
        $('#txt-setting-primary-id').val(0);

        $('#div-show-txt-setting-primary-id').hide();
        $('#div-edit-txt-setting-primary-id').show();
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-setting-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-show-txt-setting-primary-id').show();
        $('#div-edit-txt-setting-primary-id').hide();
        let itemId = $(this).attr('data-val');

        // $.get( "{{URL::to('/')}}/api/settings/"+itemId).done(function( data ) {
        $.get( "{{URL::to('/')}}/api/settings/"+itemId).done(function( response ) {
			$('#div-setting-modal-error').hide();
			$('#mdl-setting-modal').modal('show');
			$('#frm-setting-modal').trigger("reset");
			$('#txt-setting-primary-id').val(response.data.id);

            // $('#spn_setting_').html(response.data.);
            // $('#spn_setting_').html(response.data.);   
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-setting-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        $('.input-border-error').removeClass("input-border-error");
        $('#div-show-txt-setting-primary-id').hide();
        $('#div-edit-txt-setting-primary-id').show();
        let itemId = $(this).attr('data-val');

        // $.get( "{{URL::to('/')}}/api/settings/"+itemId).done(function( data ) {
        $.get( "{{URL::to('/')}}/api/settings/"+itemId).done(function( response ) {            
			$('#div-setting-modal-error').hide();
			$('#mdl-setting-modal').modal('show');
			$('#frm-setting-modal').trigger("reset");
			$('#txt-setting-primary-id').val(response.data.id);

            // $('#').val(response.data.);
            // $('#').val(response.data.);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-setting-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        let itemId = $(this).attr('data-val');
        swal({
          title: "Are you sure you want to delete this Setting?",
          text: "This is an irriversible action!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal({
                title: 'Please Wait !',
                content: wrapper, 
                buttons: false,
                closeOnClickOutside: false
            });
            let endPointUrl = "{{ route('settings.destroy',0) }}"+itemId;

            let formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('_method', 'DELETE');
            
            $.ajax({
                url:endPointUrl,
                type: "POST",
                data: formData,
                cache: false,
                processData:false,
                contentType: false,
                dataType: 'json',
                success: function(result){
                    if(result.errors){
                        console.log(result.errors)
                    }else{
                        window.alert("The Setting record has been deleted.");
                        location.reload(true);
                    }
                },
            });
          }
        });
    });

    //Save details
    $('#btn-save-mdl-setting-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        let actionType = "POST";
        // let endPointUrl = "{{URL::to('/')}}/api/settings/create";
        let endPointUrl = "{{ route('settings.store') }}";
        let primaryId = $('#txt-setting-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId>0){
            actionType = "PUT";
            // endPointUrl = "{{URL::to('/')}}/api/settings/"+itemId;
            endPointUrl = "{{ route('settings.update',0) }}"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        // formData.append('', $('#').val());
        // formData.append('', $('#').val());

        $.ajax({
            url:endPointUrl,
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            dataType: 'json',
            success: function(result){
                if(result.errors){
					$('#div-setting-modal-error').html('');
					$('#div-setting-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-setting-modal-error').append('<li class="">'+value+'</li>');
                        $('#'+key).addClass("input-border-error");

                        $('#'+key).keyup(function(e) {
                            console.log("got here");
                            if($('#'+key).val() != ''){
                                $('#'+key).removeClass("input-border-error")
                            }else{
                                $('#'+key).addClass("input-border-error")
                            }
                        });
                    });
                }else{
                    $('#div-setting-modal-error').hide();
                    window.setTimeout( function(){
                        window.alert("The Setting record saved successfully.");
						$('#div-setting-modal-error').hide();
                        location.reload(true);
                    },20);
                }
            }, error: function(data){
                console.log(data);
            }
        });
    });

});
</script>
@endsection
