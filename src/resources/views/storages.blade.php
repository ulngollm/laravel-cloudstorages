@extends('cloudstorages::layout.layout')
@section('content')
    <div class="files">
        @foreach($storages as $storage)
            <x-cloud-storage :storage="$storage"></x-cloud-storage>
        @endforeach
        <a href="#" class="btn btn-primary text-decoration-none js-add" data-bs-toggle="modal"
           data-bs-target="#modal">
            <div class="file__icon file__icon_storage-add"></div>
            <div class="file__name">Добавить</div>
        </a>
    </div>
@endsection
