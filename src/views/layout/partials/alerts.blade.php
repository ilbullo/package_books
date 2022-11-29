@if (session()->has('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert" style="margin-top:30px;">
        {{ __(session('message')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
