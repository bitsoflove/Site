<div class="form-group">
    <label for="">{!! $title !!}</label>
    @if(isset($helptext))
    <br> {!! $helptext !!} <br>
    @endif
    <textarea name="{{$name}}" @if(isset($rows))rows="{{$rows}}"@endif class="form-control" placeholder="{{$placeholder}}">{{$value}}</textarea>
</div>