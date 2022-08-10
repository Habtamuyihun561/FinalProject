<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;

Auth::routes(['register'=>false]);
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'where' => ['locale' => '[a-zA-Z]{2}']], function() {

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
Route::get('user/verify_email','FrontendController@verfiy_email')->name('verfiy_email');
// Reset password
Route::get('password-reset', 'FrontendController@showResetForm')->name('password-reset'); ;
//
// Socialite
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@blog')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::get('/service','FrontendController@service')->name('service');
Route::post('/contact/message','MessageController@store')->name('contact.store');

Route::get('/free-auction','FrontendController@freeAuctionblog')->name('free-auction');

Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');
Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids','FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists','FrontendController@productLists')->name('product-lists');
Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');
// Blog
Route::get('/blog','FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}','FrontendController@blogDetail')->name('blog.detail');
Route::get('/free-blog-detail/{slug}','FrontendController@freeblogDetail')->name('free-blog-detail');
Route::get('/blog/search','FrontendController@blogSearch')->name('blog.search');
Route::post('/blog/filter','FrontendController@blogFilter')->name('blog.filter');
Route::get('blog-cat/{slug}','FrontendController@blogByCategory')->name('blog.category');
Route::get('blog-tag/{slug}','FrontendController@blogByTag')->name('blog.tag');
//

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
// NewsLetter
Route::post('/subscribe','FrontendController@subscribe')->name('subscribe');



// document Payment
Route::get('payment/', 'PaymentController@yenepay')->name('payment');
Route::get('detail/{id}', 'DocumentController@document_detail')->name('detail');
Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::get('ipn', 'PaymentController@ipn')->name('payment.ipn');
Route::get('payment/success', 'PaymentController@success')->name('payment.success');

// auction payment

Route::get('payment/{total_price}', 'PaymentController@pay_for_auction')->name('auction-payment');
Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::get('ipn', 'PaymentController@ipn')->name('payment.ipn');
Route::get('payment/success', 'PaymentController@success')->name('payment.success');



// Tin_number
Route::get('/autocomplete-search', [TypetinController::class, 'autocompleteSearch']);



});

// Backend section start

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users','UsersController');
    // Banner
    // Route::resource('banner','BannerController');
    // // Brand
    // Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','CategoryController');
    // Product
    Route::resource('/product','ProductController');
    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');
    // POST category
    Route::resource('/post-category','PostCategoryController');
    // Post tag
    Route::resource('/post-tag','PostTagController');
    // Post
    // Route::get('auctionfee', 'AuctionController@auctionfee')->name('auctionfee');
    Route::resource('/post','AuctionController');
    Route::get('/auctioLists','AuctionController@auctioLists')->name('auctioLists');
    // Route::post('document_store','AuctionController@documentstore')->name('documentstore');

    Route::resource('/document','DocumentController');
    Route::get('/document-detail/{code}','DocumentController@show_detail')->name('document-detail');

    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');



});




Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    //  Order
    // Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    // Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    // Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    // Product Review
    // Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    // Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    // Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    // Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');
    Route::resource('/post','AuctionController');
    Route::resource('/contract','ContractController');
    // Route::post('document_store','AuctionController@documentstore')->name('documentstore');

    Route::resource('/document','DocumentController');
    // Post comment
    // Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    // Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    // Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    // Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
//tin number

//
Route::resource('/contract','ContractController');
Route::resource('/feedback','FeedbackController');
Route::resource('/submiteddocument','SubmittedDocument');
Route::get('/feedback-list','FeedbackController@feedbackLists')->name('feedback-list');

// Route::post('/submitted-document/{id}','')->name('submitted-document');

