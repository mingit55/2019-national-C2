<?php
use App\Route;

Route::set("GET", "/", "MainController@homePage");

// Biff
Route::set("GET", "/biff/hold-info", "MainController@holdInfoPage");
Route::set("GET", "/biff/festival-info", "MainController@festivalInfoPage");

// User
Route::set("GET", "/users/login", "UserController@loginPage", "GUEST");
Route::set("POST", "/users/login", "UserController@login", "GUEST");
Route::set("GET", "/users/join", "UserController@joinPage");

Route::set("GET", "/users/logout", "UserController@logout", "USER");

// Apply
Route::set("GET", "/apply", "MovieController@applyPage", "USER");
Route::set("POST", "/apply", "MovieController@apply", "USER");

// Schedules
Route::set("GET", "/schedules", "MovieController@schedulePage");
Route::set("GET", "/schedules/add", "MovieController@addSchedulePage");
Route::set("POST", "/schedules/add", "MovieController@addSchedule");

Route::set("GET", "/schedules/detail", "MovieController@scheduleDetailPage");

// Search
Route::set("GET", "/search", "MovieController@searchPage");

// Event
Route::set("GET", "/event/participate", "EventController@participatePage");
Route::set("POST", "/event/participate", "EventController@participate", "USER");

Route::set("GET", "/event/contest-list", "EventController@listpage");
Route::set("GET", "/event/contest-detail", "EventController@detailPage");



// API
Route::set("POST", "/api/take-schedules", "MovieController@takeSchedules");
Route::set("GET", "/api/download-schedules", "MovieController@downloadSchedules");
Route::set("POST","/api/good-contest", "EventController@goodContest", "USER");

Route::redirect();