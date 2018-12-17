<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',
    function(){
        return redirect('/login');
    }
);

Route::get('/home', function(){
    Auth::check();
    return Redirect::to('orders');
});

Auth::routes();


/*Writers*/
Route::group(['middleware' => ['auth','revalidate','account','admin']], function () {
        Route::get('/writers','UserController@index')->name('writers');

        Route::get('/getWriter/{id}','UserController@show')->name('getWriter');
        Route::post('/delete','UserController@delete')->name('del');
        Route::get('/editWriter/{id}','UserController@edit')->name('editWriter');
        Route::post('/updateWriter/{id}','UserController@update')->name('updateWriter');
        Route::get('/delWriter/{id}','UserController@destroy')->name('delWriter');
        /*new users*/
        Route::get('/newWriters','UserController@getNewWriters')->name('newWriters');
        /*blocked*/
        Route::get('/blocked','UserController@getBlockedWriters')->name('blocked');
        /*activate writer*/
        Route::post('/activate/{id}','UserController@activateWriter')->name('activate');
        /*deactivate writer*/
        Route::post('/deactivate/{id}','UserController@deactivateWriter')->name('deactivate');
});
/* route not to be restricted*/
Route::post('/addWriter','UserController@store')->name('addWriter');
//sometimes logout is invoked using get method
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

/*Orders*/
Route::get('/addOrder','OrderController@create')->name('addOrder')->middleware('admin');
Route::post('/saveOrder','OrderController@store')->name('saveOrder')->middleware('admin');
Route::get('/orders','OrderController@index')->name('orders');
Route::get('/getOrder/{id}','OrderController@show')->name('getOrder');
Route::get('/editOrder/{id}',['uses'=>'OrderController@edit','middleware'=>'orderStatus'])->name('editOrder')->middleware('admin');
Route::post('/updateOrder/{id}',['uses'=>'OrderController@update','middleware'=>'orderStatus'])->name('updateOrder')->middleware('admin');
Route::post('/delOrders','OrderController@deleteOrders')->name('delOrders')->middleware('admin');
Route::get('/delOrder/{id}','OrderController@destroy')->name('delOrder')->middleware('admin');
Route::get('/allocate/{id}', ['uses'=>'OrderController@allocate','middleware'=>'assignOrder'])->middleware('admin');
Route::post('/allocateOrder/{id}',['uses'=>'OrderController@allocateOrder','middleware'=>'assignOrder'])->name('allocateOrder')->middleware('admin');
//available orders
Route::get('/availableOrders','OrderController@getAvailableOrders')->name('availableOrders');
//current orders
Route::get('/currentOrders','OrderController@getCurrentOrders')->name('currentOrders');
//awaiting feedback orders
Route::get('/a_feedback','OrderController@a_feedback')->name('a_feedback');
Route::get('/moreFeedback/{id}', 'OrderController@moreFeedback')->name('moreFeedback');
Route::post('/addFeedback/{id}', 'OrderController@addFeedback')->name('addFeedback');
Route::post('/ratings/{id}','OrderController@addRating')->name('ratings');
//cancelled orders
Route::get('/cancelledOrders','OrderController@getCancelledOrders')->name('cancelledOrders');
//accepted orders
Route::get('/acceptedOrders','OrderController@getAcceptedOrders')->name('acceptedOrders');
// revisionOrders
Route::get('/revisionOrders','OrderController@getRevisionOrders')->name('revisionOrders');

//writers
Route::get('/apply/{id}','OrderController@applyOrder')->name('apply')->middleware('writer');
Route::get('/upload/{id}', 'OrderController@upload')->name('upload')->middleware('writer');
Route::post('/uploadWork', 'OrderController@uploadWork')->name('uploadWork')->middleware('writer');



//Feedback
Route::get('/getFeedback', 'Feedback@index')->name('feedback');
Route::post('/delFeedback','Feedback@delete')->name('delFeedback');