<p>
    <label for="">
        {{$title}}
    </label>


    @foreach($options as $optionValue => $optionText)
        <div class="radio">
            <?php $isSelected = ($optionValue === $value); ?>
            <label>
                {!! Form::radio($name, $optionValue, $isSelected) !!}&nbsp;{{$optionText}}
            </label>
        </div>
    @endforeach

</p>
