<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

if (!function_exists('toastResponse')) {
    /**
     * Send a toast response, either as JSON (AJAX) or redirect with flash message.
     */
    function toastResponse(
        string $type,
        string $message,
        ?string $redirectTo = null,
        int $statusCode = 200,
        array $extra = []
    ) {

        $payload = [
            'type' => $type,
            'message' => $message
        ] + $extra;

        if (
            request()->ajax() ||
            request()->expectsJson() ||
            request()->wantsJson() ||
            str_contains(request()->header('Content-Type'), 'application/json') ||
            str_contains(request()->header('Accept'), 'application/json')
        ) {
            return response()->json($payload, $statusCode);
        }

        $redirect = $redirectTo ? redirect($redirectTo) : back();

        return $redirect->with($type, $message);
    }
}
