<div class="checkbox">

  <label>
      <?php $value = isset($value) ? $value : '1'; ?>

      {{--to the maintenance dev: Klasse flat-blue zorgde ervoor dat de 'checked' niet altijd correct werd aangepast. Daarom eruit gehaald!--}}
      {!! Form::checkbox($name, $value, $checked, ['class' => '__flat-blue__', 'id' => $name]) !!}<?=$title?>
  </label>

</div>