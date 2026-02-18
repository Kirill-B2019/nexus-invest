<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CaptchaService;
use Illuminate\Http\JsonResponse;

/**
 * |KB 2025-02-18 API генерации новой капчи для форм. Throttle 10/мин.
 */
class CaptchaController extends Controller
{
    public function __construct(
        private CaptchaService $captchaService
    ) {}

    public function new(): JsonResponse
    {
        $data = $this->captchaService->create();

        return response()->json($data);
    }
}
