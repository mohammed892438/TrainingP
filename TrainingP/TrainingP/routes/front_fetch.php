<?php


Route::get('/cities', function () {
    return response()->file(public_path('assets/states.json'));
});
