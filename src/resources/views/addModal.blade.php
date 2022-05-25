<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить диск</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="disk-add">

                    <div class="mb-3">
                        <label for="label" class="form-label">Название хранилища</label>
                        <input type="text" id="label" class="form-control" placeholder="Диск">
                        <small class="text-muted d-block py-2">Используйте любое удобное название. Его можно будет
                            изменить.</small>
                    </div>
                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Тип хранилища</label>
                        <select id="disabledSelect" class="form-select" disabled>
                            <option>Яндекс Диск</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="label" class="form-label">OAuth токен</label>
                        <input type="text" id="label" class="form-control" placeholder="token">
                        <small class="text-muted d-block py-2">Токен выдает Яндекс. Чтобы получить его, перейдите <a
                                href="https://oauth.yandex.ru/authorize?response_type=token&client_id=[APP_ID]">по
                                ссылке</a> и авторизуйтесь через Яндекс. Вставьте полученный токен в это поле</small>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" form="disk-add">Сохранить</button>
            </div>
        </div>
    </div>
</div>
