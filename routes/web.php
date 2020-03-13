<?php

use App\Message;
use App\Work;
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

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


/*
* Route For messenger Controllers
*/
Route::get('/messenger', 'MessengerController@index')->name('messages.index');

Route::get('/messenger/count',function(){
    return Message::where('to','=',Auth::user()->id)
            ->where('read',0)->count();
});

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

/*
* Route For User Profile
*/
Route::get('/profile/{username}',[
    'uses' => 'ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth'],
    //'middleware' => ['verified'],
]);

Route::post('/profile/{username}',[
    'uses' => 'ProfileController@postProfile',
    'middleware' => ['auth'],
]);

/*
* Route For Social page
*/
Route::get('/social',[
    'uses' => 'SocialController@getSocial',
    'as' => 'social.index',
    'middleware' => ['auth']
]);

Route::post('/social',[
    'uses' => 'SocialController@postSocial',
    'as' => 'social.reply',
    'middleware' => ['auth']
]);

/*
* For Status in Social Page
*/

Route::get('/status',[
     'uses' => 'StatusController@getStatus',
    'as' => 'status.index',
    'middleware' => ['auth'],
]);

Route::get('/status/{user_id}',[
    'uses' => 'StatusController@getUserInfo',
    'middleware' => ['auth'],
]);

Route::post('/status',[
    'uses' => 'StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
]);

Route::get('/status_with_user/{status_id}',[
    'uses' => 'StatusController@get_status_with_user',
    'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/comment',[
     'uses' => 'StatusController@postComment',
    'as' => 'status.reply',
    'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like',[
    'uses' => 'StatusController@getLike',
    'as' => 'status.like',
    'middleware' => ['auth'],
]);


/*
* Workers
*/

Route::get('/workers',[
    'uses' => 'workController@getIndex',
    'as' => 'workers.index',
    'middleware' => ['auth'],
]);

Route::post('/workers/add',[
    'uses' => 'workController@addWorker',
    'as' => 'workers.add',
    'middleware' => ['auth'],
]);

Route::post('/workers/accept',[
    'uses' => 'workController@postAccept',
    'as' => 'workers.accept',
    'middleware' => ['auth'],
]);

Route::post('/workers/reject',[
    'uses' => 'workController@postReject',
    'as' => 'workers.reject',
    'middleware' => ['auth'],
]);

Route::post('/workers/delete',[
    'uses' => 'workController@postDelete',
    'as' => 'workers.delete',
    'middleware' => ['auth'],
]);

Route::post('/workers/edit',[
    'uses' => 'workController@postEdit',
    'as' => 'workers.edit',
    'middleware' => ['auth'],
]);

Route::get('/workers/count',function(){
    return Work::where('user_id','=',Auth::user()->id)
            ->where('accepted',0)
            ->orwhere('worker_id','=',Auth::user()->id)
            ->where('accepted',0)->count();
});

// Article Page =  get all articles
Route::get('/articles',[
    'uses' => 'ArticlesController@index',
    'as' => 'articles.list',
]);

/* Article Page = get single article*/
Route::get('/article/{slug}',[
    'uses' => 'ArticlesController@getArticle',
    'as' => 'articles.single',
]);
/*
* Route For Mvp
*/

/* Route to upload mvp */
Route::get('/mvp/add',[
    'uses' => 'MvpController@getAdd',
    'as' => 'mvp.add',
    'middleware' => ['auth']
]);
Route::post('/mvp/add',[
    'uses' => 'MvpController@postAdd',
    'middleware' => ['auth']
]);

/* Route to manage mvp */
Route::get('/mvp',[
    'uses' => 'MvpController@list',
    'as' => 'mvp.list',
    'middleware' => ['auth']
]);

Route::get('/mvp/search/{type}',[
    'uses' => 'MvpController@search',
    'as' => 'mvp.search',
    'middleware' => ['auth']
]);

Route::get('/mvp/{slug}',[
    'uses' => 'MvpController@getMvp',
    'as' => 'mvp.index',
    'middleware' => ['auth']
]);
Route::post('/mvp/{slug}',[
    'uses' => 'MvpController@postMvp',
]);

Route::get('/mvp/edit/{slug}',[
    'uses' => 'MvpController@getEditMvp',
    'as' => 'mvp.edit',
    'middleware' => ['auth']
]);
Route::post('/mvp/edit/{slug}',[
    'uses' => 'MvpController@postEditMvp',
    'middleware' => ['auth']
]);

Route::post('mvp/images/upload', 'Mvp_imagesController@store')->name('mvp.store');

Route::post('/mvp/feature/add',[
    'uses' => 'Mvp_featuresController@store',
    'as'   => 'mvp.store'
]);
/*
* Rout For Search Users
*/

Route::get('/users/{can_work_on}',[
    'uses' => 'SocialController@searchUsers',
    'as' => 'search.users',
    'mddleware' => ['auth'],
]);



/*
* Routes For Admin panel
*/

Route::get('/admin-dashboard',[
    'uses' => 'DashboardController@getIndex',
    'as' => 'dashboard.index',
    'middleware' => ['admin']
]);

/*
* to manage new mvp's
*/

Route::get('/dashboard/mvp',[
    'uses' => 'DashboardController@getMvp',
    'as' => 'dashboard.mvp',
    'middleware' => ['admin'],
]);

Route::post('/dashboard/mvp',[
    'uses' => 'DashboardController@postMvp',
]);

/*
* to manage mvp types
*/
Route::get('/dashboard/add_mvp_type',[
    'uses' => 'DashboardController@getAdd_mvp_type',
    'as' => 'dashboard.add_mvp_type',
    'middleware' => ['admin'],
]);
Route::post('/dashboard/add_mvp_type',[
    'uses' => 'DashboardController@postAdd_mvp_type',
]);
Route::get('/dashboard/mvp_type',[
    'uses' => 'DashboardController@getMvp_type',
    'as' => 'dashboard.mvp_type',
    'middleware' => ['admin'],
]);

Route::post('/dashboard/mvp_type',[
    'uses' => 'DashboardController@postMvp_type',
]);

/*
* to mange user status
*/

Route::get('/dashboard/status',[
    'uses' => 'DashboardController@getStatus',
    'as' => 'dashboard.status',
    'middleware' => ['admin'],
]);

// to add new category
Route::get('/dashboard/addCategory',[
    'uses' => 'DashboardController@getAddCategory',
    'as' => 'dashboard.addCategory',
    'middleware' => ['admin'],
]);

Route::post('/dashboard/addCategory',[
    'uses' => 'DashboardController@postAddCategory',
    'middleware' => ['admin'],
]);

// to manage all articles category
Route::get('/dashboard/category',[
    'uses' => 'DashboardController@getCategory',
    'as' => 'dashboard.category',
    'middleware' => ['admin'],
]);

Route::post('/dashboard/category',[
    'uses' => 'DashboardController@postCategory',
    'middleware' => ['admin'],
]);

/*
* to publich new article
*/

Route::get('/dashboard/publish_article',[
    'uses' => 'DashboardController@getPublishArticle',
    'as' => 'dashboard.publish_article',
    'middleware' => ['admin'],
]);
Route::post('/dashboard/publish_article',[
    'uses' => 'DashboardController@postPublishArticle',
    'middleware' => ['admin'],
]);

/*
* to list all published article
*/

Route::get('/dashboard/articles',[
    'uses' => 'DashboardController@getArticles',
    'as' => 'dashboard.articles',
    'middleware' => ['admin'],
]);

Route::post('/dashboard/articles',[
    'uses' => 'DashboardController@postArticles',
    'middleware' => ['admin'],
]);

Route::get('/dashboard/tickets',[
    'uses' => 'DashboardController@getTickets',
    'as' => 'dashboard.tickets',
    'middleware' => ['admin'],
]);

/*
* to manage site settings info
*/

Route::get('/dashboard/settings',[
    'uses' => 'DashboardController@getSettings',
    'as' => 'dashboard.settings',
    'middleware' => ['admin']
]);

Route::post('/dashboard/settings',[
    'uses' => 'DashboardController@postSettings',
    'middleware' => ['admin']
]);

/*
* to manage site users
*/

Route::get('/dashboard/users',[
    'uses' => 'DashboardController@getUsers',
    'as' => 'dashboard.users',
    'middleware' => ['admin']
]);

Route::post('/dashboard/users',[
'uses' => 'DashboardController@postUsers',
    'middleware' => ['admin']
]);


Route::get('/dashboard/add_user',[
    'uses' => 'DashboardController@getAdd_user',
    'as' => 'dashboard.add_user',
    'middleware' => ['admin']
]);

Route::post('/dashboard/add_user',[
'uses' => 'DashboardController@postAdd_user',
    'middleware' => ['admin']
]);
