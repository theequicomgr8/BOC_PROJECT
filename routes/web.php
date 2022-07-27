<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoleRightMediaController;
use App\Http\Controllers\ClientSubmissionController;
use App\Http\Controllers\FmStationController;
use App\Http\Controllers\RegionalNationalController;
use App\Http\Controllers\CommunityRadioController;
use App\Http\Controllers\billing\AV_RadioMediabilling\RadioController;
use App\Http\Controllers\AudioVideoController;
use App\Http\Controllers\ArogiController;
use App\Http\Controllers\PersonalMediaController;
use App\http\Controllers\PrivateMediaController;
use App\http\Controllers\dailycompliance\DailyComplianceController;
use App\http\Controllers\billing\BillingController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\DigitalCinemaController;
use App\Http\Controllers\InternetWebsiteController;
use App\http\Controllers\ClientRequest\mediaPlanControllers\outdoorMediaPlanController;
use App\http\Controllers\ClientRequest\mediaPlanControllers\tvMediaPlanController;
use App\http\Controllers\RO\ROController;
use App\http\Controllers\dailycompliance\ODMediaCompliance\ODMediaComplianceController;
use App\http\Controllers\billing\ODMediaBilling\ODMediaBillingController;
use App\Http\Controllers\FreshEmpanelmentController;
use App\Http\Controllers\TvComplianceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\wallPrintingController;
use App\Http\Controllers\TechnicalHoardingController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BulkSmsController;
use App\Http\Controllers\GenralController;
use App\http\Controllers\clientRequest\mediaPlanControllers\RadioMediaPlanController;
use App\Http\Controllers\GenralMainController;
use App\Http\Controllers\AVROController;
use App\Http\Controllers\PrintVendorGroup;
//use Illuminate\Support\Facades\DB;
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

// Route::get('/', function () {
//     return view('auth.login');
// });
//login routes
//Route::group(['middleware'=>'bocuser'],function(){
//Auth::routes();
// Route::get('login/{user_type?}', [App\http\controllers\auth\BocUserController::class, 'showLoginForm'])->name('login');
// Route::post('login/{user_type?}', [App\http\controllers\auth\BocUserController::class, 'login'])->name('login')->where('user_type', '[0-1]+');
//});
//end login
// Route::get('dashboard', function () {
//     return view('admin.pages.dashboard');
// });

Route::get('dashboard',[FreshEmpanelmentController::class,'dashboard']);
Route::get('dashboard/{np_code}',[FreshEmpanelmentController::class,'dashboardGroupLogin']);
//Akansha
Route::get('ro-list',[App\Http\Controllers\AVROController::class,'avRoList'])->name('ro-list');
Route::resources(['AVRO' => AVROController::class]);
Route::get('bills/{status}',[FreshEmpanelmentController::class,'billsReportStatus'])->name('bills');
Route::get('check-user',[App\http\controllers\GenralMainController::class,'checkuser'])->name('check-user');
Route::post('check-user',[App\http\controllers\GenralMainController::class,'checkuserexist']);
Route::get('update-password',[App\http\controllers\GenralMainController::class,'UpdatePassword'])->name('set-password');
Route::post('update-password',[App\http\controllers\GenralMainController::class,'updateExistPassword']);

// Priyanshi
Route::get('avPDF/{avType}', [App\Http\Controllers\AVROController::class,'AvRoPDF'])->name('avPDF');
//
Route::match(['get','post'],'map-details/{od_vendor_id}',[MapController::class,'map_details'])->name('map-details');
Route::match(['get','post'],'map-location-details/{od_vendor_id}',[MapController::class,'map_location_details'])->name('map-location-details');
//wall-painting route start
Route::match(['get','post'],'wall-painting',[wallPrintingController::class,'companyDetails'])->name('wall-painting');
Route::get('wallPainting',[wallPrintingController::class,'wallPrintinglist'])->name('wallPainting');
Route::get('wallPainting-view/{id}',[wallPrintingController::class,'wallPrinting_view'])->name('wallPainting-view');
Route::get('wallPainting-export-pdf/{id}', [wallPrintingController::class,'downloadPdf'])->name('wallPainting-export-pdf');
Route::get('edit_Wall_painting/{id}', [wallPrintingController::class,'editWallpainting'])->name('editWallpainting');
//wall-painting route end
// Technical Bid Hoarding route start
Route::match(['get','post'],'TechnicalHoarding',[TechnicalHoardingController::class,'TechnicalHoarding'])->name('TechnicalHoarding');
Route::get('bidHoarding',[TechnicalHoardingController::class,'bidHoardinglist'])->name('bidHoarding');
Route::match(['get','post'],'bidHoarding-edit/{id}',[TechnicalHoardingController::class,'bidHoarding_edit'])->name('bidHoarding-edit');
Route::get('bidHoarding-view/{id}',[TechnicalHoardingController::class,'bidHoarding_view'])->name('bidHoarding-view');
Route::get('bidHoarding-export-pdf/{id}', [TechnicalHoardingController::class,'biddownloadPdf'])->name('bidHoarding-export-pdf');
// Technical Bid Hoarding route end
//Route::group(['middleware' => 'auth'], function () {
Route::get('client-request', [App\Http\Controllers\ClientRequestController::class, 'clientRequest'])->name('client-request');
Route::post('ministry-code', [App\Http\Controllers\ClientRequestController::class, 'ministryCode'])->name('ministry-code');
Route::post('ministry-head', [App\Http\Controllers\ClientRequestController::class, 'ministryHead'])->name('ministry-head');
Route::post('client-request-save', [App\Http\Controllers\ClientRequestController::class, 'clientRequestSave'])->name('client-request-save');
Route::post('state-cities', [App\Http\Controllers\ClientRequestController::class, 'stateCities'])->name('state-cities');
//});
/* Start Personal media by priyanshi */
/*Route::get('rate-settlement-personal-media', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::post('personalcheckuniqueowner',[PersonalMediaController::class, 'checkUniqueOwner'])->name('personalcheckuniqueowner');
Route::post("savePersonalMedia", [PersonalMediaController::class,'savePersonalMedia'])->name('savePersonalMedia');
Route::get("viewPersonal/{mediaid}", [PersonalMediaController::class,'viewPersonal'])->name('viewPersonal');
Route::post("fetchpersonalownerrecord", [PersonalMediaController::class,'fetchOwnerRecord'])->name('fetchpersonalownerrecord');
Route::post('personalcheckuniquevendor',[PersonalMediaController::class, 'checkUniqueVendor'])->name('personalcheckuniquevendor');

Route::get('vendor-renewal-outdoor-personal',[PersonalMediaController::class, 'renewalForm']);*/
// Route::get('rate-settlement-personal-media', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::get('personalcheckuniqueowner',[PersonalMediaController::class, 'checkUniqueOwner'])->name('personalcheckuniqueowner');
Route::post("savePersonalMedia", [PersonalMediaController::class,'savePersonalMedia'])->name('savePersonalMedia');
Route::get("viewPersonal/{mediaid}", [PersonalMediaController::class,'viewPersonal'])->name('viewPersonal');
Route::get("fetchpersonalownerrecord", [PersonalMediaController::class,'fetchOwnerRecord'])->name('fetchpersonalownerrecord');
Route::get('personalcheckuniquevendor',[PersonalMediaController::class, 'checkUniqueVendor'])->name('personalcheckuniquevendor');
Route::get('getMediaSubCategory',[PersonalMediaController::class, 'getMediaSubCategory']);
// Route::get('personal-renewal', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewal']);
// Route::post('personal-renewal', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewalView']);
// Route::post('personal-renewal-save', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewalSave'])->name('personal-renewal-save');
Route::get('remove-workdone-data', [App\Http\Controllers\PersonalMediaController::class, 'removeWorkdoneData']);
Route::get("get-agencyName-fromgst", [PersonalMediaController::class, 'getAgencyNameFromgst']);
Route::post("perfetchmedia", [PersonalMediaController::class, 'fetchmedia'])->name('perfetchmedia');
//add 11 march
Route::get('rate-settlement-personal-media/{id?}', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::get('personal-list', [PersonalMediaController::class,'personallist'])->name('personallist');
Route::get('personal-show-subcategory', [PersonalMediaController::class,'show_subcategory'])->name('personal-show-subcategory');
Route::get('persolan-existing-form',[PersonalMediaController::class,'existinguser'])->name('personal_existinguser'); //for exting user form 22-Feb
Route::post('personal-existing-user-data',[PersonalMediaController::class,'existingUserSaved'])->name('personal_existingUserSaved'); //for exting user form
Route::get('personal-find-sub-category', [PersonalMediaController::class,'findSubCategory'])->name('personalfindSubCategory');
Route::get('personal-renewal/{id?}', [PersonalMediaController::class,'personal_right_renewal_form'])->name('personal-renewal');
Route::post('personal-renewal-form-submit', [PersonalMediaController::class,'personal_renewal_form_submit'])->name('personal-renewal-submit');

Route::get('remove-media-data', [App\Http\Controllers\PersonalMediaController::class, 'removeMediaData']);

//for personal agreement
Route::get('personal-fileupload/{id?}', [AgreementController::class, 'personalUpload'])->name('personal.upload');
Route::post('personal-fileupload', [AgreementController::class, 'personal_file_upload'])->name('personal.upload.post');
Route::get('personalfile-download', [AgreementController::class, 'personal_download_file'])->name('personalfile.download');
/* End Personal media sk */
// start outdoor media routes
Route::get("fetchStates", [SoleRightMediaController::class, 'fetchStates'])->name('fetchStates');
Route::post("fetchDistricts", [SoleRightMediaController::class, 'fetchDistricts'])->name('fetchDistricts');
/*Unique Email and mobile Route*/
Route::post('solerightcheckuniquevendor', [SoleRightMediaController::class, 'checkUniqueVendor'])->name('solerightcheckuniquevendor');
Route::post('checkpsolerightuniqueowner', [SoleRightMediaController::class, 'checkUniqueOwner'])->name('checkpsolerightuniqueowner');
Route::get("viewSoleRightMedia/{mediaid}", [SoleRightMediaController::class, 'viewSoleRightMedia'])->name('viewSoleRightMedia');
Route::post("fetchsolerightownerrecord", [SoleRightMediaController::class, 'fetchOwnerRecord'])->name('fetchsolerightownerrecord');
Route::get('account-details', [SoleRightMediaController::class, 'accountDetail'])->name('account-details');
Route::post('update_account_detail', [SoleRightMediaController::class, 'updateAccountDetail'])->name('update_account_detail');
Route::get('company-details', [SoleRightMediaController::class, 'companyDetail'])->name('company-details');
Route::post('company-detail-save', [SoleRightMediaController::class, 'companyDetailSave'])->name('company-detail-save');
Route::get('outdoor-media-empanelment', [SoleRightMediaController::class, 'outdoorMediaEmpanelment'])->name('outdoor-media-empanelment');
Route::post('outdoor-media-empanelment-save', [SoleRightMediaController::class, 'outdoorMediaEmpSave'])->name('outdoor-media-empanelment-save');
Route::match(['get', 'post'], 'outdoor-media-list', [SoleRightMediaController::class, 'outdoorMediaList'])->name('outdoor-media-list');
Route::get('outdoor-media-view/{od_media_id}', [SoleRightMediaController::class, 'outdoorMediaView'])->name('outdoor-media-view');
Route::get('outdoor-media-renewal/{id?}', [SoleRightMediaController::class, 'outdoorMediaRenewal'])->name('outdoor-media-renewal');
Route::post('outdoor-media-renewal-save', [SoleRightMediaController::class, 'outdoorMediaRenewalSave'])->name('outdoor-media-renewal-save');
Route::post('remove-branchoffice-data', [SoleRightMediaController::class, 'removeBranchOfficeData']);
Route::post('remove-authorized-data', [SoleRightMediaController::class, 'removeAuthorizedData']);
Route::post('remove-mediaaddress-data', [SoleRightMediaController::class, 'removeMediaaddressData'])->name('remove-mediaaddress-data');
Route::get('MediaWorkDone_delete', [SoleRightMediaController::class, 'MediaWorkDone_delete']);
Route::post("get-sub-category", [SoleRightMediaController::class, 'getSubCategory'])->name('get-sub-category');
Route::post("get-subcategory-excel", [SoleRightMediaController::class, 'getSubCategoryExcel'])->name('get-subcategory-excel');
Route::post("get-media-excel", [SoleRightMediaController::class, 'getMediaExcel'])->name('get-media-excel');
Route::get('find-sub-category', [SoleRightMediaController::class, 'findSubCategory'])->name('findSubCategory');
Route::get('show-subcategory', [SoleRightMediaController::class, 'show_subcategory'])->name('show-subcategory');
Route::get('autocompletetrain', [SoleRightMediaController::class, 'autocompletetrain'])->name('autocompletetrain');
Route::get("checkgstsole", [SoleRightMediaController::class, 'checkgst']);
Route::get('solerightPDF/{id}', [SoleRightMediaController::class, 'solerightPDF'])->name('solerightPDF');
Route::get('outdoorsoleRightPdf', [SoleRightMediaController::class, 'outdoorsoleRightPdf'])->name('outdoorsoleRightPdf');
Route::get('approved-list', [SoleRightMediaController::class, 'approvedList'])->name('approved-list');
Route::post('get-location-details', [SoleRightMediaController::class, 'getLocationDetails'])->name('get-location-details');
Route::post('save-location-data', [SoleRightMediaController::class, 'saveLocationData'])->name('save-location-data');
Route::post('view-location-data', [SoleRightMediaController::class, 'viewLocationData'])->name('view-location-data');
Route::get('remove-location-data', [SoleRightMediaController::class, 'removeLocationData'])->name('remove-location-data');
Route::post('get-location-tempdata', [SoleRightMediaController::class, 'getLocationTempData'])->name('get-location-tempdata');
// end outdoor media routes

//Soleright aggrement file
Route::get('soleright-fileupload/{id?}', [AgreementController::class, 'solerightUpload'])->name('soleright.upload');
Route::post('soleright-fileupload', [AgreementController::class, 'soleright_file_upload'])->name('solefile.upload.post');
Route::get('solefile-download', [AgreementController::class, 'soleright_download_file'])->name('solefile.download');

Route::get('solerenewal-agreement-upload', [AgreementController::class, 'solerenewalAgreement'])->name('solerenewal-agreement-upload');
Route::get('solerenewalAgreement', [AgreementController::class, 'solerenewalAgreement'])->name('solerenewal-agreement-upload');
Route::post('solerenewalAgreementupload', [AgreementController::class, 'solerenewalAgreementupload'])->name('solerenewalAgreementupload');
Route::get('sole-renewalfile-download', [AgreementController::class, 'soleright_renewal_download_file'])->name('solerenewalfile.download');

//private agreement file
Route::get('private-fileupload', [AgreementController::class, 'privateUpload'])->name('private.upload');
Route::post('private-fileupload', [AgreementController::class, 'private_file_upload'])->name('private.upload.post');
Route::get('private-download', [AgreementController::class, 'private_download_file'])->name('private.download');

Route::get('privaterenewalAgreement', [AgreementController::class, 'privaterenewalAgreement'])->name('privaterenewal-agreement-upload');
Route::post('privaterenewalAgreementupload', [AgreementController::class, 'privaterenewalAgreementupload'])->name('privaterenewalAgreementupload');
Route::get('private-renewalfile-download', [AgreementController::class, 'private_renewal_download_file'])->name('privaterenewalfile.download');
//personal agreement file
// Route::get('personal-fileupload', [AgreementController::class, 'personalUpload'])->name('personal.upload');
// Route::post('personal-fileupload', [AgreementController::class, 'personal_file_upload'])->name('personal.upload.post');
Route::get('personal-download', [AgreementController::class, 'personal_download_file'])->name('personal.download');

Route::get('personalrenewalAgreement', [AgreementController::class, 'personalrenewalAgreement'])->name('personalrenewal-agreement-upload');
Route::post('personalrenewalAgreementupload', [AgreementController::class, 'personalrenewalAgreementupload'])->name('personalrenewalAgreementupload');
Route::get('personal-renewalfile-download', [AgreementController::class, 'personal_renewal_download_file'])->name('personalrenewalfile.download');
Route::get('personalmediaPDF/{id}', [PersonalMediaController::class,'personalmediaPDF'])->name('personalmediaPDF');
Route::get('outdoorpersonalmediaPdf', [PersonalMediaController::class,'outdoorpersonalmediaPdf'])->name('outdoorpersonalmediaPdf');
/* AV Agreement file Upload and download created by priyanshi */
Route::get('av-producer-fileupload', [AgreementController::class, 'avProducerfileUpload'])->name('av-producer-fileupload');
Route::post('av-producer-fileupload', [AgreementController::class, 'avProducer_file_upload'])->name('av-producer-fileupload');
Route::get('av-producer-file-download', [AgreementController::class, 'avProducer_download_file'])->name('av-producer-file.download');
/* Community Radio Station Agreement file Upload and download created by priyanshi */
Route::get('commu-radio-fileupload', [AgreementController::class, 'commuRadiofileUpload'])->name('commu-radio-fileupload');
Route::post('commu-radio-fileupload', [AgreementController::class, 'commuRadio_file_upload'])->name('commu-radio-fileupload');
Route::get('commu-radio-file-download', [AgreementController::class, 'commuRadio_download_file'])->name('commu-radio-file.download');

//AVTV aggrement file
Route::get('avtv-fileupload', [AgreementController::class, 'avtvUpload'])->name('avtv-fileupload');
Route::post('avtv-fileupload', [AgreementController::class, 'avtv_file_upload'])->name('avtv-fileupload');
Route::get('avtv-download', [AgreementController::class, 'avtv_download_file'])->name('avtv-download');
//PVT FM Station aggrement file
Route::get('fm-fileupload', [AgreementController::class, 'FMUpload'])->name('fm-fileupload');
Route::post('fm-fileupload', [AgreementController::class, 'FM_file_upload'])->name('fm-fileupload');
Route::get('fm-download', [AgreementController::class, 'FM_download_file'])->name('fm-download');

/*Start private outdoor route start */
Route::post('fetchprivateownerrecord', [PrivateMediaController::class, 'fetchOwnerRecord'])->name('fetchprivateownerrecord');
Route::post('checkprivateuniqueowner', [PrivateMediaController::class, 'checkUniqueOwner'])->name('checkprivateuniqueowner');
Route::post('checkuniqueprivatevendor',[PrivateMediaController::class, 'checkUniqueVendor'])->name('checkuniqueprivatevendor');
Route::post('get-all-privatevendorlist', [PrivateMediaController::class, 'getAllPrivateVendorList'])->name('get-all-privatevendorlist');
Route::post("updatePrivateMedia/{odmedia_id}", [PrivateMediaController::class, 'updatePrivateMedia'])->name('updatePrivateMedia');
/*end renewal*/
Route::get('rate-settlement-private-media', [PrivateMediaController::class, 'Privatemedia'])->name('rate-settlement-private-media');
Route::post('private_media', [PrivateMediaController::class, 'private_media'])->name('private_media');
Route::get('ownerData2', [PrivateMediaController::class,'ownerData2'])
->name('ownerData2');
Route::get('private-renewal', [PrivateMediaController::class, 'privateRenewal']);
Route::post('private-renewal', [PrivateMediaController::class, 'privateRenewalView']);
Route::post('privateownerRenewal',[PrivateMediaController::class, 'ownerRenewal']);
Route::post('privateRenewall',[PrivateMediaController::class, 'privateRenewall']);
Route::get("checkgstprivate", [PrivateMediaController::class, 'getAgencyNameFromgst']);
/*End private outdoor route start */
//Strat FM Station
Route::get('fm-radio-station',[FmStationController::class,'StateDropdown'])->name('fm-radio-station');
Route::get('FmfetchDistricts',[FmStationController::class,'FMfetchDistricts'])->name('FmfetchDistricts');
Route::get('get-city',[FmStationController::class,'FMgetCITY'])->name('get-city');
Route::post('fmStation',[FmStationController::class,'fmStation'])->name('fmStation');
Route::get('findfm',[FmStationController::class,'findfm'])->name('findfm');
Route::get('checkgst',[FmStationController::class,'checkgst'])->name('checkgst');
Route::post('SaveVend',[FmStationController::class,'VendDetailsSave'])->name('SaveVend');
Route::post('SaveAccout',[FmStationController::class,'AccountDetailsSave'])->name('SaveAccout');
Route::post('SaveDOC',[FmStationController::class,'DocumentSave'])->name('SaveDOC');
Route::get('getIFSC',[FmStationController::class,'getifsc'])->name('getIFSC');
Route::get('avFMpdf/{id}',[FmStationController::class,'avPDF'])->name('avFMpdf');
Route::match(['get','post'],'channelAPI',[FmStationController::class,'channelAPI'])->name('channelAPI');
//End FM Station

/*Regional National Route*/
Route::get('regional-national/{id}',[RegionalNationalController::class,'getregional'])->name('regional-national');
Route::get('getDistrict-national',[RegionalNationalController::class,'fetchDistricts'])->name('getDistrict-national');
Route::post('SaveOwnerData',[RegionalNationalController::class,'Savedata'])->name('SaveOwnerData');
Route::get('FetchRNemail',[RegionalNationalController::class,'FetchRNemail'])->name('FetchRNemail');
Route::post('saveregional',[RegionalNationalController::class,'saveregional'])->name('saveregional');
Route::any('form-type',[RegionalNationalController::class,'reginalradio'])->name('form-type');
Route::get('avtvPDF/{id}',[RegionalNationalController::class, 'avtvPDF'])->name('avtvPDF');
Route::get('avtv-get-city',[RegionalNationalController::class,'avtvgetCITY'])->name('avtv-get-city');
/*End Regional National Route*/
/* Start Community Radio Station*/
Route::get('community-radio-station', [CommunityRadioController::class, 'InsertRadioForm'])->name('InsertRadioForm');
Route::get('getDistrictcomm1', [CommunityRadioController::class, 'fetchDistricts'])->name('getDistrictcomm1');
Route::post("saveCommRadio", [CommunityRadioController::class,'saveRadio'])->name('saveCommRadio');
Route::get('getIFSC', [CommunityRadioController::class,'getifsc'])->name('getifsc');
Route::post('findcr',[App\Http\Controllers\CommunityRadioController::class,'findcr'])->name('findcr');
Route::post('get-all-CommRadio',[CommunityRadioControlle::class, 'getAllCommRadio'])->name('get-all-CommRadio');
Route::get('community-pdf/{id}', [CommunityRadioController::class, 'commuPDF']);
/* End Community Radio Station*/

/*Start For AV Radio*/
Route::get('radio-billing/',[RadioController::class,'index'])->name('radiobilling.index');
Route::match(['post','get'],'radiobilling/create/{id?}',[RadioController::class,'create'])->name('radiobilling.create');
Route::post('savebilling',[RadioController::class,'storebilling'])->name('savebilling');
Route::post('finalsavebilling',[RadioController::class,'finalstorebilling'])->name('finalsavebilling');
Route::post('avBillingDelete',[RadioController::class,'avBillingDelete'])->name('avBillingDelete');


/*End For AV Radio*/
//for audio video producers start
Route::get('audio', [AudioVideoController::class, 'index'])->name('audio');
Route::post('first_insert',[AudioVideoController::class,'first_tab_insert'])->name('first_insert');
Route::post('final_submit',[AudioVideoController::class,'final_submit'])->name('final_submit');
Route::get('av-pdf/{av_code}', [AudioVideoController::class, 'avproducerPDF']);
//end audio video producers



Route::get('vendor-notifi-empanelment', [App\Http\Controllers\AdvisioryController::class, 'vennotiemp'])->name('vendor-notifi-empanelment');
Route::get('client-submission-for-advertisement', [App\Http\Controllers\ClientSubAdvertisementController::class, 'ClientSubAdvertisement'])->name('client-submission-for-advertisement');


Route::get('vendor-notifi-empanelment', [App\Http\Controllers\AdvisioryController::class, 'vennotiemp'])->name('vendor-notifi-empanelment');
Route::get('client-submission-for-advertisement', [App\Http\Controllers\ClientSubAdvertisementController::class, 'ClientSubAdvertisement'])->name('client-submission-for-advertisement');

// Route::post('/login', [App\Http\Controllers\auth\LoginController::class, 'login'])->name('login');
//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



   //@rishi

        //Start Client Request Route
            Route::get('client-submission-form/{CLHID?}', [ClientSubmissionController::class, 'getClientForm'])->name('client-submission-form');
            Route::get('clientview/{CLHID?}', [ClientSubmissionController::class, 'clientview'])->name('client.view');

            Route::get('previousLogs', [ClientSubmissionController::class, 'previousLogs'])->name('previousLogs');

            Route::post('client-submission-form', [ClientSubmissionController::class, 'clientSave'])->name('client-submission-form');
            Route::get('client-submission-list', [ClientSubmissionController::class, 'index'])->name('client-submission-list');
            //pending creative list
            Route::get('client-pending-creative-list', [ClientSubmissionController::class, 'clientPendingCreativeList'])->name('client.clientPendingCreativeList');

             Route::get('upload-pending-creative', [ClientSubmissionController::class, 'uploadpendingcreative'])->name('client.uploadpendingcreativeform');

             Route::post('update-pending-creative', [ClientSubmissionController::class, 'updatependingcreative'])->name('client.updatependingcreative');


            Route::get('get-district/{state_code?}', [ClientSubmissionController::class, 'getCity'])->name('get-district');
            Route::post('get-email', [ClientSubmissionController::class, 'getEmail'])->name('get-email');

            Route::get('getCityStateBased/{state_code?}', [ClientSubmissionController::class, 'getCityStateBased'])->name('getCityStateBased');
            Route::get('getFMCityStateBased/{state_code?}', [ClientSubmissionController::class, 'getFMCityStateBased'])->name('getFMCityStateBased');
        //End Client Request Route
        //start media plan route
            Route::get('media-plan',[ClientSubmissionController::class, 'mediaPlanList'])->name('media-plan');
        Route::get('media-plan-view/{mpNo}/{planVersion}',[ClientSubmissionController::class, 'mediaPlanView'])->name('media-plan-view');
            // Route::get('media-plan-view/{mpNo}',[ClientSubmissionController::class, 'mediaPlanView'])->name('media-plan-view');

            Route::post('save-comment-mediaplan',[ClientSubmissionController::class, 'saveCommentOfmp'])->name('save-comment-mediaplan');
        //end Media plan route
        //RO Releted Rute
            Route::get('release-order-list',[ClientSubmissionController::class, 'roList'])->name('release-order-list');
            Route::get('RO-View/{npcode}/{lineno}/{planid}/{clientid}',[ClientSubmissionController::class, 'viewRO'])->name('RO-View');
            Route::get('roPrintPDF/{npcode}', [ClientSubmissionController::class,'roPrintPDF']);

        //end RO Releted Rute
        /*forgot password */
            Route::get('reset-password', [App\Http\Controllers\auth\BocUserController::class, 'showResetForm'])->name('resetForm');
            Route::post('forgot-password',[App\http\controllers\auth\BocUserController::class,'forgotpassword']);
            Route::post('submitotp',[App\http\controllers\auth\BocUserController::class,'submitotp']);
            Route::post('updatepassword',[App\http\controllers\auth\BocUserController::class,'resetPassword']);

        //end forgot password
         /*start daily compliance route*/
            Route::get('dailycompliance/nplist/{npcode}', [DailyComplianceController::class,'getnpDetail'])->name('dailycompliance.nplist');
            Route::get('dailycompliance/rolist/{rocode}', [DailyComplianceController::class,'getrodetail'])->name('dailycompliance.rolist');
            Route::get('dailycompliance/getrodata', [DailyComplianceController::class,'getrodata'])->name('dailycompliance.getrodata');

            //Route::get('dailycompliance/submitted-bill', [DailyComplianceController::class,'submittedBill'])->name('dailycompliance.submittedBill');
            Route::resources([
                'dailycompliance' => DailyComplianceController::class,
            ]);

            Route::get('tvcompliancePdf/{complianceType}', [TvComplianceController::class,'tvcompliancePdf'])->name('tvcompliancePdf');

             Route::get('dailyCompliancePrintPDF/{npcode}', [DailyComplianceController::class,'dailyCompliancePrintPDF']);
             Route::get('billingPrintPDF/{npcode}', [BillingController::class,'billingPrintPDF']);
             Route::get('billing/billing_view', [BillingController::class,'billingView'])->name('billing.billing_view');
            Route::get('billing/billingPDF', [BillingController::class,'billingPDF'])->name('billing.billingPDF');

            Route::resources([
                'billing' => BillingController::class,
            ]);


             Route::get('ODMediaCompliance/getSelectedAgencyDetail/{agencycode}', [ODMediaComplianceController::class,'getSelectedAgencyDetail'])->name('ODMediaCompliance.getSelectedAgencyDetail');
            Route::get('ODMediaCompliance/rolist/{rocode}', [ODMediaComplianceController::class,'getrodetail'])->name('ODMediaCompliance.rolist');

            Route::resources([
                'ODMediaPlan' => outdoorMediaPlanController::class,
            ]);

            Route::get('pdfGenerateOD/{id}',[outdoorMediaPlanController::class,'pdfGenerateOD'])->name('pdfGenerateOD');
            Route::get('radio-pdf/{id}',[RadioMediaPlanController::class,'showradioPDF'])->name('radio-pdf');
            //for tv
            Route::resources([
                'tvMediaPlan' => tvMediaPlanController::class,
            ]);
            Route::get('tvMediaPlanpdf/{mpNo}', [tvMediaPlanController::class,'tvMediaPlanpdf'])->name('tvMediaPlanpdf');

            Route::resources([
                'ODMediaRO' => ROController::class,
            ]);
            Route::resources([
                'ODMediaCompliance' =>ODMediaComplianceController::class,
            ]);
            Route::resources([
                'ODMediaBilling' =>ODMediaBillingController::class,
            ]);
        /*END daily compliance route*/
         //start billing route
            Route::resources([
                'billing' => BillingController::class,
            ]);
             Route::get('billing/create/{npcode?}', [BillingController::class,'create'])->name('billing.create');

             Route::get('billing/submitted-billtoken-length/{bill_token_date?}', [BillingController::class,'submittedBilltokenLength'])->name('billing.submitted_billtoken_length');

            // Route::get('dailycompliance/rolist/{rocode}', [BillSubmissionController::class,'getrodetail'])->name('dailycompliance.rolist');

        //end bulling route
             //for AV Radio plan
                Route::resources([
                'radioMediaPlan' => RadioMediaPlanController::class,
                ]);

        //All mail send to client

             Route::get('mailSendToClient/{emailparam?}',[ClientSubmissionController::class, 'mailSendToClient'])->name('mailSendToClient');

             //En mail
             Route::get('callbackrequest',[ClientSubmissionController::class, 'getClientcallbackForm'])->name('client.callbackrequest');
            Route::post('MailForCallBack',[ClientSubmissionController::class, 'MailForCallBack'])->name('client.MailForCallBack');
            Route::get('fundstatus',[ClientSubmissionController::class, 'fundstatusList'])->name('client.fundstatus');

            Route::get('clientRequestPDF/{id}', [App\Http\Controllers\ClientSubmissionController::class, 'clientRequestPDF'])->name('clientRequestPDF');
            Route::get('GeneratePDFclientReq/{id}', [App\Http\Controllers\ClientSubmissionController::class, 'GeneratePDFclientReq'])->name('GeneratePDFclientReq');

             Route::get('media-plan-viewPDF/{mpNo}/{planVersion}',[ClientSubmissionController::class, 'mediaPlanViewPDF'])->name('media-plan-viewPDF');

             Route::get('train-list',[ClientSubmissionController::class, 'trainList'])->name('client.train-list');
        //@Rishi
             /*Start Pooja*/
             Route::get('print-status/{id?}', [App\Http\Controllers\ClientSubmissionController::class, 'print_status'])->name('print-status');
            Route::get('print-expd/{id?}', [App\Http\Controllers\ClientSubmissionController::class, 'print_expd'])->name('print-expd');
            Route::get('print-cmt/{id?}', [App\Http\Controllers\ClientSubmissionController::class, 'print_cmt'])->name('print-cmt');
             Route::get('release-order-details/{rocode}', [App\Http\Controllers\ClientSubmissionController::class, 'release_order_details'])->name('release-order-details');
            Route::get('bills-cleared-details/{rocode}', [App\Http\Controllers\ClientSubmissionController::class, 'bills_cleared_details'])->name('bills-cleared-details');
            Route::get('bills-pending-details/{rocode}', [App\Http\Controllers\ClientSubmissionController::class, 'bills_pending_details'])->name('bills-pending-details');
             /*End Pooja*/


Route::get('sole-basic-detail',[App\Http\Controllers\SoleRightMediaController::class,'sole_basic_data'])->name('sole-basic-detail');
Route::post('sole-basic-detail-update',[App\Http\Controllers\SoleRightMediaController::class,'sole_basic_detail_update'])->name('sole-basic-detail-update');
Route::get('errorshow/{id?}',[SoleRightMediaController::class,'errorshow'])->name('errorshow');

//for rob 2022
Route::get('/rob-form-one/{id?}',[ArogiController::class,'index'])->name('rob-form-one');
Route::get('rob-fob-list',[ArogiController::class,'rob_fob_list'])->name('rob_fob_list');
Route::get('get_status',[ArogiController::class,'get_status'])->name('get_status');
Route::get('fob-list',[ArogiController::class,'fob_list'])->name('fob_list');
Route::get('roblist',[ArogiController::class,'roblist'])->name('roblist');
Route::post('rob_insert',[ArogiController::class,'rob_insert'])->name('rob_insert'); //new rob insert
Route::post('robSubmit',[ArogiController::class,'robSubmit'])->name('robSubmit'); //new rob final submit
Route::get('hq_region',[ArogiController::class,'headquat'])->name('headquat');//new
Route::get('fo_region',[ArogiController::class,'foregion'])->name('foregion');//new
Route::get('rob-form-type',[ArogiController::class,'rob_form_type'])->name('form_type');
Route::post('rob-form-type',[ArogiController::class,'rob_form_type_submit'])->name('form_type_submit');
Route::post('pre_insert',[ArogiController::class,'pre_insert'])->name('pre_insert'); //pre rob form insert
Route::get('preroblist',[ArogiController::class,'preroblist'])->name('preroblist');
Route::get('/pre-active-form/{id?}',[ArogiController::class,'pre_active_form'])->name('pre_active_form');
Route::get('/post_form_pdf/{id?}',[ArogiController::class,'post_form_showpdf'])->name('post_form_pdf');
Route::get('prefoblist',[ArogiController::class,'prefoblist'])->name('prefoblist');
Route::get('rob-adg-list',[ArogiController::class,'rob_adg_list'])->name('adglist');
// Route::get('approve-rejected/{status}/{id}',[ArogiController::class,'approve_rejected'])->name('approve_rejected');
Route::match(['get','post'],'approve-rejected/{status}/{id}',[ArogiController::class,'approve_rejected'])->name('approve_rejected');
Route::get('contact-us',[ArogiController::class,'contact_us'])->name('contactus');
Route::post('contactsave',[ArogiController::class,'contactsave'])->name('contactsave');
Route::get('rob-banner',[ArogiController::class,'banner'])->name('banner');
Route::post('bannersave',[ArogiController::class,'bannersave'])->name('bannersave');
Route::get('bannerdelete',[ArogiController::class,'bannerdelete'])->name('bannerdelete');
Route::get('banneredit/{id?}',[ArogiController::class,'banneredit'])->name('banneredit');
Route::post('banneredit',[ArogiController::class,'bannerupdate'])->name('bannerupdate');
Route::get('/adglistview/{id?}',[ArogiController::class,'adg_pre_active_form_show'])->name('adg_pre_active_form_show');
Route::post('pre_update',[ArogiController::class,'pre_update'])->name('pre_update'); //pre adg update
Route::get('adg_hqregion',[ArogiController::class,'adgheadquat'])->name('adg-headquat');//new
Route::get('adgforegion',[ArogiController::class,'adgforegion'])->name('adgforegion');//new
Route::get('robshowfobpredata',[ArogiController::class,'fob_pre_show_rob'])->name('fob_pre_show_rob');//new
Route::get('/whats-new',[ArogiController::class,'whats_new'])->name('rob_whats_new');
Route::post('/whats-new',[ArogiController::class,'whats_new_save'])->name('rob_whats_new_save');
// Route::get('/whats-new-list',[ArogiController::class,'whats_new_list'])->name('whats_new_list');
Route::get('whats_new_delete',[ArogiController::class,'whats_new_delete'])->name('whats_new_delete');
Route::get('contactedit/{id}',[ArogiController::class,'contactedit'])->name('contactedit');
Route::post('contactedit',[ArogiController::class,'contactupdate'])->name('contactupdate');
Route::get('contactdelete',[ArogiController::class,'contactdelete'])->name('contactdelete');
Route::get('robcreate/{id}',[ArogiController::class,'robcreate'])->name('robcreate');
// Route::get('/roblistview/{id?}',[ArogiController::class,'rob_pre_active_form_show'])->name('rob_pre_active_form_show');
Route::get('/rob-approve-pre-active/{id?}',[ArogiController::class,'rob_pre_fob_active_form_show'])->name('rob_pre_fob_active_form_show');
Route::post('/rob-fob-pre-update',[ArogiController::class,'rob_pre_fob_active_form_update'])->name('rob_pre_fob_active_form_update');
// Route::get('robshowfobpredata',[ArogiController::class,'fob_pre_show_rob'])->name('fob_pre_show_rob');//new
Route::get('rob-show-fob-pre-data',[ArogiController::class,'fob_pre_show_rob'])->name('fob_pre_show_rob');//new
Route::get('fetchOfficerDetail',[ArogiController::class,'fetchOfficerDetail'])->name('fetchOfficerDetail');
Route::get('showOfficerDetail',[ArogiController::class,'showOfficerDetail'])->name('showOfficerDetail');
Route::get('findvillage',[ArogiController::class,'findvillage'])->name('findvillage');
Route::get('robSearch',[ArogiController::class,'robSearch'])->name('robSearch');
Route::get('robFobSearch',[ArogiController::class,'robFobSearch'])->name('robFobSearch');
Route::get('robFobSearchApprove',[ArogiController::class,'robFobSearchApprove'])->name('robFobSearchApprove');
Route::get('multiApprove',[ArogiController::class,'multiApprove'])->name('multiApprove'); //multi approve
// Route::get('preroblistpdf/{userid}',[ArogiController::class,'preroblistPDF'])->name('preroblistpdf');  //for  pdf
Route::get('/post-form/{id?}',[ArogiController::class,'post_form_show'])->name('post_form_show');
Route::get('/post-form-pdf/{id?}',[ArogiController::class,'post_form_showpdf'])->name('post-form-pdf');
Route::get('/pre-form-pdf/{id?}',[ArogiController::class,'pre_form_showpdf'])->name('pre-form-pdf');
Route::get('/fob-ttp-form-pdf/{id?}',[ArogiController::class,'fob_TTP_form_showpdf'])->name('fob-ttp-form-pdf');

Route::get('/approvelist',[ArogiController::class,'approvelist'])->name('post_form_show');
Route::get('/showWebsite',[ArogiController::class,'showWebsite'])->name('showWebsite');
Route::get('all-ro-list',[ArogiController::class,'all_ro_list'])->name('all_ro_list');
Route::get('all-fo-list/{id}',[ArogiController::class,'all_fo_list'])->name('all_fo_list');
Route::get('all-ro-record/{id}',[ArogiController::class,'all_ro_record'])->name('all_ro_record');
Route::get('all-fo-record/{id}',[ArogiController::class,'all_fo_record'])->name('all_fo_record');
// sk change end

//Priyanshi Route start
Route::get('preroblistpdf/{userid}',[ArogiController::class,'preroblistPDF'])->name('preroblistpdf');
Route::get('preactiveformPDF/{userid}',[ArogiController::class,'preactiveformPDF'])->name('preactiveformPDF');
Route::get('roblistPDF/{userid}',[ArogiController::class,'roblistPDF'])->name('roblistPDF');
Route::get('postActivityPdf/{userid}',[ArogiController::class, 'postActivityPdf'])->name('postActivityPdf');
//Rob pdf route end
// sk change end

//This url is used to vendor and client login


/* Rimmi Route */
//excel routes
Route::get('import-abc-view', [App\Http\Controllers\ABCController::class, 'importABCView']);
Route::post('import', [App\Http\Controllers\ABCController::class, 'import'])->name('import');
//excel routes

// SMS and Mail Api Routes
Route::get('sms_send', [App\Http\Controllers\SMSController::class, 'sms_send'])->name('sms_send');
Route::get('mail-send', [App\Http\Controllers\SMSController::class, 'mailSend'])->name('mail-send');
// End SMS Mail Api Routes

// print route
Route::get('print-basic-detail', [FreshEmpanelmentController::class, 'basic_detail'])->name('basic-detail');
Route::post('print-basic-detail', [FreshEmpanelmentController::class, 'basic_detail_save'])->name('basic-detail-save');

Route::get('check-unique-owner-company',[FreshEmpanelmentController::class,'checkUniqueOwnerCompany']);

Route::get('fresh-empanelment', [FreshEmpanelmentController::class, 'freshEmpanelment'])->name('fresh-empanelment');
Route::post('fresh-empanelment-save', [FreshEmpanelmentController::class, 'freshEmpanelmentSave'])->name('fresh-empanelment-save');
Route::post('fresh-empanelment-update', [FreshEmpanelmentController::class, 'freshEmpanelmentUpdate'])->name('fresh-empanelment-update');
Route::get('getdistrict', [FreshEmpanelmentController::class, 'getDistrict'])->name('getdistrict');
Route::get('fresh-empanelment-previous', [FreshEmpanelmentController::class, 'previousLogsave'])->name('fresh-empanelment-previous');
// Route::post('checkfile',[FreshEmpanelmentController::class, 'checkFile'])->name('checkfile');
Route::get('existownerdata', [FreshEmpanelmentController::class, 'existingOwnerData'])->name('existownerdata');
Route::get('checkuniqueowner/{emailparam}', [FreshEmpanelmentController::class, 'checkUniqueOwner'])->name('checkuniqueowner');
Route::post('fetchownerrecord', [FreshEmpanelmentController::class, 'fetchOwnerRecord'])->name('fetchownerrecord');
Route::get('checkuniquevendor/{emailparam}', [FreshEmpanelmentController::class, 'checkUniqueVendor'])->name('checkuniquevendor');
Route::get('account-detail', [FreshEmpanelmentController::class, 'accountDetail'])->name('account-detail');
Route::post('account-detail', [FreshEmpanelmentController::class, 'accountDetailSave'])->name('account-detail-save');

Route::get('get-press-owner-data', [FreshEmpanelmentController::class, 'getPressOwnerData'])->name('get-press-owner-data');
Route::get('print-renewal', [FreshEmpanelmentController::class, 'printRenewal']);
Route::get('print-renewal/{np_code}', [FreshEmpanelmentController::class, 'groupPrintRenewal']);
Route::match(['get','post'],'print-renewal', [FreshEmpanelmentController::class, 'printRenewal']);
Route::post('print-renewal-save', [FreshEmpanelmentController::class, 'printRenewalSave'])->name('print-renewal-save');
Route::get('vendor-rate-offered', [FreshEmpanelmentController::class, 'vendorRateOffered']);
Route::post('vendor-rate-status-update', [FreshEmpanelmentController::class, 'vendorRateStatusupdate'])->name('vendor-rate-status-update');
Route::get('check-regno-cir-base', [FreshEmpanelmentController::class, 'checkRegCirBase'])->name('check-regno-cir-base');
Route::get('check-gstno', [FreshEmpanelmentController::class, 'checkGstno']);
Route::get('check-isprimaryedition', [FreshEmpanelmentController::class, 'checkIsPrimaryEdition']);
Route::get('check-renewal-gstno', [FreshEmpanelmentController::class, 'checkRenewalGSTNo']);
Route::get('check-renewal-regno-cir-base', [FreshEmpanelmentController::class, 'checkRenewalRegCirBase']);
Route::get('check-regno-cir', [FreshEmpanelmentController::class, 'checkRegCirBaseNew']);
Route::get('check-renewal-unique-email-vendor', [FreshEmpanelmentController::class, 'checkUniqueEmailVendor']);
Route::get('checkgstprint', [FreshEmpanelmentController::class,'checkgstprint']);
Route::get('print-pdf/{np_code}', [FreshEmpanelmentController::class, 'printPDF']);
Route::get('print-renewal-pdf/{np_code}', [FreshEmpanelmentController::class, 'printRenewalPDF']);
Route::get('getdistrictcity', [FreshEmpanelmentController::class, 'getDistrictCity'])->name('getdistrictcity');

Route::get('print-renewal', [FreshEmpanelmentController::class, 'printRenewal']);
Route::post('print-renewal', [FreshEmpanelmentController::class, 'printRenewalView']);
Route::post('print-renewal-save', [FreshEmpanelmentController::class, 'printRenewalSave'])->name('print-renewal-save');
Route::get('print-token',[FreshEmpanelmentController::class,'printToken'])->name('printToken');
Route::post('generate-print-token',[FreshEmpanelmentController::class,'generatePrintToken']);
Route::get('submitted-token/{token_date?}', [FreshEmpanelmentController::class,'submittedtoken'])->name('submitted-token');

// end print route


// print group login 
Route::get('/group-account',[PrintVendorGroup::class,'groupAccountDetails']);


// payment routes
Route::post('vendor-payment-bharatkosh', [PaymentController::class, 'signSignature']);
Route::match(['get','post'],'bharatkosh-payment-response', [PaymentController::class, 'verifySignature'])->name('bharatkosh-payment-response');

// Route::match(['get','post'],'bharatkosh-payment-response', array('before' => 'auth', function()
// {
//     return 'outdoor-media-list'
// }));

Route::get('vendor-payment/{media_id}', [PaymentController::class, 'index']);
Route::get('get-payment-details', [PaymentController::class,'getPaymentDetails'])->name('get-payment-details');

// end payment routes



Route::get('fresh-empanelment-av-media', function () {
    return view('admin.pages.fresh-empanelment-av-media-form');
});
Route::get('fresh-empanelment-digital-cinema', function () {
    return view('admin.pages.fresh-empanelment-digital-cinema-form');
});


//Internet Website start created priyanshi

 /* Internet Website Agreement file Upload and download created by priyanshi */
 Route::get('intWeb-file-upload', [AgreementController::class, 'intWebfileUpload'])->name('intWeb-file-upload');
 Route::post('intWeb-file-upload', [AgreementController::class, 'intWeb_file_upload'])->name('intWeb-file-upload');
 Route::get('intweb-file-download', [AgreementController::class, 'intWeb_download_file'])->name('intweb-file.download');
/* End Route internetWWebsite */

/*strat Internet Website*/
//Internet Website start created priyanshi
Route::get("intfetchStates", [InternetWebsiteController::class, 'intfetchStates'])->name('intfetchStates');
Route::get("intfetchDistricts", [InternetWebsiteController::class, 'intfetchDistricts'])->name('intfetchDistricts');
Route::get('internet-website',[InternetWebsiteController::class,'internetWebSave'])->name('internet-website');
Route::post("saveInternetWeb", [InternetWebsiteController::class,'saveinterNetWebsite'])->name('saveInternetWeb');
Route::get("checkgst", [InternetWebsiteController::class, 'checkgst'])->name('checkgst');

/* InternetWeb PDF */
Route::get('internetWebPDF/{userid}',[InternetWebsiteController::class, 'internetWebPDF']);
Route::get('get-internetwebsite-city',[InternetWebsiteController::class,'websitegetCITY'])->name('get-internetwebsite-city');
/*End Internet Website*/

/* Start Digital Cinema*/
Route::get('digital-cinema',[DigitalCinemaController::class,'Digitalview'])->name('digital-cinema');
Route::post('DGCOwner',[DigitalCinemaController::class,'DGCOwner'])->name('DGCOwner');
Route::post('DigitalSeats',[DigitalCinemaController::class,'DigitalSeats'])->name('DigitalSeats');
Route::post('AccountDetails',[DigitalCinemaController::class,'AccountDetails'])->name('AccountDetails');
Route::post('SaveDocFile',[DigitalCinemaController::class,'SaveDocFile'])->name('SaveDocFile');
Route::post('getifsc',[DigitalCinemaController::class,'getifsc'])->name('getifsc');
Route::get('DigitalgetDistricts',[DigitalCinemaController::class, 'DigitalgetDistricts'])->name('DigitalgetDistricts');
Route::get('getDigitalPDF/{id}',[DigitalCinemaController::class,'GeneratePDF'])->name('getDigitalPDF');
Route::get('get-digital-city',[DigitalCinemaController::class,'digitalgetCITY'])->name('get-digital-city');
Route::post('DigitalgetState', [DigitalCinemaController::class, 'DigitalgetState'])->name('DigitalgetState');
/*End Digital cinema */

//Digital Cinema Agreement
Route::get('digital-agreement',[AgreementController::class,'digitalcinemaUpload'])->name('digital-agreement');
Route::post('digital_file_upload',[AgreementController::class,'digital_file_upload'])->name('digital_file_upload');
Route::get('Digital_download_file',[AgreementController::class,'Digital_download_file'])->name('Digital_download_file');
/*End Digital cinema */

/* Start of Fresh Empanelment of Bulk SMS & OBD */
Route::get('bulk-sms',[BulkSmsController::class,'InsertBulkSms'])->name('bulk-sms');
Route::post("SaveBulkSms", [BulkSmsController::class,'SaveBulkSms'])->name('SaveBulkSms');
Route::get('getDistrictsms', [BulkSmsController::class, 'fetchDistricts'])->name('getDistrictsms');
Route::post('get-all-Bluksms',[BulkSmsController::class, 'getAllBulksms'])->name('get-all-Bluksms');
Route::get('getIFSC',[BulkSmsController::class,'getifsc'])->name('getIFSC');
Route::get('checkgst',[BulkSmsController::class,'checkgst'])->name('checkgst');
Route::get('pdfbulk-sms/{id}',[BulkSmsController::class,'generatepdfBulkSms'])->name('pdfbulk-sms');
Route::get('get-bulksms-city',[BulkSmsController::class,'bulkgetCITY'])->name('get-bulksms-city');

Route::get('bulksms-agreement',[AgreementController::class,'bulkUpload'])->name('bulksms-agreement');
Route::post('bulksms_file_upload',[AgreementController::class,'bulksms_file_upload'])->name('bulksms_file_upload');
Route::get('bulk_download_file',[AgreementController::class,'bulk_download_file'])->name('bulk_download_file');
/*Start of Fresh Empanelment of Bulk SMS & OBD */



// Route::get('vendor-empanelment', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorEmpanelment']);
// Route::get('vendor-empanelment-view', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorEmpanelmentView']);
Route::get('vendor-rate-offered', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorRateOffered']);
Route::post('vendor-rate-status-update', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorRateStatusupdate'])->name('vendor-rate-status-update');
Route::get('check-regno-cir-base', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRegCirBase'])->name('check-regno-cir-base');
Route::get('check-gstno', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkGstno']);
Route::get('check-isprimaryedition', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkIsPrimaryEdition']);

Route::get('check-renewal-gstno', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRenewalGSTNo']);
Route::get('check-renewal-regno-cir-base', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRenewalRegCirBase']);
Route::get('check-renewal-unique-email-vendor', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkUniqueEmailVendor']);
Route::get('checkgstprint', [App\Http\Controllers\FreshEmpanelmentController::class,'checkgstprint']);

 /* Vendor Agreement file Upload and download created by priyanshi */
    Route::get('file-upload', [AgreementController::class, 'fileUpload'])->name('file.upload');
    Route::post('file-upload', [AgreementController::class, 'agreement_file_upload'])->name('file.upload.post');
    Route::get('file-download', [AgreementController::class, 'agreement_download_file'])->name('file.download');

//vendor renewal agreement
Route::get('renewal-agreement-upload', [AgreementController::class, 'renewalAgreement'])->name('renewal-agreement-upload');
Route::post('renewal-agreement-upload', [AgreementController::class, 'renewalAgreementUpload'])->name('renewal-agreement-upload');
Route::get('renewal-agreement-download', [AgreementController::class, 'renewalAgreementDownload'])->name('renewal-agreement.download');


Route::get('master',[ClientSubmissionController::class,'npmaster']);  //Temparory code for create login details of existing vendors.
Route::get('/emailVerify',[App\http\controllers\auth\BocUserController::class,'emailVerify'])->name('emailVerify');
Route::get('getODMediaSubCat/{mediaGroupId?}/{mediaUIDCode?}', [ClientSubmissionController::class,'getODMediaSubCat'])->name('getODMediaSubCat');
/*Start genral routes*/
Route::match(['get','post'],'ministry-wise-client-list', [App\http\controllers\GenralMainController::class,'ministry_code_list'])->name('ministry-code-list');
Route::match(['get','post'],'ministry-wise-client-code', [App\http\controllers\GenralMainController::class,'ministry_code_code'])->name('ministry-wise-client-code');
Route::match(['get','post'],'tv-channel-list', [App\http\controllers\GenralMainController::class,'TVchannellist'])->name('tv-channel-list');
Route::match(['get','post'],'tv-channel-code-list', [App\http\controllers\GenralMainController::class,'TVchannellistdashboard'])->name('tv-channel-code-list');
Route::match(['get','post'],'tam-data', [App\http\controllers\GenralMainController::class,'upload_tam_data'])->name('tam-data');
Route::match(['get','post'],'import-tam-data', [App\http\controllers\GenralMainController::class,'import_tam_data'])->name('import-tam-data');
Route::get("outdoor-instruction", [App\http\controllers\GenralMainController::class, 'outdoor_instruction'])->name('outdoor-instruction');
/*End genral routes*/

Route::get('client-details', [ClientSubmissionController::class,'client_details'])->name('client-details');
Route::get('check-detail',[App\http\controllers\GenralMainController::class,'tam_data_check']);
/*Start genral routes*/
Route::match(['get','post'],'ministry-code-list', [App\http\controllers\GenralController::class,'ministry_code_list'])->name('ministry-code-list');
/*End genral routes*/
Route::match(['get','post'],'client-profile', [ClientSubmissionController::class, 'client_profile'])->name('client-profile');
// Route::get('get-banner',[App\Http\Controllers\auth\BocUserController::class, 'getROBbanner'])->name('get-banner');
Route::get('change-password', [App\Http\Controllers\auth\BocUserController::class, 'showChangePasswordGet'])->name('change-password');
Route::post('changePasswordPost', [App\Http\Controllers\auth\BocUserController::class, 'changePassword'])->name('changePasswordPost');
// Route::get('datainsert', [App\http\controllers\auth\BocUserController::class,'datainsert']);
Route::match(['get','post'],'vendor-signup', [App\http\controllers\auth\BocUserController::class,'createSignup'])->name('vendor-signup');
Route::get('signup_confirm', [App\Http\Controllers\auth\BocUserController::class, 'signup_confirm'])->name('signup_confirm');
Route::post('set-password', [App\Http\Controllers\auth\BocUserController::class, 'setpassword'])->name('setpassword');
Route::post('signup_confirm', [App\Http\Controllers\auth\BocUserController::class, 'signupConfirm'])->name('signupConfirm');
Route::get('resendotp', [App\Http\Controllers\auth\BocUserController::class, 'resendotp_form'])->name('resendotp_form');
Route::post('resendotp', [App\Http\Controllers\auth\BocUserController::class, 'resendotp_post'])->name('resendotp_post');
Route::get('logout', [App\Http\Controllers\auth\BocUserController::class, 'signOut'])->name('logout');

Route::get('/demo',[ArogiController::class,'demoApi']);
Route::post('/demo',[ArogiController::class,'demosave']);
Route::get('{slug}',[App\http\controllers\auth\BocUserController::class,'showSigninForm']);
Route::post('{slug1}',[App\http\controllers\auth\BocUserController::class,'createSignin']);


