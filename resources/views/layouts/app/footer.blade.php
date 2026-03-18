{{-- Футер ЛК: формат как в Dashboard.Default — row/col, прижат к низу. --}}
<footer class="page-footer">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="page-footer-text mb-0">{{ config('app.name') }} {{ date('Y') }} | <a href="{{ route('welcome') }}" class="btn-link">{{ __('Главная') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
