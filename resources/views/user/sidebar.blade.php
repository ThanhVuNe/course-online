<div class="col-md-5 col-xl-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Profile Settings</h5>
        </div>
        <div class="list-group list-group-flush" role="tablist">
            <a class="list-group-item list-group-item-action px-3 {{ Route::is('users.profile') ? 'active' : '' }}"
                data-toggle="list" href="{{ route('users.profile') }}" role="tab">
                Account
            </a>
            <a class="list-group-item list-group-item-action px-3 {{ Route::is('users.register') ? 'active' : '' }}"
                data-toggle="list" href="{{ route('users.register') }}" role="tab">
                Register Instructor
            </a>
            <a class="list-group-item list-group-item-action px-3" data-toggle="list" href="#" role="tab">
                Password(To do)
            </a>
            <a class="list-group-item list-group-item-action px-3" data-toggle="list" href="#" role="tab">
                Privacy and safety(To do)
            </a>
            <a class="list-group-item list-group-item-action px-3" data-toggle="list" href="#" role="tab">
                Delete account(To do)
            </a>
        </div>
    </div>
</div>
