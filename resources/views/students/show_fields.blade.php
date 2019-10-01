<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $students->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $students->email !!}</p>
</div>

<!-- Contact Number Field -->
<div class="form-group">
    {!! Form::label('contact_number', 'Contact Number:') !!}
    <p>{!! $students->contact_number !!}</p>
</div>

<!-- Profile Image Field -->
<div class="form-group">
    {!! Form::label('profile_image', 'Profile Image:') !!}
    <p>{!! $students->profile_image !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $students->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $students->updated_at !!}</p>
</div>

