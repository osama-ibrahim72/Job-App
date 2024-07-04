<?php

use App\Http\Controllers\Api\Mgr\Auth\LoginController;
use App\Http\Controllers\Api\Mgr\Positions\PositionController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
], function() {

    /*
    |----------------------------------------------------------------
    | Manager routes group
    |----------------------------------------------------------------
    | Here is where the management can log in, check the supplier and merchants.
    | orders. Can add a new supplier with products. Updating info
    */
    Route::group([
        'as' =>'mgr.',
        'prefix' => 'mgr',
    ], function() {

        /*
        |----------------------------------------------------------------
        | manager routes group
        |----------------------------------------------------------------
        | Here is where the supplier can log in, add products.
        | Adding offers, receiving orders etc..
        */
        Route::group([
            'as' => 'auth.',
            'prefix' => 'auth',
            'namespace' => 'Auth'
        ], function() {
            Route::post('login', [LoginController::class, '__invoke']);
        });


        /**
         * The authentication group area
         */
        Route::group([
            'middleware' => [
                Authenticate::class . ':sanctum',
                \App\Http\Middleware\EnsureHasMgrAccessMiddleware::class
            ]
        ], function() {

            /**
             * positions area
             */
            Route::group([
                'as' => 'positions.',
            ], function() {
                Route::get('positions/', [PositionController::class ,'index'])->name('list');
                Route::get('positions/{position}', [PositionController::class ,'show'])->name('show');

            });

        });

    });

    /*
    |----------------------------------------------------------------
    | Supplier routes group
    |----------------------------------------------------------------
    | Here is where the supplier can log in, add products.
    | Adding offers, receiving orders etc..
    */
    Route::group([
        'as'=>'reg.',
        'prefix' => 'reg',
    ], function() {
        /*
       |----------------------------------------------------------------
       | regular routes group
       |----------------------------------------------------------------
       | Here is where the supplier can log in, add products.
       | Adding offers, receiving orders etc..
       */
        Route::group([
            'as' => 'auth.',
            'prefix' => 'auth',
            'namespace' => 'Auth'
        ], function() {
            Route::post('login', [\App\Http\Controllers\Api\Regular\Auth\LoginController::class, '__invoke']);
        });


        /**
         * The authentication group area
         */
        Route::group([
            'middleware' => [
                Authenticate::class . ':sanctum',
                \App\Http\Middleware\EnsureHasRegularAccessMiddleware::class
            ]
        ], function() {

            /**
             * positions area
             */
            Route::group([
                'as' => 'positions.',
            ], function() {
                Route::apiResource('positions', \App\Http\Controllers\Api\Regular\Positions\PositionController::class )->names([
                    'show'=> 'show',
                    'index'=>'list',
                    'store'=>'store',
                    'destroy'=>'delete',
                    'update'=>'update'
                ]);

            });

        });
    });


});
