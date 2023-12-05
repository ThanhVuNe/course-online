@if (session()->has('message'))
    <div class="notification-toast toast-success">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-thumbs-up"></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('success') }}</strong><br></span>
        </div>
        <div><span class="messageNotice">{{ session()->get('message') }}</span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error'))
    <div class="notification-toast toast-error">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('error') }}</strong><br></span>
        </div>
        <div><span class="messageNotice">{{ session()->get('error') }}</span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('status'))
    <div class="notification-toast toast-success">
        <span class="alert-icon"><i class="fa-solid fa-thumbs-up"></i></span>
        <span class="alert-text"><strong>{{ __('success') }}</strong><br>{{ session()->get('status') }}</span>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
@endif
