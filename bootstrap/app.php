<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //Add my new middleware - For Groups
        // $middleware->appendToGroup('user',[
        //     UserMiddleware::class,
        // ]);

        //redirect guest user 
        $middleware->redirectGuestsTo(fn (Request $request) => route('account.login'));

        $middleware->alias([
            'user' => UserMiddleware::class,
            'admin' => AdminMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
