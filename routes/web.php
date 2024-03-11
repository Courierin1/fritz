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



/*
 Site route start
|
*/

Auth::routes(['verify' => true]);
//['verify' => true]

//////// User Front Routes //////////
// Route::middleware(['email_verify'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','HomeController@index')->name('home');
    Route::get('/events','HomeController@events')->name('site.events');
    Route::get('/event-details/{id}','HomeController@eventDetails')->name('site.event.details');
    Route::get('/about-us','HomeController@about')->name('site.about');
    Route::get('/contact-us','HomeController@contact')->name('site.contact-us');
    Route::get('/event-detail','HomeController@eventDetail')->name('site.event-detail');
    Route::post('/contact-us','HomeController@contactUs')->name('contact.post');
    Route::get('/profile/{id}','UserController@profile')->name('user.profile');
    Route::get('state-events','HomeController@getEventByState')->name('state.events');
    Route::get('/site-orders','HomeController@siteOrders')->name('site.orders');
    Route::post('/order/refund/request/{id}', 'HomeController@refundRequest')->name('refund_request'); // request refund
    Route::get('ajax-get-events','HomeController@ajaxGetEvents')->name('ajax.get.events');
    Route::get('/search','HomeController@search')->name('site.search');
    Route::get('ajax-search-events','HomeController@ajaxSearchEvents')->name('ajax.search.events');
    Route::get('sub_category_ajax','HomeController@subCategoryAjax')->name('sub_category_ajax');


    Route::get('/search-event','HomeController@searchEvent')->name('user.event.search');
    // Route::get('/site-orders','HomeController@siteOrders')->name('site.orders');
    Route::get('/site-profile','HomeController@siteProfile')->name('site.profile');
    Route::post('contact-organizer','HomeController@contactOrganizer')->name('site.contact.organizer');
    Route::post('like-event','UserController@checkLiked')->name('like.event');

    Route::get('/user/orders', 'UserController@userOrders')->name('site.user-orders'); // how many tickets are purchase by user

Route::group(['middleware' => ['auth']], function ()
{
    Route::post('/reset-password','UserController@updatePassword')->name('update_password');
    Route::post('/mannual_order', 'UserController@mannual_order')->name('mannual_order');

});

Route::group(['prefix' => 'admin'], function ()
{
    Route::group(['middleware' => ['auth','role:admin']], function ()
    {
        Route::get('/reset-password','UserController@editAdminPassword')->name('admin.edit_password');
        Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
        Route::get('/events','AdminController@events')->name('admin.events');
        Route::get('/event-planners','AdminController@eventPlanners')->name('admin.event.planners');
        Route::get('/admin/event_planner/{id}/events', 'AdminController@eventPlannerEvents')->name('event_planner_events');
        Route::get('/admin/participants/{id}', 'AdminController@showAdminParticipants')->name('participants');
        Route::get('/users','AdminController@users')->name('admin.users');
        // Route::get('/user-queries','AdminController@userQueries')->name('admin.user.queries');
        Route::get('/orders','AdminController@orders')->name('admin.orders');
        Route::get('/mass_emailing', 'AdminController@massEmailing')->name('admin.mass_emailing');
        Route::post('/mass_emailing', 'AdminController@submitMassEmailing')->name('admin.submit_mass_emailing');
        // Route::get('categories','AdminController@eventCategories')->name('admin.categories');
        // Route::get('sub-categories','AdminController@subCategories')->name('admin.sub.categories');
        Route::get('types','AdminController@eventTypes')->name('admin.types');
        Route::get('sale-reports','AdminController@salesReport')->name('admin.sale.reports');
        Route::get('event-dashboard','AdminController@eventDashboard')->name('event.dashboard');
        Route::get('view-event/{id}','AdminController@viewEvent')->name('view.event');
        Route::get('/event-orders/{id}','AdminController@order')->name('admin.event.orders');
        Route::get('order-details/{id}','AdminController@orderDetail')->name('admin.order.detail');
        // Route::get('participants','AdminController@participants')->name('participants');
        // Route::get('view-distribution/{id}','AdminController@viewDistribution')->name('view.distribution');

        Route::get('/edit-event-planner/distribution/{id}', 'AdminController@addDistribution')->name('edit_event_planner.distribution');
        Route::post('/update-event-planner/distribution', 'AdminController@insertDistribution')->name('update_event_planner.distribution');
        Route::get('/distribution/{id}', 'AdminController@distribution')->name('distribution');

        Route::get('/view_planner_sales/{id}', 'AdminController@viewSales')->name('view_sales');
        Route::get('/ajax-sales',  'AdminController@AdminajaxSales')->name('admin.ajax.sales');

        Route::get('view-allevent','AdminController@viewAllevent')->name('view.allevent');
        Route::get('view-allorganizer','AdminController@viewAllorganizer')->name('view.allorganizer');
        Route::get('planner-salereports','AdminController@plannerSalereports')->name('planner.salereports');
        Route::get('set-commision','AdminController@setCommision')->name('set.commision');
        Route::get('view-organizer/{id}','AdminController@viewOrganizer')->name('admin.view.organizer');
        Route::get('event-dashboard/{id}','AdminController@eventDashboard')->name('admin.event.dashboard');

        Route::get('event-planner/organizers/{planner_id}', 'AdminController@listPlannerOrganizers')->name('admin.organizers.list');
        Route::get('/organizers/{id}', 'AdminController@showPlannerOrganizer')->name('admin.organizers.view');

        // Event Type Routes
        Route::get('/categories', 'CategoryController@list')->name('admin.categories.list');
        Route::post('/categories/create', 'CategoryController@store')->name('admin.categories.store');
        Route::post('/categories/{id}/edit', 'CategoryController@update')->name('admin.categories.update');
        Route::get('/categories/{id}/destroy', 'CategoryController@destroy')->name('admin.categories.destroy');

        // slider
        Route::get('/slider', 'SliderController@index')->name('admin.slider.index');
        Route::post('/slider/store', 'SliderController@store')->name('admin.slider.store');
        Route::post('/slider/{id}/update', 'SliderController@update')->name('admin.slider.update');
        Route::get('/slider/{id}/destroy', 'SliderController@destroy')->name('admin.slider.destroy');

        // Route::resource('slider', SliderController::class);

        // Event Type Routes
        Route::get('/types', 'TypeController@list')->name('admin.types.list');
        Route::post('/types/create', 'TypeController@store')->name('admin.types.store');
        Route::post('/types/{id}/edit', 'TypeController@update')->name('admin.types.update');
        // Route::post('/types/update_status/{id}', 'TypeController@updateStatus')->name('admin.types.update_status');
        Route::get('/types/{id}/destroy', 'TypeController@destroy')->name('admin.types.destroy');

        // User Queries Routes
        Route::get('/user-queries', 'AdminController@listUserQueires')->name('admin.user-queries.list');
        Route::get('/user-queries/{id}', 'AdminController@showUserQueires')->name('admin.user-queries.view');
        Route::get('/counts','AdminController@getAllPublishedEventsForPie')->name('pie.data');
        Route::get('/event-sales-report-ajax','AdminController@ajaxSales')->name('ajax.admin.sales');

        Route::get('/events/refund-requests', 'AdminController@ListRefundRequest')->name('list_admin_refund_requests'); // how many tickets are sold OrderTicket
        Route::post('/events/update/refund-request/{id}', 'AdminController@UpdateRefundRequest')->name('update_admin_refund_request'); // how many tickets are sold OrderTicket

        // Route::get('order-details/{id}','AdminController@orderDetail')->name('admin.order.detail');

        Route::get('user-delete/{id}','AdminController@deleteUser')->name('admin.user.delete');
    });
});

Route::group(['prefix' => ((Auth()->check() && Auth()->user()->is_planner==0)? 'user':'planner')], function ()
{
    Route::group(['middleware' => ['auth','role:user','verified']], function ()
    {
        Route::get('/reset-password','UserController@editPlannerPassword')->name('planner.edit_password');
        Route::get('/password-reset','UserController@editUserPassword')->name('user.edit_password');
        // Cart
        Route::post('/invoice_payment_type', 'UserController@invoice_payment_type')->name('invoice_payment_type');

        Route::get('/cart', 'UserController@cart')->name('cart');
        Route::get('/checkout', 'UserController@checkout')->name('checkout');
        Route::get('/clear/cart', 'UserController@clearCart')->name('clear.cart');
        Route::get('/cart/minus/quantity', 'UserController@minusQuantity')->name('cart.minus.quantity');
        Route::get('/cart/plus/quantity', 'UserController@plusQuantity')->name('cart.plus.quantity');
        Route::get('/cart/remove/product', 'UserController@removeProduct')->name('cart.remove.product');
        Route::post('/add_to_cart', 'UserController@addToCart')->name('add_to_cart');
        Route::get('/order_thanku', 'UserController@order_thanku')->name('order_thanku');

        Route::post('/stripe_pay', 'UserController@stripe_pay')->name('stripe_pay');
        Route::get('/stripe_success', 'UserController@stripe_success')->name('stripe_success');
        Route::get('/stripe_cancel', 'UserController@stripe_cancel')->name('stripe_cancel');

        Route::get('paypal_pay', 'UserController@paypal_pay')->name('paypal_pay');
        Route::get('event-details', 'UserController@paypal_success')->name('paypal_success');
        Route::get('paypal_cancel', 'UserController@paypal_cancel')->name('paypal_cancel');

        Route::get('/user/invoice/{id}/print', 'UserController@printInvoice')->name('print_invoice'); // view user followers and liked events


        Route::get('/events/refund-requests', 'UserController@ListRefundRequest')->name('list_refund_requests'); // how many tickets are sold OrderTicket
        Route::post('/events/update/refund-request/{id}', 'UserController@UpdateRefundRequest')->name('update_refund_request'); // how many tickets are sold OrderTicket


        Route::get('/dashboard','UserController@index')->name('user.dashboard');
        Route::get('/create-event','UserController@createEvent')->name('user.create.event');
        Route::get('event-detail/{id}','UserController@createEventDetails')->name('user.create.event.details');
        Route::get('event-ticket/{id}','UserController@createEventTickets')->name('user.create.event.tickets');
        Route::get('publish-event/{id}','UserController@publishEvent')->name('user.create.event.publish');
        Route::get('/update-event/{id}','UserController@updateEvent')->name('user.edit.event');
        Route::get('update/event-detail/{id}','UserController@updateEventDetails')->name('user.edit.event.details');
        Route::get('update/event-ticket/{id}','UserController@updateEventTickets')->name('user.edit.event.tickets');
        Route::get('update/publish-event/{id}','UserController@updatepublishEvent')->name('user.edit.event.publish');
        Route::get('/events','UserController@events')->name('user.events');

        Route::get('get-subcategories','UserController@getSubcategories')->name('get.subcategories');
        Route::post('create-event','EventController@insertEvent')->name('user.create.event.post');
        Route::post('create-event-detail','EventController@insertEventDetails')->name('user.create.event.details.post');
        Route::post('create-event-ticket','EventController@insertTicket')->name('user.create.event.tickets.post');
        Route::post('publish-event','EventController@insertPublish')->name('user.create.event.publish.post');

        Route::post('update-event','EventController@updateEvent')->name('user.edit.event.post');
        Route::post('update-event-detail','EventController@updateEventDetails')->name('user.edit.event.details.post');
        Route::post('update-event-ticket','EventController@updateEventTickets')->name('user.edit.event.tickets.post');

        Route::post('/event/destroy', 'EventController@destroy')->name('user.event.destroy');


        Route::get('events/check_organizer', 'EventController@checkOrganizer')->name('check_organizer');

        Route::post('/check_follow', 'OrganizerController@checkFollower')->name('user.organizers.check_follow'); // ajax request in user/view_event & admin/view_event file for ordering ticket


        Route::get('get-subcategories','UserController@getSubcategories')->name('get.subcategories');
        Route::get('account-information','UserController@plannerAccountInformation')->name('event_planner.account.information');
        Route::get('user-account-information','UserController@userAccountInformation')->name('user.account.information');
        Route::post('/insert_account_settings', 'UserController@insertAccountSettings')->name('insert_event_account_settings');

        Route::get('sales-report','UserController@salesReport')->name('sales.report');
        Route::get('/events/ajax-sales',  'UserController@ajaxSales')->name('ajax.sales');

        Route::get('analytics','UserController@analytics')->name('analytics');
        // Route::get('/events/analytics','EventController@analytics')->name('analytics');
        Route::get('/events/ajax-analytics','UserController@ajaxAnalytics')->name('ajax.analytics');

        Route::get('event-calendar','UserController@eventCalendar')->name('event.calendar');
        Route::get('/ajax-events', 'UserController@ajaxEvents')->name('get.ajaxevents');

        Route::get('contact-organizer','UserController@viewContactOrganizer')->name('user.contact.organizer');
        Route::get('view-event/{id}','UserController@viewEvent')->name('user.view.event');
        Route::get('/event-orders','UserController@order')->name('user.orders');
        Route::get('order-details/{id}','UserController@orderDetail')->name('user.order.detail');


        // Event Organizer Routes
        Route::get('/organizers', 'OrganizerController@list')->name('user.organizers.list');
        Route::get('/organizers/create','OrganizerController@create')->name('user.organizers.create');
        Route::get('/organizers/{id}', 'OrganizerController@show')->name('user.organizers.view');
        Route::post('/organizers/create', 'OrganizerController@store')->name('user.organizers.store');
        Route::get('/organizers/{id}/edit', 'OrganizerController@edit')->name('user.organizers.edit');
        Route::post('/organizers/{id}/edit', 'OrganizerController@update')->name('user.organizers.update');
        Route::post('/organizers/{id}/destroy', 'OrganizerController@destroy')->name('user.organizers.destroy');



    });

});

Route::get('/cache/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->back()->withSuccess('System Cache Has Been Removed.');
})->name('front.cache.clear');
