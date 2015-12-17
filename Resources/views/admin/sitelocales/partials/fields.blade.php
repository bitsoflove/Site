<!-- Site Id Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('site_id', 'Site Id:') !!}
	{!! Form::number('site_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Locale Id Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('locale_id', 'Locale Id:') !!}
	{!! Form::number('locale_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('url', 'Url:') !!}
	{!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


