<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CaptchaService;
use Illuminate\Http\JsonResponse;

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
