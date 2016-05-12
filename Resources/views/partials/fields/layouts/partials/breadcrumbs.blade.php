<ol class="breadcrumb">

    @foreach($breadcrumbs as $breadcrumb)
        <li class="{{$breadcrumb['class']}}">
            <a href="{{$breadcrumb['href']}}">
                @if(!empty($breadcrumb['icon']))
                    <i class="fa {{$breadcrumb['icon']}}"></i>
                @endif
                {{$breadcrumb['title']}}</a>
        </li>
    @endforeach
</ol>
