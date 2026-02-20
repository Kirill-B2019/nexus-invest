@extends('layouts.app.app')

@section('title', __('Мессенджер'))

@section('header')
    <h1>{{ __('Мессенджер') }}</h1>
@endsection

@section('content')
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item"><a href="{{ route('lk') }}">{{ __('Личный кабинет') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Мессенджер') }}</li>
        </ol>
    </nav>
    <div class="separator mb-3"></div>

    @if(!empty($use_trueconf))
    <div class="card mb-3">
        <div class="card-body py-2">
            <a href="#" id="messenger-open-new" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">{{ __('Открыть мессенджер в новом окне') }}</a>
        </div>
    </div>
    <div class="nmess-embed-wrapper">
        <iframe id="trueconf-frame" title="{{ __('Мессенджер TrueConf') }}" class="nmess-iframe" allow="microphone; camera"></iframe>
    </div>
    <p id="messenger-error" class="text-danger small mt-2" style="display: none;"></p>
    <script>
(function() {
    var apiUrl = '{{ url("/api/messenger/trueconf-token") }}';
    var frame = document.getElementById('trueconf-frame');
    var link = document.getElementById('messenger-open-new');
    var errEl = document.getElementById('messenger-error');
    function showErr(msg) { errEl.textContent = msg; errEl.style.display = 'block'; }
    fetch(apiUrl, { credentials: 'include' })
        .then(function(r) {
            if (!r.ok) throw new Error(r.status === 403 ? 'Нет доступа.' : 'Ошибка сервера');
            return r.json();
        })
        .then(function(data) {
            var url = (data.web_client_url || '').replace(/\/$/, '');
            var token = data.access_token;
            if (!url || !token) { showErr('Нет данных для входа.'); return; }
            var iframeSrc = url + (url.indexOf('?') >= 0 ? '&' : '?') + 'access_token=' + encodeURIComponent(token);
            frame.src = iframeSrc;
            link.href = iframeSrc;
        })
        .catch(function(e) { showErr(e.message || 'Не удалось загрузить мессенджер.'); });
})();
    </script>
    @else
    <div class="nmess-embed-wrapper">
        <iframe src="{{ asset('nmess/index.html') }}" title="{{ __('Мессенджер НЕКСУС') }}" class="nmess-iframe"></iframe>
    </div>
    @endif

    <style>
        .nmess-embed-wrapper { height: calc(100vh - 200px); min-height: 400px; }
        .nmess-iframe { width: 100%; height: 100%; border: none; border-radius: 8px; }
    </style>
@endsection
