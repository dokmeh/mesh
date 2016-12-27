<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');
Route::get('aj', 'PagesController@home_ajax');
Route::get('works', 'PagesController@works');
Route::get('ajworks', 'PagesController@works_ajax');
Route::get('works/{url}', 'PagesController@work');
Route::get('ajworks/{url}', 'PagesController@work_ajax');
Route::get('studio', 'PagesController@studio');
Route::get('ajstudio', 'PagesController@studio_ajax');
Route::get('research', 'PagesController@research');
Route::get('ajresearch', 'PagesController@research_ajax');
Route::get('news-events', 'PagesController@events');
Route::get('ajnews-events', 'PagesController@events_ajax');
Route::get('news-events/{url}', 'PagesController@event');
Route::get('ajnews-events/{url}', 'PagesController@event_ajax');

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function(){
    Route::group(['middleware' => 'isloggedin', 'namespace'=>'Admin'], function(){
        Route::get('/', array('as' => 'main', 'uses' => 'UserController@main'));
        Route::get('changepass', array('as' => 'chpass', 'uses' => 'UserController@chpass'));
        Route::post('changepass', array('as' => 'chpassresult', 'uses' => 'UserController@chpass_result'));
        Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
        Route::group(['prefix' => 'projects'], function(){
            Route::get('/', array('as' => 'prjmain', 'uses' => 'ProjectsController@index'));
            Route::get('category', array('as' => 'prjcatget', 'uses' => 'ProjectsController@cats_get'));
            Route::post('category', array('as' => 'prjcatset', 'uses' => 'ProjectsController@cats_set'));
            Route::get('status', array('as' => 'prjstatusget', 'uses' => 'ProjectsController@statuses_get'));
            Route::post('status', array('as' => 'prjstatusset', 'uses' => 'ProjectsController@statuses_set'));
            Route::get('new', array('as' => 'prjnew', 'uses' => 'ProjectsController@create'));
            Route::post('new', array('as' => 'prjnewres', 'uses' => 'ProjectsController@create_res'));
            Route::get('info/{url}', array('as' => 'prjinfo', 'uses' => 'ProjectsController@info'));
            Route::post('info/{url}', array('as' => 'prjinfores', 'uses' => 'ProjectsController@info_res'));
            Route::get('awards/{url}', array('as' => 'prjawards', 'uses' => 'ProjectsController@awards'));
            Route::post('awards/{url}', array('as' => 'prjawardsres', 'uses' => 'ProjectsController@awards_res'));
            Route::get('links/{url}', array('as' => 'prjlinks', 'uses' => 'ProjectsController@links'));
            Route::post('links/{url}', array('as' => 'prjlinksres', 'uses' => 'ProjectsController@links_res'));
            Route::get('press/{url}', array('as' => 'prjpress', 'uses' => 'ProjectsController@press'));
            Route::post('press/{url}', array('as' => 'prjpressres', 'uses' => 'ProjectsController@press_res'));
            Route::get('images/{url}', array('as' => 'prjimages', 'uses' => 'ProjectsController@images'));
            Route::post('thumb/{url}', array('as' => 'prjthumb', 'uses' => 'ProjectsController@thumb_res'));
            Route::post('newimages/{url}', array('as' => 'prjnewimages', 'uses' => 'ProjectsController@newimg_res'));
            Route::post('orderimages/{url}', array('as' => 'prjorderimages', 'uses' => 'ProjectsController@orderimg_res'));
            Route::get('delete/{url}', array('as' => 'prjdelete', 'uses' => 'ProjectsController@delete'));
            Route::post('delete/{url}', array('as' => 'prjdeleteres', 'uses' => 'ProjectsController@delete_res'));
            Route::get('order', array('as' => 'prjorder', 'uses' => 'ProjectsController@order'));
            Route::post('order', array('as' => 'prjorderres', 'uses' => 'ProjectsController@order_res'));
        });
        Route::group(['prefix' => 'events'], function(){
            Route::get('/', array('as' => 'evemain', 'uses' => 'EventsController@index'));
            Route::get('new', array('as' => 'evenew', 'uses' => 'EventsController@create'));
            Route::post('new', array('as' => 'evenewres', 'uses' => 'EventsController@create_res'));
            Route::get('info/{url}', array('as' => 'eveinfo', 'uses' => 'EventsController@info'));
            Route::post('info/{url}', array('as' => 'eveinfores', 'uses' => 'EventsController@info_res'));
            Route::get('images/{url}', array('as' => 'eveimages', 'uses' => 'EventsController@images'));
            Route::post('thumb/{url}', array('as' => 'evethumb', 'uses' => 'EventsController@thumb_res'));
            Route::post('newimages/{url}', array('as' => 'evenewimages', 'uses' => 'EventsController@newimg_res'));
            Route::post('orderimages/{url}', array('as' => 'eveorderimages', 'uses' => 'EventsController@orderimg_res'));
            Route::get('delete/{url}', array('as' => 'evedelete', 'uses' => 'EventsController@delete'));
            Route::post('delete/{url}', array('as' => 'evedeleteres', 'uses' => 'EventsController@delete_res'));
            Route::get('order', array('as' => 'eveorder', 'uses' => 'EventsController@order'));
            Route::post('order', array('as' => 'eveorderres', 'uses' => 'EventsController@order_res'));
        });
    });
    Route::get('login', array('as' => 'login', 'uses' => 'Admin\UserController@login'));
    Route::post('login', array('as' => 'loginresult', 'uses' => 'Admin\UserController@login_result'));
});
