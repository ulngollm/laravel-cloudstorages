<ul class="nav nav-pills card-header-pills">
    <li class="nav-item">
        <a class="nav-link active" href=".">Все</a>
    </li>
    @foreach($types as $type)
        <li class="nav-item">
            <a class="nav-link" href="?filter={{$type->code}}">{{$type->name}}</a>
        </li>
    @endforeach
</ul>
