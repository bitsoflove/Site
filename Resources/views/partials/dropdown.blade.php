<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-sitemap"></i>
    <span>
        {{\Modules\Site\Entities\Site::where('id', '=', \Site::id())->first()->slug}}
        <i class="caret"></i>
    </span>
    </a>
    <ul class="dropdown-menu language-menu">
        @foreach($user->sites()->get() as $site)
            <li class="{{ ((\Site::id() == $site->id)) ? 'active' : '' }}">

                <a href="{{ URL::route('admin.site.site.current', $site->id) }}?uri={{$_SERVER['REQUEST_URI']}}">
                    {{$site->slug}}
                </a>
            </li>
        @endforeach
    </ul>
</li>




