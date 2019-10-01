<input type="hidden" id="id" class="form-control" name="id" value="">

<!-- Student Name Field -->
<div class="form-group">
    <label class="col-sm-4 control-label">
        {!! Form::label('name', 'Name:') !!}
    </label>
    <div class="col-sm-5">
        {!! Form::text('name', null, ['class' => 'form-control','id'=>'name']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group">
    <label class="col-sm-4 control-label">
        {!! Form::label('email', 'Email:') !!}
    </label>
    <div class="col-sm-5">
        {!! Form::text('email', null, ['class' => 'form-control','id'=>'email']) !!}
    </div>
</div>

<!-- Contact Number Field -->
<div class="form-group">
    <label class="col-sm-4 control-label">
        {!! Form::label('contact_number', 'Contact Number:') !!}
    </label>
    <div class="col-sm-5">
        {!! Form::text('contact_number', null, ['class' => 'form-control','id'=>'contact_number']) !!}
    </div>
</div>

<!-- Profile Image Field -->
<div class="form-group">
    <label class="col-sm-4 control-label">
        {!! Form::label('profile_image', 'Profile Image:') !!}
    </label>
    <div class="col-sm-5">
        {!! Form::file('profile_image', null, ['class' => 'form-control','id'=>'profile_image']) !!}
    </div>
</div>