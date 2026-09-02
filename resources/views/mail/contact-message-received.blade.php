<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Новое сообщение обратной связи') }}</title>
</head>
<body style="font-family: sans-serif; line-height: 1.5; color: #333;">
    <h1 style="font-size: 18px;">{{ __('Новое сообщение обратной связи') }}</h1>

    <p><strong>{{ __('Имя') }}:</strong> {{ $contactMessage->name }}</p>
    <p><strong>{{ __('Email') }}:</strong> {{ $contactMessage->email }}</p>
    <p><strong>{{ __('Тема') }}:</strong> {{ $contactMessage->subject ?: '—' }}</p>
    <p><strong>{{ __('Сообщение') }}:</strong></p>
    <p style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>

    @if ($contactMessage->ip)
        <p><strong>{{ __('IP') }}:</strong> {{ $contactMessage->ip }}</p>
    @endif

    <p><strong>{{ __('Дата') }}:</strong> {{ $contactMessage->created_at?->format('d.m.Y H:i') }}</p>
</body>
</html>
