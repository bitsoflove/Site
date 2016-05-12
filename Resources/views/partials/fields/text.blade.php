<div class="form-group">
    <label for="{{ $name }}">{!! $title !!}</label>
    @if(isset($helptext))
    <p class="help-block">{!! $helptext !!}</p>
    @endif
    {!! Form::text($name, $value, [
        'class' => 'form-control',
        'id' => $name,
        'placeholder' => $placeholder,
    ]) !!}
</div>
