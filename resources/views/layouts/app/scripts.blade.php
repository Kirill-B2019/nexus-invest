{{-- Подключение JS ЛК через @include. --}}
<script src="{{ asset('app/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('app/js/vendor/moment.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/fullcalendar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/progressbar.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/jquery.barrating.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/select2.full.js') }}"></script>
<script src="{{ asset('app/js/vendor/nouislider.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('app/js/vendor/Sortable.js') }}"></script>
<script src="{{ asset('app/js/vendor/mousetrap.min.js') }}"></script>
<script src="{{ asset('app/js/vendor/glide.min.js') }}"></script>
<script src="{{ asset('app/js/dore.script.js') }}"></script>
<script>window.DORE_BASE = "{{ asset('app') }}";</script>
<script src="{{ asset('app/js/scripts.js') }}"></script>
<script>
    document.body.classList.remove('show-spinner');
    (function() {
        var theme = typeof localStorage !== 'undefined' && localStorage.getItem('dore-theme-color');
        if (theme && theme.indexOf('dark') > -1) document.getElementById('app-container').classList.add('body-theme-dark');
        else document.getElementById('app-container').classList.remove('body-theme-dark');
    })();
</script>
@stack('scripts')
