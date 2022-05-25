@extends('cloudstorages::modals.layout')

@section('header')
    <div class="d-flex">
        <h5 class="modal-title">Добавить диск</h5>
    </div>
@endsection

@section('body')
    <form name="disk-add" id="add">
        <div class="mb-3">
            <label for="label" class="form-label">Название хранилища</label>
            <input type="text" id="label" class="form-control" placeholder="Диск">
            <small class="text-muted d-block py-2">
                Используйте любое удобное название. Его можно будет изменить.
            </small>
        </div>
        <div class="mb-3">
            <label for="disabledSelect" class="form-label">Тип хранилища</label>
            <select id="disabledSelect" class="form-select" disabled>
                @foreach(Arr::pluck(config('storages.drivers'), 'name') as $index => $item)
                    <option value="{{$index + 1}}">{{$item}}</option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label for="label" class="form-label">OAuth токен</label>
            <input type="text" id="label" class="form-control" placeholder="token">
            <small class="text-muted d-block py-2">
                Токен выдает Яндекс.
                Чтобы получить его, перейдите
                <a href="https://oauth.yandex.ru/authorize?response_type=token&client_id={{env('YANDEX_APP_ID', '')}}">
                    по ссылке</a>
                и авторизуйтесь через Яндекс. Вставьте полученный токен в это поле
            </small>
        </div>

    </form>
@endsection

@section('footer')
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
    <button type="submit" class="btn btn-primary" form="add">Сохранить</button>
@endsection
