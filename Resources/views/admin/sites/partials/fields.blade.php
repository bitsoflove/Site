<!-- Slug Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('slug', 'Slug:') !!}
	{!! Form::text('slug', $site->slug, ['class' => 'form-control']) !!}
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-6 col-lg-4">
    <div class="checkbox">
		<label>{!! Form::checkbox('enabled', $site->enabled, true) !!}Enabled</label>
	</div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
