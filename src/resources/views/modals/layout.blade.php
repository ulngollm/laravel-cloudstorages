<div class="modal fade" id="{{$modalId ?? 'modal'}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @yield('header')
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @yield('body')
            </div>
            <div class="modal-footer">
                @yield('footer')
            </div>
        </div>
    </div>
</div>
