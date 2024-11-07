<?php

// namespace App\Exceptions;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Throwable;

// class Handler extends ExceptionHandler
// {
//     /**
//      * A list of exception types with their corresponding custom log levels.
//      *
//      * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
//      */
//     protected $levels = [
//         //
//     ];

//     /**
//      * A list of the exception types that are not reported.
//      *
//      * @var array<int, class-string<\Throwable>>
//      */
//     protected $dontReport = [
//         //
//     ];

//     /**
//      * A list of the inputs that are never flashed to the session on validation exceptions.
//      *
//      * @var array<int, string>
//      */
//     protected $dontFlash = [
//         'current_password',
//         'password',
//         'password_confirmation',
//     ];

//     /**
//      * Register the exception handling callbacks for the application.
//      */
//     public function register(): void
//     {
//         $this->reportable(function (Throwable $e) {
//             //
//         });
//     }

//     public function render($request, Throwable $exception)
//     {
//         // Check if the exception is an instance of AuthenticationException
//         if ($exception instanceof AuthenticationException) {
//             // Return a JSON response if the request expects JSON
//             return response()->json(['error' => 'Unauthenticated'], 401);
//         }

//         // Let the parent class handle other exceptions
//         return parent::render($request, $exception);
//     }
    
// }


namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    // Other properties...

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // This is generally used for logging and does not return responses
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Check if the exception is an instance of AuthenticationException
        if ($exception instanceof AuthenticationException) {
            // Return a JSON response if the request expects JSON
            Log::alert('Unauthenticated request');

            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Let the parent class handle other exceptions
        return parent::render($request, $exception);
    }
}
