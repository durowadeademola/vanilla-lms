<!-- Email Field -->
<div id="div_student_email" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('email', 'Email:', ['class'=>'control-label']) !!} 
        <span id="spn_student_email">
        @if (isset($student->email))
            {!! $student->email !!}
        @endif
        </span>
    </p>
</div>

<!-- Matriculation Number Field -->
<div id="div_student_matriculation_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('matriculation_number', 'Matriculation Number:', ['class'=>'control-label']) !!} 
        <span id="spn_student_matriculation_number">
        @if (isset($student->matriculation_number))
            {!! $student->matriculation_number !!}
        @endif
        </span>
    </p>
</div>

<!-- First Name Field -->
<div id="div_student_first_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('first_name', 'First Name:', ['class'=>'control-label']) !!} 
        <span id="spn_student_first_name">
        @if (isset($student->first_name))
            {!! $student->first_name !!}
        @endif
        </span>
    </p>
</div>

<!-- Last Name Field -->
<div id="div_student_last_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('last_name', 'Last Name:', ['class'=>'control-label']) !!} 
        <span id="spn_student_last_name">
        @if (isset($student->last_name))
            {!! $student->last_name !!}
        @endif
        </span>
    </p>
</div>

<!-- Sex Field -->
<div id="div_student_sex" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('sex', 'Sex:', ['class'=>'control-label']) !!} 
        <span id="spn_student_sex">
        @if (isset($student->sex))
            {!! $student->sex !!}
        @endif
        </span>
    </p>
</div>

<!-- Sex Field -->
<div id="div_student_level" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('sex', 'Level:', ['class'=>'control-label']) !!} 
        <span id="spn_student_level">
        @if (isset($student->level))
            {!! $student->level !!}
        @endif
        </span>
    </p>
</div>

<!-- Telephone Field -->
<div id="div_student_telephone" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('telephone', 'Telephone:', ['class'=>'control-label']) !!} 
        <span id="spn_student_telephone">
        @if (isset($student->telephone))
            {!! $student->telephone !!}
        @endif
        </span>
    </p>
</div>

<!-- Has Graduated Field -->
<div id="div_student_has_graduated" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('has_graduated', 'Has Graduated:', ['class'=>'control-label']) !!} 
        <span id="spn_student_has_graduated">
        @if (isset($student->has_graduated))
            {!! $student->has_graduated ? "Yes" : "No" !!}
        @endif
        </span>
    </p>
</div>

