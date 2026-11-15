@if(session('success'))
    <div class="alert-modern alert-success d-flex align-items-center mx-3 mt-3" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert-modern alert-danger d-flex align-items-center mx-3 mt-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="alert"></button>
    </div>
@endif
