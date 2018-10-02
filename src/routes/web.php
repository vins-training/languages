<?php
Route::prefix('/en')->name('lang.')->middleware('web')->group(function ($lang) {

    Route::resource('language','Nvt1904\Languages\LanguageController')->only('index','update','store','destroy');
    
    Route::get('/push','Nvt1904\Languages\LanguageController@push')->name('push');
    Route::get('/test',function(){
        return view('Languages::test');
    });
});

