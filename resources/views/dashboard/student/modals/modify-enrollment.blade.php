

<div class="modal fade" id="mdl-enrollment-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-enrollment-modal-title" class="modal-title">Enrollment</h4>
            </div>

            <div class="modal-body">
                <div id="div-enrollment-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-enrollment-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                        <div class="col-lg-12 ma-10">
                            @csrf
                            <div class="spinner1" >
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-enrollment-primary-id" value="0" />
                            <div id="div-show-txt-enrollment-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('enrollments.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-enrollment-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    
                                        <div class="form-group">
                                            <label class="control-label mb-10 col-sm-3" for="course_id">Department</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="department_id" name="department_id">
                                                    <option value=""> -- select department --</option>
                                                    @foreach ($departmentItems as $item)
                                                        <option value="{{$item->id}}">{{$item->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-10 col-sm-3" for="level">Level</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="level" name="level">
                                                    <option value=""> -- select level --</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{$level->level}}">{{$level->level}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Course Id Field -->
                                        <div id="div-course_id" class="form-group">
                                            <label class="control-label mb-10 col-sm-3" for="course_id">Course Class</label>
                                            <div class="col-sm-9">
                                                {{-- {!! Form::select('course_id', $courseItems, null, ['id'=>'course_id','class'=>'form-control select2']) !!} --}}
                                                <select class="form-control select2" id="course_id" name="course_id">
         
                                                  
                                                        <option value=""> --select course--</option>
                                                
                                                </select>
                                             
                                               
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-enrollment-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@section('js-138')
<script type="text/javascript">
$(document).ready(function() {
    $('#department_id').select2();
    $('#semester_id').select2();
    $('#level_id').select2();
    $('#course_id').select2();
 
    $(document).on('change', "#semester_id", function(e) {
       let endPointUrl = "{{route('api.department.semester.course')}}" ;  
       let formData = new FormData();
       
       formData.append('semester_id',"{{ optional($current_semester)->id}}");
       formData.append('department_id',$('#department_id').val());
       formData.append('level',$('#level').val());
        $.ajax({
            url:endPointUrl,
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#course_id').empty();
                $('#course_id').append('<option value=""> -- select course -- </option>')
                if(response.data.length > 0){
                    $.each(response.data,function(k,v){
                        $('#course_id').append('<option value="'+v.id+'">'+ v.code+ " :: " + v.name + "taught by " + v.lecturer.job_title +" " +v.lecturer.first_name + '</option>' );
                    });
                   
                }
            }, 
            error: function(data){
                    conole.log(data);
            }
        });
    });
    $(document).on('change', "#department_id", function(e) {
       let endPointUrl = "{{route('api.department.semester.course')}}" ;  
       let formData = new FormData();
       formData.append('semester_id',{{ optional($current_semester)->id}});
       formData.append('department_id',$('#department_id').val());
       formData.append('level',$('#level').val());
        $.ajax({
            url:endPointUrl,
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#course_id').empty();
                $('#course_id').append('<option value=""> -- select course -- </option>')
                if(response.data.length > 0){
                    $.each(response.data,function(k,v){
                        $('#course_id').append('<option value="'+v.id+'">'+ v.code+ " :: " + v.name + " taught by " + v.lecturer.job_title +" " +v.lecturer.first_name + '</option>' );
                    });
                   
                }
            }, 
            error: function(data){
                    conole.log(data);
            }
        });
    });

    $(document).on('change', "#level", function(e) {
       let endPointUrl = "{{route('api.department.semester.course')}}" ;  
       let formData = new FormData();
       formData.append('semester_id',{{ optional($current_semester)->id}});
       formData.append('department_id',$('#department_id').val());
       formData.append('level',$('#level').val());
        $.ajax({
            url:endPointUrl,
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#course_id').empty();
                $('#course_id').append('<option value=""> -- select course -- </option>')
                if(response.data.length > 0){
                    $.each(response.data,function(k,v){
                        $('#course_id').append('<option value="'+v.id+'">'+ v.code+ " :: " + v.name + " taught by " + v.lecturer.job_title +" " +v.lecturer.first_name + '</option>' );
                    });
                   
                }
            }, 
            error: function(data){
                    conole.log(data);
            }
        });
    });
    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-enrollment-modal", function(e) {
        $('#div-enrollment-modal-error').hide();
        $('#mdl-enrollment-modal').modal('show');
        $('#frm-enrollment-modal').trigger("reset");
        $('#txt-enrollment-primary-id').val(0);
        $('.spinner1').hide();
        $('#div-show-txt-enrollment-primary-id').hide();
        $('#div-edit-txt-enrollment-primary-id').show();
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-enrollment-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        $('.spinner1').hide();
        $('#div-show-txt-enrollment-primary-id').show();
        $('#div-edit-txt-enrollment-primary-id').hide();
        let itemId = $(this).attr('data-val');

        // $.get( "{{URL::to('/')}}/api/enrollments/"+itemId).done(function( data ) {
        $.get( "{{URL::to('/')}}/api/enrollments/"+itemId).done(function( response ) {
			$('#div-enrollment-modal-error').hide();
			$('#mdl-enrollment-modal').modal('show');
			$('#frm-enrollment-modal').trigger("reset");
			$('#txt-enrollment-primary-id').val(response.data.id);

            // $('#spn_enrollment_').html(response.data.);
            // $('#spn_enrollment_').html(response.data.);   
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-enrollment-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        $('.spinner1').hide();
        $('#div-show-txt-enrollment-primary-id').hide();
        $('#div-edit-txt-enrollment-primary-id').show();
        let itemId = $(this).attr('data-val');

        // $.get( "{{URL::to('/')}}/api/enrollments/"+itemId).done(function( data ) {
        $.get( "{{URL::to('/')}}/api/enrollments/"+itemId).done(function( response ) {            
			$('#div-enrollment-modal-error').hide();
			$('#mdl-enrollment-modal').modal('show');
			$('#frm-enrollment-modal').trigger("reset");
			$('#txt-enrollment-primary-id').val(response.data.id);

            // $('#').val(response.data.);
            // $('#').val(response.data.);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-enrollment-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        let itemId = $(this).attr('data-val');
        swal({
          title: "Are you sure you want to delete this Enrollment?",
          text: "This is an irriversible action!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            let endPointUrl = "{{ route('enrollments.destroy',0) }}"+itemId;

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
                        swal("Done!", "The Enrollment record has been deleted!", "success");
                        location.reload(true);
                    }
                },
            });
          }
        });
    });

    //Save details
    $('#btn-save-mdl-enrollment-modal').click(function(e) {
        e.preventDefault();

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        } 

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        $('.spinner1').show();
        let actionType = "POST";
        let endPointUrl = "{{ route('api.enrollments.store') }}";
        let primaryId = $('#txt-enrollment-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId>0){
            actionType = "PUT";
            endPointUrl = "{{ route('api.enrollments.update',0) }}"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        formData.append('course_class_id', $('#course_id').val());
        formData.append('student_id', "{{$current_user->student_id}}" );
        formData.append('department_id',$('#department_id').val() );
        formData.append('semester_id',"{{ optional($current_semester)->id}}");
        formData.append('level',$('#level').val());
        formData.append('is_approved','0');

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
					$('#div-enrollment-modal-error').html('');
					$('#div-enrollment-modal-error').show();
                    $('.spinner1').hide();
                    $.each(result.errors, function(key, value){
                        $('#div-enrollment-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-enrollment-modal-error').hide();
                    $('.spinner1').hide();
                    window.setTimeout( function(){
                        swal("Done!", "You have enrolled into this class successfully!", "success");
                        // window.alert("The Enrollment record saved successfully.");
						$('#div-enrollment-modal-error').hide();
                        location.reload(true);
                    },20);
                }
            }, error: function(data){
                $('#div-enrollment-modal-error').html('');
                $('#div-enrollment-modal-error').show();
                $('.spinner1').hide();
                console.log(data);
            }
        });
    });

});
</script>
@endsection
