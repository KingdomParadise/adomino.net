<?php
ini_set('memory_limit', '-1');

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;

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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function () {

    Route::get('/', 'HomeController')->name('home');

    Route::get('/domain/{hash}', 'LandingpageController@domain')->name('landingpage.domain');
    Route::post('/send-inquiry', 'LandingpageController@send')->name('landingpage.send');

    Route::get('/test', function () {

//        ssh_tunnel_call();
//        echo '<pre>';
//        $errorDomains = \App\Domain::where('domain', 'like', '%xn--%')->get();
////        $adomino_connection = DB::connection('adomino_com');
//        foreach ($errorDomains as $domain) {
//            $domain->domain = idn_to_utf8($domain->domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
//            $domain->save();
////            $res = $adomino_connection
////                ->table('dv_domains')
////                ->where('id', $domain->adomino_com_id)->get();
////            print_r($res);
//        }
//        die;
    });
    Route::get('/impressum', 'StaticController@imprint')->name('static.imprint');
    Route::get('/datenschutz', 'StaticController@dataPrivacy')->name('static.dataprivacy');
    Route::get('/bildnachweise', 'StaticController@imageLicences')->name('static.imagelicences');

    Route::group([
        'middleware' => ['auth', '2fa']
    ], function () {

        Route::get('/admin/2fa', 'LoginSecurityController@show2faForm')->name('2fa-settings');
        Route::post('/admin/2fa/generateSecret', 'LoginSecurityController@generate2faSecret')->name('generate2faSecret');
        Route::post('/admin/2fa/enable2fa', 'LoginSecurityController@enable2fa')->name('enable2fa');
        Route::post('/admin/2fa/disable2fa', 'LoginSecurityController@disable2fa')->name('disable2fa');

        // 2fa middleware
        Route::post('/admin/2fa/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');


//        Dashboard part started
        Route::get('/admin/dashboard', 'DashboardController@index')->name('dashboard');
//        Dashboard part ended

//    Users part started
        Route::get('/admin/users', 'UserController@index')->name('home');
        Route::get('/admin/users/get-all-users-json', 'UserController@getAllUsersJson')->name('get-all-users-json');
        Route::get('/admin/users/edit-user/{id}', 'UserController@getEditUserPage')->name('get-edit-user-page');
        Route::post('/admin/users/get-delete-user-modal', 'UserController@getDeleteUserModal')->name('get-delete-user-modal');
        Route::post('/admin/users/delete-user-process', 'UserController@deleteUserProcess')->name('delete-user-process');
        Route::get('/admin/users/add-new-user', 'UserController@addNewUserPage')->name('add-new-user-page');
        Route::post('/admin/users/add-new-user-process', 'UserController@addNewUserProcess')->name('add-new-user-process');
        Route::post('/admin/users/update-user-process', 'UserController@updateUserProcess')->name('update-user-process');
        Route::post('/admin/users/get-filter-user-modal', 'UserController@getFilterModal')->name('get-filter-user-modal');
//Users part ended

//    Inquiry part started
        Route::get('/admin/inquiry', 'InquiryController@index')->name('inquiry');
        Route::get('/admin/inquiry/get-all-inquiries-json', 'InquiryController@getAllInquiryJson')->name('get-all-inquiries-json');
        Route::get('/admin/inquiry/add-new-inquiry', 'InquiryController@addNewInquiry')->name('add-new-inquiry');
        Route::post('/admin/inquiry/add-new-inquiry-process', 'InquiryController@addNewInquiryProcess')->name('add-new-inquiry-process');
        Route::post('/admin/inquiry/get-anonymous-inquiry-modal', 'InquiryController@getAnonymousInquiryModal')->name('get-anonymous-inquiry-modal');
        Route::post('/admin/inquiry/anonymous-inquiry-process', 'InquiryController@anonymousInquiryProcess')->name('anonymous-inquiry-process');
        Route::get('/admin/inquiry/edit-inquiry/{id}', 'InquiryController@editInquiry')->name('edit-inquiry');
        Route::post('/admin/inquiry/update-inquiry-process', 'InquiryController@updateInquiryProcess')->name('update-inquiry-process');
        Route::post('/admin/inquiry/get-delete-inquiry-modal', 'InquiryController@getDeleteInquiryModal')->name('get-delete-inquiry-modal');
        Route::post('/admin/inquiry/delete-inquiry-process', 'InquiryController@deleteInquiryProcess')->name('delete-inquiry-process');
        Route::post('/admin/inquiry/get-filter-inquiry-modal', 'InquiryController@getFilterModal')->name('get-filter-inquiry-modal');
//    Inquiry part ended

//    Domain part started
        Route::get('/admin/domain', 'DomainController@index')->name('domain');
        Route::get('/admin/domain/get-all-domains', 'DomainController@getAllDomain')->name('get-all-domains');
        Route::get('/admin/domain/get-all-domains-json', 'DomainController@getAllDomainsJson')->name('get-all-domains-json');
        Route::get('/admin/domain/add-new-domain', 'DomainController@addNewDomainPage')->name('add-new-domain');
        Route::get('/admin/domain/edit-domain/{id}', 'DomainController@editDomain')->name('edit-domain');
        Route::post('/admin/domain/add-new-domain-process', 'DomainController@addNewDomainProcess')->name('add-new-domain-process');
        Route::post('/admin/domain/update-domain-process', 'DomainController@updateDomainProcess')->name('update-domain-process');
        Route::post('/admin/domain/get-delete-domain-modal', 'DomainController@getDeleteDomainModal')->name('get-delete-domain-modal');
        Route::post('/admin/domain/delete-domain-process', 'DomainController@deleteDomainProcess')->name('delete-domain-process');
        Route::post('/admin/domain/get-filter-domain-modal', 'DomainController@getFilterDomainModal')->name('get-filter-domain-modal');
//    Domain part ended

//        Not Found Domain part started
        Route::get('/admin/not-found-domain', 'NotFoundController@index')->name('not-found-domains');
        Route::get('/admin/not-found-domain/add-new-domain', 'NotFoundController@addNewDomain')->name('add-new-nf-domain');
        Route::get('/admin/not-found-domain/edit-domain/{id}', 'NotFoundController@editDomain')->name('edit-nf-domain');
        Route::get('/admin/not-found-domain/get-all-domains-json', 'NotFoundController@getAllDomainsJson')->name('get-all-nfdomains-json');
        Route::post('/admin/not-found-domain/update-domain-process', 'NotFoundController@updateDomainProcess')->name('update-nfdomain-process');
        Route::post('/admin/not-found-domain/add-domain-process', 'NotFoundController@addDomainProcess')->name('add-new-nfdomain-process');
        Route::post('/admin/not-found-domain/get-delete-not-found-domain-modal', 'NotFoundController@getDeleteNotFoundDomainModal')->name('get-delete-nfdomain-modal');
        Route::post('/admin/not-found-domain/delete-not-found-domain-process', 'NotFoundController@deleteNotFoundDomainProcess')->name('delete-not-found-domain-process');
        Route::post('/admin/not-found-domain/get-filter-nfdomain-modal', 'NotFoundController@getFilterNfDomainModal')->name('get-filter-nfdomain-modal');
//        Not Found Domain part ended

//        Visit Part Started
        Route::get('/admin/visits', 'VisitsController@index')->name('visits');
        Route::get('/admin/visits/get-all-visits-json', 'VisitsController@getAllVisitsJson')->name('get-all-visits-json');
        Route::post('/admin/visits/get-filter-visits-modal', 'VisitsController@getFilterModal')->name('get-filter-visits-modal');
//        Visit Part Ended

//        Daily Visit part started
        Route::get('/admin/daily-visits', 'DailyVisitController@index')->name('daily-visit');
        Route::get('/admin/visits/get-all-daily-visit-json', 'DailyVisitController@getAllDailyVisitJson')->name('get-all-daily-visit-json');
        Route::post('/admin/visits/get-filter-daily-visit-modal', 'DailyVisitController@getFilterModal')->name('get-filter-daily-visit-modal');
//        Daily Visit part ended

//        Statistic part started
        Route::get('/admin/statistics', 'StatisticController@index')->name('statistics');
        Route::get('/admin/statistics/get-all-statistics-json', 'StatisticController@getAllStatisticsJson')->name('get-all-statistics-json');
        Route::post('/admin/statistics/get-filter-statistics-modal', 'StatisticController@getFilterStatisticModal')->name('get-filter-statistics-modal');
//        statistic part ended

//        Logo Part Started
        Route::get('/admin/logo', 'LogoController@index')->name('logo');
        Route::get('/admin/logo/add-new-logo', 'LogoController@addNewLogo')->name('add-new-logo');
        Route::get('/admin/logo/edit-logo/{id}', 'LogoController@editLogo')->name('edit-logo');
        Route::post('/admin/logo/get-delete-logo-modal', 'LogoController@getDeleteLogoModal')->name('get-delete-logo-modal');
        Route::post('/admin/logo/delete-logo-process', 'LogoController@deleteLogoProcess')->name('delete-logo-process');
        Route::post('/admin/logo/add-new-logo-process', 'LogoController@addLogoProcess')->name('add-new-logo-process');
        Route::post('/admin/logo/update-logo-process', 'LogoController@updateLogoProcess')->name('update-logo-process');
        Route::post('/admin/logo/sort-logo', 'LogoController@sortLogo')->name('sort-logo');
        Route::post('/admin/logo/get-filter-logo-modal', 'LogoController@getFilterLogoModal')->name('get-filter-logo-modal');
        Route::get('/admin/logo/get-all-logo-json', 'LogoController@getAllLogoJson')->name('get-all-logo-json');
//        Logo Part Ended

//        EPP Part Started

        Route::get('/admin/epp/domain', 'EPPControler@domain')->name('epp-domain');
        Route::post('/admin/epp/domain', 'EPPControler@domain')->name('epp-domain-process');
        Route::get('/admin/epp/authcode', 'EPPControler@authcode')->name('epp-authcode');
        Route::post('/admin/epp/update-auth-code', 'EPPControler@updateAuthCode')->name('update-auth-code');
        Route::post('/admin/epp/generate-random-code', 'EPPControler@generateRandomCode')->name('generate-random-code');
        Route::get('/admin/epp/register', 'EPPControler@register')->name('epp-register');
        Route::post('/admin/epp/register-domain', 'EPPControler@registerDomain')->name('register-domain');
        Route::get('/admin/epp/transfer', 'EPPControler@transfer')->name('epp-transfer');
        Route::post('/admin/epp/transfer-domain', 'EPPControler@transferDomain')->name('transfer-domain');
        Route::get('/admin/epp/delete', 'EPPControler@delete')->name('epp-delete');
        Route::post('/admin/epp/delete-confirm', 'EPPControler@deleteConfirm')->name('delete-confirm');
        Route::post('/admin/epp/delete-confirm-process', 'EPPControler@deleteConfirmProcess')->name('delete-confirm-process');
        Route::get('/admin/epp/undelete', 'EPPControler@undelete')->name('epp-undelete');
        Route::post('/admin/epp/undelete-confirm', 'EPPControler@undeleteConfirm')->name('undelete-confirm');
        Route::post('/admin/epp/undelete-confirm-process', 'EPPControler@undeleteConfirmProcess')->name('undelete-confirm-process');
        Route::get('/admin/epp/messages', 'EPPControler@messages')->name('epp-messages');
        Route::post('/admin/epp/poll-ack', 'EPPControler@pollAck')->name('poll-ack');

//        EPP Part Ended

    });

});

Auth::routes();

Route::get('/admin', function () {
    return redirect(\route('login'));
});
