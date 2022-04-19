<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::resource('sendsms', 'SendsmsController');
Route::get('/staff', 'StaffController@index')->name('staff');

Route::get('/staff/list', 'StaffController@getstaffs')->name('staff.list');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'PagesController@index')->name('dashboard');
});

Route::group(['prefix' => 'apps','as' => 'apps.', 'namespace' => 'Apps', 'middleware' => ['auth']], function() {

    Route::get('interimember/list', 'InteriMemberController@list')->name('interimember.list');
    Route::resource('interimember', 'InteriMemberController');

    Route::get('fullmember/list', 'FullMemberController@list')->name('fullmember.list');
    Route::resource('fullmember', 'FullMemberController');

    Route::get('smstemplate/list', 'SmsTemplateController@list')->name('smstemplate.list');
    Route::resource('smstemplate', 'SmsTemplateController');

    Route::get('smsoutbox/list', 'SmsOutboxController@list')->name('smsoutbox.list');
    Route::resource('smsoutbox', 'SmsOutboxController');

    Route::get('smsfailedbox/list', 'FailedSMSBoxController@list')->name('smsfailedbox.list');
    Route::resource('smsfailedbox', 'FailedSMSBoxController');

    Route::get('smspendingbox/list', 'PendingSMSBoxController@list')->name('smspendingbox.list');
    Route::resource('smspendingbox', 'PendingSMSBoxController');

    Route::get('smsgroup/list', 'SmsGroupController@list')->name('smsgroup.list');
    Route::get('smsgroup/grouplist', 'SmsGroupController@grouplist')->name('smsgroup.grouplist');
    Route::post('smsgroup/groupStore', 'SmsGroupController@groupStore')->name('smsgroup.groupStore');
    Route::get('smsgroup/groupdelete', 'SmsGroupController@groupdelete')->name('smsgroup.groupdelete');
    Route::get('smsgroup/chosenlist', 'SmsGroupController@chosenlist')->name('smsgroup.chosenlist');
    Route::get('smsgroup/groupedit', 'SmsGroupController@groupedit')->name('smsgroup.groupedit');
    Route::resource('smsgroup', 'SmsGroupController');

    Route::get('shopservices/list', 'ShopServiceController@list')->name('shopservices.list');
    Route::resource('shopservices', 'ShopServiceController');

    Route::get('employees/list', 'EmployeeController@list')->name('employees.list');
    Route::resource('employees', 'EmployeeController');

    Route::get('customers/list', 'CustomerController@list')->name('customers.list');
    Route::resource('customers', 'CustomerController');

    Route::get('mpesa/list', 'MpesaTransactionController@list')->name('mpesa.list');
    Route::resource('mpesa', 'MpesaTransactionController');

    Route::get('expenses/list', 'ExpenseController@list')->name('expenses.list');
    Route::resource('expenses', 'ExpenseController');

    Route::get('sales/list', 'SalesOrderController@list')->name('sales.list');
    Route::resource('sales', 'SalesOrderController');

    Route::resource('composesms', 'ComposedSmsController');

});

// Application Management
Route::group(['prefix' => 'sys','as' => 'sysdev.', 'namespace' => 'SysDev', 'middleware' => ['auth']], function() {
    Route::get('menucats/listsubmenus', 'MenucategoryController@listsubmenus')->name('menucats.listsubmenus');
    Route::put('menucats/save_submenu', 'MenucategoryController@save_submenu')->name('menucats.save_submenu');
    Route::patch('menucats/delsubmenu', 'MenucategoryController@delsubmenu')->name('menucats.delsubmenu');
    Route::get('menucats/list', 'MenucategoryController@list')->name('menucats.list');
    Route::resource('menucats', 'MenucategoryController');

    Route::get('module/list', 'ModuleController@list')->name('module.list');
    Route::post('module/modviews', 'ModuleController@saveModuleView')->name('module.modviews');
    Route::resource('module', 'ModuleController');

    Route::get('member/list', 'MembersController@list')->name('member.list');
    Route::resource('member', 'MembersController');

    Route::get('listitem/list', 'ListitemController@list')->name('listitem.list');
    Route::resource('listitem', 'ListitemController');

    Route::get('user/list', 'UserController@list')->name('user.list');
    Route::resource('user', 'UserController');
    
});






// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

require __DIR__.'/auth.php';
