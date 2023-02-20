<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\ValidationException;

class ExceptionDistribution extends Exception
{
    public static function defineException(\Exception $exception): \Illuminate\Http\JsonResponse
    {
        $exception_class = get_class($exception);
        return match ($exception_class) {
            ValidationException::class => response()->json(['errors' => $exception->getValidationError(), 'status' => 422], 200),
            default => response()->json(['exception' => $exception->getMessage()], 422),
        };
    }
}
