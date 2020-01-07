<?php
use App\Route;

Route::set("GET", "/", "MainController@homePage");

// Biff
Route::set("GET", "/biff/hold-info", "MainController@holdInfoPage");
Route::set("GET", "/biff/festival-info", "MainController@festivalInfoPage");

// Event
Route::set("GET", "/event/participate", "EventController@participatePage");

// User
Route::set("GET", "/users/login", "UserController@loginPage", "GUEST");
Route::set("POST", "/users/login", "UserController@login", "GUEST");
Route::set("GET", "/users/join", "UserController@joinPage");

Route::set("GET", "/users/logout", "UserController@logout", "USER");

// Apply
Route::set("GET", "/apply", "MovieController@applyPage", "USER");
Route::set("POST", "/apply", "MovieController@apply", "USER");

// Calender
Route::set("GET", "/calender", "MovieController@calenderPage");

Route::redirect();