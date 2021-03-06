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

Route::get('/welcome', function () {
    return view('welcome');
});

// General Routes
Route::get('/', 'PagesController@landingPage')->name('landingPage');
Route::get('error', 'PagesController@errorPage')->name('errorPage');

Route::get('events', 'PagesController@eventsPage')->name('eventsPage');
Route::get('eventsFiltered', 'PagesController@eventsFilteredPage')->name('eventsFilteredPage');
Route::get('eventDetail/{eventId}', 'PagesController@eventDetailPage')->name('eventDetailPage');
Route::get('companies', 'PagesController@companiesPage')->name('companiesPage');
Route::get('companyDetail/{companyId}', 'PagesController@companyDetailPage')->name('companyDetailPage');

Route::group(['middleware' => ['auth']], function(){
    Route::get('profile', 'PagesController@profilePage')->name('profilePage');
    Route::get('transactions', 'PagesController@transactionsPage')->name('transactionsPage');
    Route::get('lpj/{lpjName}', 'EventsController@downloadLpj')->name('downloadLpj');
    Route::get('proposal/{proposalName}', 'EventsController@downloadProposal')->name('downloadProposal');
    Route::get('sponsorshipRequests', 'PagesController@sponsorshipRequestsPage')->name('sponsorshipRequestsPage');
    Route::get('acceptSponsorshipRequest/{event_userId}', 'EventsController@acceptSponsorshipRequest')->name('acceptSponsorshipRequest');
    Route::get('rejectSponsorshipRequest/{event_userId}', 'EventsController@rejectSponsorshipRequest')->name('rejectSponsorshipRequest');
});

// Student role only Routes
Route::group(['middleware' => ['verifyStudent']], function(){
    Route::get('createEvent', 'PagesController@createEventPage')->name('createEventPage');
    Route::post('createEvent', 'EventsController@create')->name('createEvent');
    Route::post('lpj', 'EventsController@uploadLpj')->name('uploadLpj');
    Route::post('studentRequestsSponsorship', 'EventsController@studentRequestsSponsorship')->name('studentRequestsSponsorship');
});

Route::group(['middleware' => ['verifyCompany']], function(){
    Route::get('createGrant', 'PagesController@createGrantPage')->name('createGrantPage');
    Route::post('createGrant', 'GrantsController@create')->name('createGrant');
    Route::get('companyRequestsSponsorship/{eventId}', 'EventsController@companyRequestsSponsorship')->name('companyRequestsSponsorship');
    Route::get('changeStatus/{companyId}', 'CompaniesController@changeStatus')->name('changeStatus');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('loginPage');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register/company', 'Auth\RegisterController@showCompanyRegistrationForm')->name('registerCompanyPage');
Route::get('register', 'Auth\RegisterController@showStudentRegistrationForm')->name('registerStudentPage');
Route::post('registerStudent', 'Auth\RegisterController@registerStudentIndividual')->name('registerStudentIndividual');
Route::post('registerStudentOrganization', 'Auth\RegisterController@registerStudentOrganization')->name('registerStudentOrganization');
Route::post('registerCompany', 'Auth\RegisterController@registerCompany')->name('registerCompany');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
