<?php

Route::match(['get','post'],config('sdds.route'),function(){
    return view('SDDS::index');
});