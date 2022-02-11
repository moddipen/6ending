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

// Autho Routes
require __DIR__.'/auth.php';

// Language Switch
Route::get('language/{language}', 'LanguageController@switch')->name('language.switch');

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('terms', 'FrontendController@terms')->name('terms');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::get('profile/changePassword/{username}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch('profile/changePassword/{username}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::delete('users/userProviderDestroy', ['as' => 'users.userProviderDestroy', 'uses' => 'UserController@userProviderDestroy']);
    });
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:users_dashboard']], function () {
    Route::get('users/dashboard', 'BackendController@user_dashboard')->name('users.dashboard');
    Route::get("matches/events/{id}/{match_id}", "MatchController@events")->name("matches.events");
    /**
     * Bet Module
     */
    $module_name = 'bets';
    $controller_name = 'BetController';
    Route::post("$module_name/store", ['as' => "$module_name.store", 'uses' => "$controller_name@store"]);
    // Route::get("$module_name/index", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("bets/{match_id}", "BetController@list")->name("bets.placed");
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_user_dashboard']], function () {
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');   
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {

    /**
     * Reports
     */
    Route::get("credit-debit/reports", "ReportController@credit_debit_report")->name("credit.debit.report");    
    Route::get("credit-debit/reports/datatable", ['as' => "credit.debit.report.datatable", 'uses' => "ReportController@credit_debit_report_datatable"]);

    Route::get("betting/reports", "ReportController@betting_report")->name("betting.report");
    Route::get("betting/reports/datatable", ['as' => "betting.report.datatable", 'uses' => "ReportController@betting_report_datatable"]);

    Route::get("bethistory/reports", "ReportController@betting_history_report")->name("betting.history.report");
    Route::get("betting/history/reports/datatable", ['as' => "betting.history.report.datatable", 'uses' => "ReportController@betting_history_report_datatable"]);

    /**
     * Match Routes
     * 
     */
    Route::resource('matches', 'MatchController');
    Route::post("matches/datatable", ['as' => "matches.datatable", 'uses' => "MatchController@datatable"]);
    Route::post("matches/updateStatus", "MatchController@update_status")->name("matches.update-status");
    Route::post("matches/updateType", "MatchController@update_type")->name("matches.update-type");
    Route::get("matches/events/list/{id}/{match_id}", "MatchController@event_backend")->name("matches.events.list");    
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    
    

    /*
        Event Type Routes
    */
    Route::post('eventtypes/ajax-dropdown', ['as' => 'eventtypes.get_event_types_ajax', 'uses' => 'EventtypeController@ajax_dropdown_list']);


    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
       
        
    });
 

    /*
    *
    *  Matchtypevent Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'eventmanagers';
    $controller_name = 'MatchtypeeventController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::post("$module_name/datatable", ['as' => "$module_name.datatable", 'uses' => "$controller_name@datatable"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    Route::post("$module_name/update", "$controller_name@update")->name("$module_name.update");
    Route::post("$module_name/updateStatus", "$controller_name@update_status")->name("$module_name.update-status");
    
    
    /*
    *
    *  Matchtypevent Result Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'matchevents';
    $controller_name = 'MatchEventResultController';
    Route::post("$module_name/updateresult", "$controller_name@update_result")->name("$module_name.update-result");
    
    


    /*
    *
    *  Matches Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'matches';
    $controller_name = 'MatchController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::post("$module_name/datatable", ['as' => "$module_name.datatable", 'uses' => "$controller_name@datatable"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    Route::post("$module_name/update", "$controller_name@update")->name("$module_name.update");
    Route::post("$module_name/updateStatus", "$controller_name@update_status")->name("$module_name.update-status");
    // Route::post("$module_name/settlement", "$controller_name@settlement")->name("$module_name.settlement");



    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::post("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::get("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::get("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
    
    /**
     * Credit Module
     */
    $module_name = 'credits';
    $controller_name = 'CreditController';
    Route::post("$module_name/credit/update", ['as' => "$module_name.update", 'uses' => "$controller_name@credit_update"]);    
    Route::post("$module_name/credit/store", ['as' => "$module_name.store", 'uses' => "$controller_name@store"]);    

    // Bet Coins Module
    $module_name = 'betcoins';
    $controller_name = 'BettingLimitController';
    Route::post("$module_name/BettingLimit/store",['as' => "$module_name.store", 'uses' =>"$controller_name@store"]);

    /**
     * Match event settlement
     */
    $module_name = 'settlements';
    $controller_name = 'MatchEventSettlementController';
    Route::post("$module_name/store", ['as' => "$module_name.store", 'uses' => "$controller_name@store"]);    
});