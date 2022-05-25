<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            @yield('nav')
        </ul>
    </div>
    <div class="card-body">
        <h5 class="card-title">
            {{$title}}
        </h5>
        <div class="card-text">
            <div class="files py-4">
                @yield('files')
            </div>
        </div>
    </div>
</div>
