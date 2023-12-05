<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalExampleTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body alert-dismissible">

                <!-- Close -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Heading -->
                <h2 class="fw-bold text-center mb-1" id="modalExampleTitle">
                    {{ __('logout') }}
                </h2>

                <!-- Text -->
                <p class="font-size-lg text-center text-muted mb-6 mb-md-8">
                    {{ __('logout_label') }}
                </p>

                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <!-- Submit -->
                            <button class="btn btn-block btn-primary mt-3 lift" type="submit">
                                {{ strtoupper(__('submit')) }}
                            </button>
                        </form>
                    </div>
                    <div class="col-6">
                        <!-- Cancel -->
                        <button class="btn btn-block btn-secondary mt-3 lift" data-bs-dismiss="modal"
                            aria-label="Close">
                            {{ strtoupper(__('cancel')) }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
