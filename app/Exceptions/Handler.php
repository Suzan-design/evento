<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function redirectTo()
    {
        return route('login');
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            $guards = $exception->guards();

            // Handle the case where guards array is null or empty
            if (empty($guards) || $guards[0] === null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated.'
                ], 401);
            }

            // Check if the request is using the 'web' guard
            if (in_array('web', $guards)) {
                return redirect()->guest($this->redirectTo());
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid Token'
            ], 498);
        }

        return parent::render($request, $exception);
    }

}
