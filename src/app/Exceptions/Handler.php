<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->reportable(function (Throwable $e) {
			//
		});

		$this->renderable(function (Throwable $e, Request $request) {

			if ($request->is('api/*') || $request->ajax())
			{
				Log::error('[API Error] '.$request->method().': '.$request->fullUrl());

				if ($this->isHttpException($e))
				{
					$message = $e->getMessage() ?: HttpResponse::$statusTexts[$e->getStatusCode()];
					Log::error($message);

					return response()->json([
						'message' => $message
					], $e->getStatusCode());
				}
				elseif ($e instanceof ValidationException)
				{
					Log::error($e->errors());

					return $this->invalidJson($request, $e);
				}
				else
				{
					return response()->json([
						'message' => 'Internal Server Error'
					], 500);
				}
			}
        });
    }
}
