<div class="modal fade" id="modify-date-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="modify-date-title" class="modal-title">Modify Class Dates</h4>
            </div>

            <div class="modal-body">
                <div id="modify-date-error-div" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="form-modify-date" role="form" method="POST"
                    enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-11 ma-10">
                            @csrf

                            <div class="spinner1">
                                <div class="loader" id="loader-1"></div>
                            </div>


                            <input type="hidden" id="txt_date_id" value="0" />


                            <div class="col-sm-12">

                                <!-- Title Field -->
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-3" for="txt_due_date_title">Title</label>
                                    <div class="col-sm-9">
                                        {!! Form::text('txt_due_date_title', null, ['class' => 'form-control', 'id' => 'txt_due_date_title']) !!}
                                    </div>
                                </div>

                                <!-- Due Date Field -->
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-3" for="txt_due_date_due_day">Day</label>
                                    <div class="col-sm-3">
                                        <select name="due_day" id="txt_due_date_due_day" class="form-control">
                                            <option value="">
                                            <option value="">--choose class day--</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            </option>
                                        </select>
                                        {{-- {!! Form::text('txt_due_date_due_date', null, ['class' => 'form-control','id'=>'txt_due_date_due_date']) !!} --}}
                                    </div>
                                    <label class="control-label mb-10 col-sm-1 text-left"
                                        for="txt_due_date_due_time">Time</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('txt_due_date_due_time', null, ['class' => 'form-control', 'id' => 'txt_due_date_due_time']) !!}
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-modify-date" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@section('js-112')
    <script type="text/javascript">
        $(document).ready(function() {

            /* $('#txt_due_date_due_date').datetimepicker({
                //format: 'YYYY-MM-DD HH:mm:ss',
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true
            }); */

            $('#txt_due_date_due_time').datetimepicker({
                //format: 'YYYY-MM-DD HH:mm:ss',
                format: 'hh:mm A',
            });

            //Show Modal
            $('#btn-show-modify-date-modal').click(function() {
                $('#modify-date-error-div').hide();
                $('.input-border-error').addClass("input-border-error");
                $('#modify-date-modal').modal('show');
                $('.spinner1').hide();
                $('#txt_date_id').val(0);
                $('#form-modify-date-modal').trigger("reset");
                $('#txt_due_date_title').val("");
                $('#txt_due_date_due_day').val("");
                $('#txt_due_date_due_time').val("");
            });

            //Show Modal for edit
            $('.btn-edit-modify-date-modal').click(function() {
                $('#modify-date-error-div').hide();
                $('.input-border-error').addClass("input-border-error");
                $('#modify-date-modal').modal('show');
                $('#form-modify-date-modal').trigger("reset");
                $('.spinner1').hide();
                let itemId = $(this).attr('data-val');
                $('#txt_date_id').val(itemId);

                //Set title and url
                $('#txt_due_date_title').val($('#spn_dt_' + itemId + '_title').html());
                $('#txt_due_date_due_day').val($('#spn_dt_' + itemId + '_day').html());
                $('#txt_due_date_due_time').val($('#spn_dt_' + itemId + '_date_time').html());
            });

            //Delete action
            $('.btn-delete-date-entry').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('.spinner1').hide();
                let itemId = $(this).attr('data-val');
                swal({
                        title: "Are you sure you want to delete this date?",
                        text: "This is an irriversible action!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = '<div class="loader2" id="loader-1"></div>';
                            swal({
                                title: 'Please Wait !',
                                content: wrapper,
                                buttons: false,
                                closeOnClickOutside: false
                            });
                            let actionType = "DELETE";
                            let endPointUrl = "{{ route('calendarEntries.destroy', 0) }}" + itemId;

                            let formData = new FormData();
                            formData.append('_token', $('input[name="_token"]').val());
                            formData.append('_method', actionType);

                            $.ajax({
                                url: endPointUrl,
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                success: function(result) {
                                    if (result.errors) {
                                        console.log(result.errors)
                                        $('.spinner1').hide();
                                    } else {
                                        $('.spinner1').hide();
                                        swal("Done!", "The class date has been deleted!",
                                            "success");
                                        location.reload(true);
                                    }
                                },
                            });
                        }
                    });
            });

            //Save lecturer
            $('#btn-modify-date').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('.spinner1').show();
                let actionType = "POST";
                let endPointUrl = "{{ route('calendarEntries.store') }}";
                let primaryId = $('#txt_date_id').val();

                if (primaryId > 0) {
                    actionType = "PUT";
                    endPointUrl = "{{ route('calendarEntries.update', 0) }}" + primaryId;
                }

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('_method', actionType);
                formData.append('course_class_id', {{ $courseClass ? $courseClass->id : '' }});
                formData.append('title', $('#txt_due_date_title').val());
                formData.append('due_day', $('#txt_due_date_due_day').val());
                formData.append('due_time', $('#txt_due_date_due_time').val());
                formData.append('id', $('#txt_date_id').val());

                $.ajax({
                    url: endPointUrl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(result) {
                        if (result.errors) {

                            $('#modify-date-error-div').html('');
                            $('#modify-date-error-div').show();
                            $('.spinner1').hide();
                            $.each(result.errors, function(key, value) {
                                $('#modify-date-error-div').append('<li class="">' +
                                    value + '</li>');
                                $('#txt_due_date_' + key).addClass(
                                "input-border-error");
                                $('#txt_due_date_' + key).keyup(function(e) {
                                    if ($('#txt_due_date_' + key).val() != '') {
                                        $('#txt_due_date_' + key).removeClass(
                                            "input-border-error")
                                    } else {
                                        $('#txt_due_date_' + key).addClass(
                                            "input-border-error")
                                    }
                                });

                                $('#txt_due_date_' + key).click(function(e) {

                                    if ($('#txt_due_date_' + key).val() != '') {
                                        $('#txt_due_date_' + key).removeClass(
                                            "input-border-error")
                                    } else {
                                        $('#txt_due_date_' + key).addClass(
                                            "input-border-error")
                                    }
                                });
                            });

                        } else {
                            $('#modify-date-error-div').hide();
                            $('.spinner1').hide();
                            window.setTimeout(function() {
                                swal("Done!", "Class date saved successfully!",
                                    "success");
                                $('#modify-date-modal').modal('hide');
                                location.reload(true);
                            }, 50);
                        }
                    },
                });
            });

        });
    </script>
@endsection
