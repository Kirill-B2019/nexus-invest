<?php

namespace App\Observers;

use App\Services\ProjectFormDictionaryService;

class RefDictionaryCacheObserver
{
    public function __construct(
        private readonly ProjectFormDictionaryService $dictionaryService
    ) {}

    public function created(object $model): void
    {
        $this->dictionaryService->flushCache();
    }

    public function updated(object $model): void
    {
        $this->dictionaryService->flushCache();
    }

    public function deleted(object $model): void
    {
        $this->dictionaryService->flushCache();
    }

    public function restored(object $model): void
    {
        $this->dictionaryService->flushCache();
    }
}
