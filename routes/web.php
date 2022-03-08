<?php
// use App\Exports\Detailed;
// use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
Auth::routes([
    'register' => false
]);

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login/', 'Auth\LoginController@login');
Route::post('set-terminal', 'Auth\LoginController@setTerminal')->name('set-terminal');
Route::resource('setup', 'SetupController')->only(['index']);

Route::middleware(['auth', 'check-network', 'sync-transactions'])->group(function() {
    Route::middleware(['role-access'])->group(function() {
        //TRANSACTION
        Route::prefix('maintenance')->group(function() {
            Route::resource('change_password', 'ChangePasswordController')->only(['edit', 'update']);
        });
        Route::prefix('transactions')->group(function() {
            // COI A
            Route::prefix('coi_a')->group(function() {
                Route::get('search', 'CoiAController@search')->name('coi_a.search');
                Route::get('print/{coi_a}', 'CoiAController@print')->name('coi_a.print');
                Route::get('post/{coi_a}', 'CoiAController@post')->name('coi_a.post');
            });
            Route::resource('coi_a', 'CoiAController');
            // COI AO
            Route::prefix('coi_ao')->group(function() {
                Route::get('search', 'CoiAOController@search')->name('coi_ao.search');
                Route::get('print/{coi_ao}', 'CoiAOController@print')->name('coi_ao.print');
                Route::get('post/{coi_ao}', 'CoiAOController@post')->name('coi_ao.post');
            });
            Route::resource('coi_ao', 'CoiAOController');
            // COI B
            Route::prefix('coi_b')->group(function() {
                Route::get('search', 'CoiBController@search')->name('coi_b.search');
                Route::get('print/{coi_b}', 'CoiBController@print')->name('coi_b.print');
                Route::get('post/{coi_b}', 'CoiBController@post')->name('coi_b.post');
            });
            Route::resource('coi_b', 'CoiBController');
            // COI D
            Route::prefix('coi_d')->group(function() {
                Route::get('search', 'CoiDController@search')->name('coi_d.search');
                Route::get('print/{coi_d}', 'CoiDController@print')->name('coi_d.print');
                Route::get('post/{coi_d}', 'CoiDController@post')->name('coi_d.post');
            });
            Route::resource('coi_d', 'CoiDController');
            // COI R
            Route::prefix('coi_r')->group(function() {
                Route::get('search', 'CoiRController@search')->name('coi_r.search');
                Route::get('print/{coi_r}', 'CoiRController@print')->name('coi_r.print');
                Route::get('post/{coi_r}', 'CoiRController@post')->name('coi_r.post');
            });
            Route::resource('coi_r', 'CoiRController');
        });
        Route::prefix('reports')->group(function() {
            // POSTED TRANSACTIONS
            Route::get('posted/search', 'PostedController@search')->name('posted.search');
            Route::get('posted/filter', 'PostedController@filter')->name('posted.filter');
            Route::get('posted/extract', 'PostedController@extract')->name('posted.extract');
            Route::resource('posted', 'PostedController')->only(['index', 'show']);
            // REPORTS
            Route::resource('detailed', 'DetailedController')->only(['index', 'store']);
            Route::resource('summary', 'SummaryController')->only(['index', 'store']);
            // ALL TRANSACTIONS
            Route::get('all/search', 'AllTransactionsController@search')->name('all.search');
            Route::get('all/filter', 'AllTransactionsController@filter')->name('all.filter');
            Route::resource('all', 'AllTransactionsController')->only(['index', 'show']);
        });
    });
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
