<div class="modal fade" id="mdl-student-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="lbl-student-modal-title" class="modal-title">Student</h4>
            </div>

            <div class="modal-body">
                <div id="div-student-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-student-modal" role="form" method="POST"
                    enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                        <div class="col-lg-12 ma-10">
                            @csrf

                            <div id="spinner1" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-student-primary-id" value="0" />
                            <div id="div-show-txt-student-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                        @include('students.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-student-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                        @include('students.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-student-modal"
                    value="add">Save</button>
            </div>

        </div>
    </div>
</div>


{{-- Bulk upload modal --}}
<div class="modal fade" id="mdl-bulk-student-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="lbl-student-modal-title" class="modal-title">Bulk Student Upload</h4>
            </div>

            <div class="modal-body">
                <div id="div-bulk-student-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-student-modal" role="form" method="POST"
                    enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">

                            @csrf

                            <div class="offline-flag"><span class="no-file">Please upload a csv file</span></div>
                            <div id="spinner-students" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <div id="div-show-txt-student-primary-id">
                                <div class="row">
                                    <div class="col-lg-12 ma-10">
                                        <div id="div-bulk_student" class="form-group">
                                            <label class="control-label mb-10 col-sm-3" for="bulk_student">Upload
                                                CSV</label>
                                            <div class="col-sm-9">
                                                {!! Form::file('bulk_students', ['class' => 'custom-file-input', 'id' => 'bulk_students']) !!}
                                            </div>
                                        </div>
                                        <span class="badge badge-pill badge-secondary mb-5 ml-30">Student csv file
                                            format:</span>
                                        <a id="format_csv_file" src="" class="btn btn-sm btn-danger"
                                            data-toggle="tootip" title="Student csv file format"
                                            href="{{ asset('csv/student_user_upload_cvs_format.csv') }}"> <i
                                                class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="div-save-mdl-student-modal" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-bulk-student-modal"
                    value="add">Save</button>
            </div>

        </div>
    </div>
</div>

{{-- Bulk upload modal --}}
<div class="modal fade" id="mdl-bulk-student-courseClass-enrollment-modal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="lbl-student-modal-title" class="modal-title">Student Enrollment</h4>
            </div>

            <div class="modal-body">
                <div id="div-bulk-student-courseClass-enrollment-modal-error" class="alert alert-danger"
                    role="alert"></div>
                <form class="form-horizontal" id="frm-bulk-student-courseClass-enrollment-modal" role="form"
                    method="POST" enctype="multipart/form-data" action="">
                    <div class="row" style="padding-right: 25px">
                        <div class="col-lg-12 ma-10">

                            @csrf

                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div class="spinner1">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <div id="div-show-txt-student-primary-id">

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-lg-12 ma-10">
                                            <label class="control-label mb-10 col-sm-3"
                                                for="enrollment_level">Level</label>
                                            <div class="col-sm-9">
                                                <select name="enrollment_level" id="enrollment_level"
                                                    class="form-control">
                                                    <option value="">
                                                        -- Select level --
                                                    </option>
                                                    @if (count($levels) > 0)
                                                        @foreach ($levels as $level)
                                                            <option value="{{ $level->level }}">
                                                                {{ $level->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 ma-10">
                                        <div class="form-group">
                                            <label class="control-label mb-10 col-sm-3"
                                                for="enrollment_course_class">Course
                                                Class </label>
                                            <div class="col-sm-9">
                                                <select name="enrollment_course_class" id="enrollment_course_class_id"
                                                    class="form-control">
                                                    <option value="">
                                                        -- select course class --
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div-bulk-student-courseClass-enrollment-modal-success"
                                    class="alert alert-success" role="alert">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="div-save-mdl-student-modal" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-danger"
                    id="btn-save-mdl-bulk-student-courseClass-enrollment-modal" value="add">Enroll All</button>
            </div>

        </div>
    </div>
</div>

{{-- password reset --}}
<div class="modal fade" id="student-password-reset-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="modify-user-password-reset-title" class="modal-title">Reset Student Password</h4>
            </div>

            <div class="modal-body">
                <div id="modify-user-password-reset-error-div" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="form-modify-user-password-reset" role="form" method="POST"
                    enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="offline-flag"><span id="offline">You are currently offline</span></div>
                        <div class="col-lg-12 ma-10">
                            @csrf
                            <div class="spinner1">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt_reset_account_id" value="0" />

                            <div class="form-group">
                                <label class="control-label mb-10 col-sm-3" for="code">Password</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <input type="text" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-modify-user-password-reset"
                    value="add">Reset</button>
            </div>

        </div>
    </div>
</div>

{{-- re enroll student --}}
<div class="modal fade" id="student-re-enrollment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 id="modify-user-re-enrollment-title" class="modal-title">Re Enroll Student</h4>
            </div>

            <div class="modal-body">
                <div id="modify-user-re-enrollment-error-div" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="form-modify-user-re-enrollment" role="form" method="POST"
                    enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                        <div class="col-lg-12 ma-10">
                            @csrf
                            <div class="spinner1">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt_re-enrollment_student_id" value="0" />

                            <div class="col-sm-12">
                                <h5>
                                    Performing this action will re enroll the student into the last level.
                                    </h3>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer" id="student-re-enrollment-footer">
                <button type="button" class="btn btn-primary" id="btn-save-modify-user-re-enrollment"
                    value="add">Re Enroll</button>
            </div>

        </div>
    </div>
</div>

@section('js-129')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log($());
            $('.no-file').hide();
            $("#spinner-students").fadeOut(1);
            $('#div-bulk-student-modal-error').hide();

            //Show Modal for New Entry
            $(document).on('click', ".btn-new-mdl-student-modal", function(e) {
                $('#spinner1').hide();
                $('#div-student-modal-error').hide();
                $('.input-border-error').removeClass("input-border-error");
                $('#mdl-student-modal').modal('show');
                $('#frm-student-modal').trigger("reset");
                $('#txt-student-primary-id').val(0);

                $('#div-show-txt-student-primary-id').hide();
                $('#div-edit-txt-student-primary-id').show();
                $('.modal-footer').show();
            });

            //Show Modal for View
            $(document).on('click', ".btn-show-mdl-student-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#div-show-txt-student-primary-id').show();
                $('#div-edit-txt-student-primary-id').hide();
                $('.modal-footer').hide();
                $('#spinner1').hide();
                let itemId = $(this).attr('data-val');

                // $.get( "{{ URL::to('/') }}/api/students/"+itemId).done(function( data ) {
                $.get("{{ URL::to('/') }}/api/students/" + itemId).done(function(response) {
                    $('#div-student-modal-error').hide();
                    $('#mdl-student-modal').modal('show');
                    $('#frm-student-modal').trigger("reset");
                    $('#txt-student-primary-id').val(response.data.id);

                    $('#spn_student_email').html(response.data.email);
                    $('#spn_student_first_name').html(response.data.first_name);
                    $('#spn_student_last_name').html(response.data.last_name);
                    $('#spn_student_telephone').html(response.data.telephone);
                    $('#spn_student_sex').html(response.data.sex);
                    if (response.data.has_graduated == true) {
                        $('#spn_student_has_graduated').html('Yes');
                    } else {
                        $('#spn_student_has_graduated').html('No');
                    }

                    $('#spn_student_matriculation_number').html(response.data.matriculation_number);
                    $('#spn_student_level').html(response.data.level);
                });
            });
            $(document).on('change', "#enrollment_level", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                console.log("hjere");
                let level = $(this).val();
                $('#enrollment_course_class_id').empty()
                // $.get( "{{ URL::to('/') }}/api/students/"+itemId).done(function( data ) {
                $.get("{{ URL::to('/') }}/api/course_classes?level=" + level +
                    "&semester_id={{ optional($current_semester)->id }}").done(function(response) {

                    if (response.data && response.data.length > 0); {
                        $('#enrollment_course_class_id').append(
                            "<option value=''> -- Select course class -- </option>")
                        $.each(response.data, function(k, v) {
                            let job_title = v.lecturer.job_title ? v.lecturer.job_title :
                            '';
                            $('#enrollment_course_class_id').append("<option value=" + v
                                .id + ">" + v.code + " -- taught by " + job_title +
                                " " + v.lecturer.first_name + " " + v
                                .lecturer.last_name + "</option>")
                        })
                    }
                });
            });

            //Show Modal for Edit
            $(document).on('click', ".btn-edit-mdl-student-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('.input-border-error').removeClass("input-border-error");
                $('#div-show-txt-student-primary-id').hide();
                $('#div-edit-txt-student-primary-id').show();
                $('.modal-footer').show();
                $('#spinner1').hide();
                let itemId = $(this).attr('data-val');

                // $.get( "{{ URL::to('/') }}/api/students/"+itemId).done(function( data ) {
                $.get("{{ URL::to('/') }}/api/students/" + itemId).done(function(response) {
                    console.log(response);
                    $('#div-student-modal-error').hide();
                    $('#mdl-student-modal').modal('show');
                    $('#frm-student-modal').trigger("reset");
                    $('#txt-student-primary-id').val(response.data.id);

                    $('#email').val(response.data.email);
                    $('#first_name').val(response.data.first_name);
                    $('#last_name').val(response.data.last_name);
                    $('#telephone').val(response.data.telephone);
                    if (response.data.has_graduated == true) {
                        $('#has_graduated').prop('checked', true);
                    } else {
                        $('#has_graduated').prop('checked', false);
                    }
                    $('#sex').val(response.data.sex);
                    $('#matriculation_number').val(response.data.matriculation_number);
                    $('#level').val(response.data.level);

                });
            });

            //Delete action
            $(document).on('click', ".btn-delete-mdl-student-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                let itemId = $(this).attr('data-val');
                swal({
                        title: "Are you sure you want to delete this Student?",
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
                            let endPointUrl = "{{ route('students.destroy', 0) }}" + itemId;

                            let formData = new FormData();
                            formData.append('_token', $('input[name="_token"]').val());
                            formData.append('_method', 'DELETE');

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
                                    } else {
                                        swal("Done!",
                                            "The Student record has been deleted!",
                                            "success");
                                        location.reload(true);
                                    }
                                },
                            });
                        }
                    });
            });

            //Save details
            $('#btn-save-mdl-student-modal').click(function(e) {
                e.preventDefault();

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('.offline').fadeIn(300);
                    return;
                } else {
                    $('.offline').fadeOut(300);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('#spinner1').show();
                $('#btn-save-mdl-student-modal').prop("disabled", true);
                let actionType = "POST";
                let endPointUrl = "{{ route('students.store') }}";
                let primaryId = $('#txt-student-primary-id').val();

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                if (primaryId > 0) {
                    actionType = "PUT";
                    endPointUrl = "{{ route('api.students.update', 0) }}" + primaryId;
                    formData.append('id', primaryId);
                }
                if ($('#has_graduated').is(':checked')) {
                    formData.append('has_graduated', $('#has_graduated').val())
                } else {
                    formData.append('has_graduated', 0)
                }
                formData.append('_method', actionType);
                formData.append('email', $('#email').val());
                formData.append('first_name', $('#first_name').val());
                formData.append('txt_student_primary_id', $('#txt-student-primary-id').val());
                formData.append('last_name', $('#last_name').val());
                formData.append('sex', $('#sex').val());
                formData.append('level', $('#level').val());
                formData.append('telephone', $('#telephone').val());
                formData.append('matriculation_number', $('#matriculation_number').val());
                formData.append('department_id', "{{ $department->id }}");

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
                            $('#div-student-modal-error').html('');
                            $('#div-student-modal-error').show();
                            $('#spinner1').hide();
                            $('#btn-save-mdl-student-modal').prop("disabled", false);

                            $.each(result.errors, function(key, value) {
                                console.log(result);
                                $('#div-student-modal-error').append('<li class="">' +
                                    value + '</li>');
                                $('#' + key).addClass("input-border-error");

                                if (key == 'level' || key == 'sex') {
                                    $('#' + key).change(function(e) {
                                        if ($('#' + key).val() != '') {
                                            $('#' + key).removeClass(
                                                "input-border-error")
                                        } else {
                                            $('#' + key).addClass(
                                                "input-border-error")
                                        }
                                    });
                                } else {
                                    $('#' + key).keyup(function(e) {

                                        if ($('#' + key).val() != '') {
                                            $('#' + key).removeClass(
                                                "input-border-error")
                                        } else {
                                            $('#' + key).addClass(
                                                "input-border-error")
                                        }
                                    });
                                }


                            });
                        } else {
                            $('#div-student-modal-error').hide();
                            $('#spinner1').hide();
                            $('#btn-save-mdl-student-modal').prop("disabled", false);
                            window.setTimeout(function() {
                                swal("Done!", "The Student record saved successfully!",
                                    "success");
                                $('#div-student-modal-error').hide();
                                location.reload(true);
                            }, 20);
                        }
                    },
                    error: function(data) {
                        $('#spinner1').hide();
                        $('#btn-save-mdl-student-modal').prop("disabled", false);
                        console.log(data);
                    }
                });
            });



            $(document).on('click', '#btn-save-mdl-bulk-student-modal', function(e) {
                e.preventDefault();
                $('.no-file').hide();
                $("#spinner-students").show();
                $(this).attr('disabled', true);

                let formData = new FormData();
                formData.append('_method', "POST");
                endPointUrl = "{{ route('api.students.bulk') }}";
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('department_id', '{{ auth()->user()->department_id ?? null }}');
                if ($('#bulk_students')[0].files.length > 0) {
                    formData.append('bulk_student_file', $('#bulk_students')[0].files[0]);
                    $.ajax({
                        url: endPointUrl,
                        type: "POST",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(result) {
                            $("#spinner-students").fadeOut(100);
                            $('#btn-save-mdl-bulk-student-modal').attr('disabled', false);
                            if (result.errors) {
                                $('#div-bulk-student-modal-error').html('');
                                $('#div-bulk-student-modal-error').show();

                                $.each(result.errors, function(key, value) {
                                    $('#div-bulk-student-modal-error').append(
                                        '<li class="">' +
                                        value + '</li>');
                                });
                            } else {
                                $('#div-bulk-students-modal-error').hide();
                                window.setTimeout(function() {
                                    swal("Saved", "Students saved successfully.",
                                        "success");

                                    $('#div-bulk-student-modal-error').hide();
                                    location.reload(true);

                                }, 20);
                            }

                            $("#spinner-departments").hide();
                            $("#div-save-mdl-students-modal").attr('disabled', false);

                        },
                        error: function(data) {
                            console.log(data);
                            swal("Error", "Oops an error occurred. Please try again.", "error");

                            $("#spinner-students").hide();
                            $("#btn-save-mdl-bulk-student-modal").attr('disabled', false);

                        }
                    })
                } else {
                    $("#spinner-students").fadeOut(100);
                    $('.no-file').fadeIn();
                    $("#btn-save-mdl-bulk-student-modal").attr('disabled', false);
                }
            });
            $(document).on('click', "#btn-show-bulk-student-courseClass-enrollment-modal", function(e) {
                $('.spinner1').hide();
                $('#div-bulk-student-courseClass-enrollment-modal-error').hide();
                $('#div-bulk-student-courseClass-enrollment-modal-success').hide();
                $('.input-border-error').removeClass("input-border-error");
                $('#mdl-bulk-student-courseClass-enrollment-modal').modal('show');
                $('#frm-bulk-student-courseClass-enrollment-modal').trigger("reset");
                $('.modal-footer').show();
            });

            $(document).on('click', '#btn-save-mdl-bulk-student-courseClass-enrollment-modal', function(e) {
                e.preventDefault();
                //check for internet status 

                if (!window.navigator.onLine) {
                    $('.offline').fadeIn(300);
                    return;
                } else {
                    $('.offline').fadeOut(300);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('.spinner1').show();
                $('#div-bulk-student-courseClass-enrollment-modal-success').hide();
                $('#div-bulk-student-courseClass-enrollment-modal-error').hide();
                $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal').prop("disabled", true);
                let actionType = "POST";
                let endPointUrl = "{{ route('api.enrollment.bulk') }}"

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());

                formData.append('course_class_id', $('#enrollment_course_class_id').val());
                formData.append('level', $('#enrollment_level').val());
                formData.append('department_id', "{{ $department->id }}");
                formData.append('semester_id', "{{ optional($current_semester)->id }}");

                $.ajax({
                    url: endPointUrl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(result) {
                        $('#div-bulk-student-courseClass-enrollment-modal-success').html('');
                        if (result.errors) {
                            $('#div-bulk-student-courseClass-enrollment-modal-error').html('');
                            $('#div-bulk-student-courseClass-enrollment-modal-error').show();
                            $('.spinner1').hide();
                            $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal').prop(
                                "disabled", false);

                            $.each(result.errors, function(key, value) {
                                $('#div-bulk-student-courseClass-enrollment-modal-error')
                                    .append(
                                        '<li class="">' +
                                        value + '</li>');
                                $('#' + key).addClass("input-border-error");

                                $('#' + key).keyup(function(e) {

                                    if ($('#' + key).val() != '') {
                                        $('#enrollment_' + key).removeClass(
                                            "input-border-error")
                                    } else {
                                        $('#' + key).addClass(
                                            "input-border-error")
                                    }
                                });
                            });
                        } else if (result.enrollment_errors) {
                            console.log(result);
                            $('#div-bulk-student-courseClass-enrollment-modal-error').html('');
                            $('#div-bulk-student-courseClass-enrollment-modal-error').show();
                            $('#spinner-bulk-courseClass-enrollment').hide();
                            $('#div-bulk-student-courseClass-enrollment-modal-success').hide()
                            $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal').prop(
                                "disabled", false);
                            $.each(result.enrollment_errors, function(key, value) {
                                $('#div-bulk-student-courseClass-enrollment-modal-error')
                                    .append(
                                        '<li class="">' +
                                        value + '</li>');
                            });
                            if (result.enrollment_successes && result.enrollment_successes
                                .length > 0) {
                                console.log("here");
                                $('#div-bulk-student-courseClass-enrollment-modal-success')
                                    .html('');
                                $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal')
                                    .prop("disabled", false);
                                $('#div-bulk-student-courseClass-enrollment-modal-success')
                                    .show();
                                $('#spinner-bulk-courseClass-enrollment').hide();
                                $.each(result.enrollment_successes, function(key, value) {
                                    $('#div-bulk-student-courseClass-enrollment-modal-success')
                                        .append(
                                            '<li class="">' +
                                            value + '</li>');
                                });
                            }
                            $('.spinner1').hide();
                        } else {
                            $('#div-bulk-student-courseClass-enrollment-modal-error').hide();
                            $('#div-bulk-student-courseClass-enrollment-modal-success').hide();
                            $('.spinner1').hide();
                            $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal').prop(
                                "disabled", false);
                            window.setTimeout(function() {
                                swal("Done!",
                                    "Bulk Course Class Enrollment record saved successfully!",
                                    "success");
                                $('#div-student-modal-error').hide();
                                location.reload(true);
                            }, 20);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        $('#spinner-bulk-courseClass-enrollment').hide();
                        $('#btn-save-mdl-bulk-student-courseClass-enrollment-modal').prop(
                            "disabled", false);
                        console.log(data);
                    }
                });
            });



            //Show Modal for Password reset
            $(document).on('click', ".btn-student-password-reset-modal", function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                let itemId = $(this).data('val');
                $('#txt_reset_account_id').val(itemId);
                $('.spinner1').hide();
                $('#student-password-reset-modal').modal('show');
                $('#form-modify-user-password-reset').trigger("reset");
                $('#modify-user-password-reset-error-div').hide();

            });

            //Show Modal for re enrollment
            $(document).on('click', ".btn-student-re-enrollment-modal", function(e) {
                e.preventDefault();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                let itemId = $(this).data('val');
                $('#txt_re-enrollment_student_id').val(itemId);
                $('.spinner1').hide();
                $('#student-re-enrollment-modal').modal('show');
                $('#form-modify-user-re-enrollment').trigger("reset");
                $('#modify-user-re-enrollment-error-div').hide();
                $('#student-re-enrollment-footer').show()
                $('.modal-footer').show()
            });

        //handle event for enterkey submission
            $('#form-modify-user-password-reset').keypress(function (e) {
             if(e.which == 13) { // the enter key code
                $('#btn-modify-user-password-reset').trigger('click');
                return false;  
              }
            });
            
            //Save user password-reset
            $('#btn-modify-user-password-reset').click(function(e) {
                e.preventDefault();

                //check for internet status 
                if (!window.navigator.onLine) {
                    $('#offline').fadeIn(300);
                    return;
                } else {
                    $('#offline').fadeOut(300);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('#btn-modify-user-password-reset').prop("disabled", true);
                $('.spinner1').show();
                let actionType = "POST";
                let endPointUrl = "{{ route('api.student.reset-psw') }}";

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('_method', actionType);
                formData.append('password', $('#password').val());
                formData.append('id', $('#txt_reset_account_id').val());

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
                            $('#modify-user-password-reset-error-div').html('');
                            $('#modify-user-password-reset-error-div').show();
                            $('#btn-modify-user-password-reset').prop("disabled", false);
                            $('.spinner1').hide();
                            $.each(result.errors, function(key, value) {
                                $('#modify-user-password-reset-error-div').append(
                                    '<li class="">' +
                                    value + '</li>');
                            });

                        } else {
                            $('#modify-user-password-reset-error-div').hide();
                            $('#btn-modify-user-password-reset').prop("disabled", false);
                            $('.spinner1').hide();
                            window.setTimeout(function() {
                                swal("Done!",
                                    "User account password reset successfully!",
                                    "success");
                                $('#modify-user-password-reset-modal').modal('hide');
                                location.reload(true);
                            }, 50);
                        }
                    },
                });

            });

            $('#btn-save-modify-user-re-enrollment').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#modify-user-re-enrollment-modal').modal('hide');
                swal({
                        title: "Are you sure you want to re-enroll this Student to the previous level?",
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
                            $('#btn-save-modify-user-re-enrollment').prop("disabled", true);
                            $('.spinner1').show();
                            let actionType = "POST";
                            let endPointUrl = "{{ route('api.student.re-enroll') }}";
                            let formData = new FormData();
                            let level =
                                "{{ count($levels) > 0 ? $levels->sortByDesc('level')->first()->level : '' }}";
                            formData.append('_token', $('input[name="_token"]').val());
                            formData.append('_method', actionType);
                            formData.append('level', level);
                            formData.append('id', $('#txt_re-enrollment_student_id').val());

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
                                        $('#modify-user-re-enrollment-error-div').html('');
                                        $('#modify-user-re-enrollment-error-div').show();
                                        $('#btn-save-modify-user-re-enrollment').prop(
                                            "disabled", false);
                                        $('.spinner1').hide();
                                        $.each(result.errors, function(key, value) {
                                            $('#modify-user-re-enrollment-error-div')
                                                .append(
                                                    '<li class="">' +
                                                    value + '</li>');
                                        });

                                    } else {
                                        $('#modify-user-re-enrollment-error-div').hide();
                                        $('#btn-save-modify-user-re-enrollment').prop(
                                            "disabled", false);
                                        $('.spinner1').hide();
                                        window.setTimeout(function() {
                                            swal("Done!",
                                                "Student Status changed successfully!",
                                                "success");
                                            $('#modify-user-re-enrollment-modal')
                                                .modal('hide');
                                            location.reload(true);
                                        }, 50);
                                    }
                                },
                            });
                        }
                    });



            });
        });
    </script>
@endsection
