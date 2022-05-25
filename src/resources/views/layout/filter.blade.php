<ul class="nav nav-pills card-header-pills">
    <li class="nav-item">
        <a @class(['nav-link', 'active' => !isset($root), 'disabled' => isset($root)]) href="#">Все</a>
    </li>
    @foreach(config('storages.media_types') as $type)
        <li class="nav-item">
            <a @class(['nav-link','disabled' => isset($root)]) href="?filter={{$type['code']}}">{{$type['name']}}</a>
        </li>
    @endforeach
</ul>
