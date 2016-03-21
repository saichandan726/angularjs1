<?php

Route::get('/',function()
{
	return view::make('hello');
});
Route::resource('welcome','WelcomeController');