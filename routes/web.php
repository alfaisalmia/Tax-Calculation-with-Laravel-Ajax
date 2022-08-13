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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// Register and Login
Route::get('/clientRegister', 'Client\ClientRegisterController@index');
Route::get('/signin', 'Client\SignInController@index');
Route::get('/signupConfirmation', 'Client\SignupConfirmationController@signupConfirmation');
Route::post('/signin', 'Client\SignInController@login')->name('login');
Route::post('/logout', 'Client\SignInController@logout')->name('logout');

//#########################  Personal Information (Profile)#######################
Route::get('personalinfo/basicInfo', 'Client\PersonalInfo\PersonalInfoController@basicInfo')->name('basicinfo');
Route::post('personalinfo/basicInfo', 'Client\PersonalInfo\PersonalInfoController@BasicInfoInsert');
Route::get('/personalinfo/otherInformation', 'Client\PersonalInfo\OtherInfoController@index');
Route::get('personalinfo/summary', 'Client\PersonalInfo\SummaryController@index');
// Basic Info Insert
Route::get('/BasicInfoInsert', 'Client\PersonalInfo\PersonalInfoController@BasicInfoInsert');
Route::get('/OtherInformationSave', 'Client\PersonalInfo\OtherInfoController@OtherInformationSave');
// Other Info Controller
Route::get('/OtherInfoSave', 'Client\PersonalInfo\OtherInfoController@OtherInfoSave');

//######################### Income Section #######################
Route::get('/income/mainPage', 'Client\Income\IncomeController@index');
Route::get('/income/salaryAndWages', 'Client\Income\SalaryAndWagesController@index');
Route::get('/income/paygPaymentSummary', 'Client\Income\SalaryAndWagesController@paygPaymentSummary');
Route::post('/income/paygPaymentSummary', 'Client\Income\SalaryAndWagesController@paygPaymentSummary');
Route::get('/income/govtPayments', 'Client\Income\GovtPaymentController@index');
Route::get('/GovtPaymentDataSave', 'Client\Income\GovtPaymentController@DataSave');
Route::get('/income/etp', 'Client\Income\EtpController@index');
Route::get('/EtpFormDataSave', 'Client\Income\EtpController@EtpFormDataSave');




Route::get('/income/superannuation', 'Client\Income\SuperannuationController@index');
Route::get('/income/superannuation/incomeStream', 'Client\Income\SuperannuationController@incomeStream');
Route::get('/income/superannuation/incomeStream', 'Client\Income\SuperannuationController@incomeStream');
Route::get('/SuperannuationFormDataSave', 'Client\Income\SuperannuationController@SuperannuationFormDataSave');
Route::get('/SLumSumPaymentsSave', 'Client\Income\SuperannuationController@DataSave');
Route::get('/income/superannuation/lumsumPayments', 'Client\Income\SuperannuationController@lumsumPayments');


Route::get('/income/interestDividends', 'Client\Income\InterestDividendController@index');
Route::get('/InterestIncomeFormDataSave', 'Client\Income\InterestDividendController@InterestIncomeFormDataSave');
Route::get('/DividendIncomeFormDataSave', 'Client\Income\InterestDividendController@DividendIncomeFormDataSave');
Route::get('/InterestDividendSaveGo', 'Client\Income\InterestDividendController@InterestDividendSaveGo');
Route::get('/income/interestDividends/interestIncome', 'Client\Income\InterestDividendController@interestIncome');
Route::get('/income/interestDividends/dividendIncome', 'Client\Income\InterestDividendController@dividendIncome');
// Capital Gains
Route::get('/income/capitalGains', 'Client\Income\CapitalGainsController@index');
Route::get('/income/capitalGains/saleOfShare', 'Client\Income\CapitalGainsController@saleOfShare');
Route::get('/SaleOfShareFormDataSave', 'Client\Income\CapitalGainsController@SaleOfShareFormDataSave');
Route::get('/income/capitalGains/import', 'Client\Income\CapitalGainsController@import');
Route::get('/CapitalGainsDataSave', 'Client\Income\CapitalGainsController@CapitalGainsDataSave');
// Personal Services
Route::get('/income/personalServices', 'Client\Income\PersonalServicesController@index');
Route::get('/income/personalServices/psi', 'Client\Income\PersonalServicesController@psi');
Route::get('/PersonalServiceIncomeFormDataSave', 'Client\Income\PersonalServicesController@PersonalServiceIncomeFormDataSave');
// Business Rental
Route::get('/income/businessRental', 'Client\Income\BusinessRentalController@index');
Route::get('/income/businessRental/businessIncome', 'Client\Income\BusinessRentalController@businessIncome');
Route::get('/income/businessRental/RentalIncome', 'Client\Income\BusinessRentalController@RentalIncome');
Route::get('/BusinessIncomeDataSave', 'Client\Income\BusinessRentalController@BusinessIncomeDataSave');
Route::get('/RentalIncomeFormDataSave', 'Client\Income\BusinessRentalController@RentalIncomeFormDataSave');



Route::get('/income/businessRental/nonPSI', 'Client\Income\BusinessRentalController@nonPSI');

// Partnership and Trust
Route::get('/income/partnershipTrust/', 'Client\Income\PartnershipTrustController@index');
Route::get('/PartnerShipFormDataSave', 'Client\Income\PartnershipTrustController@PartnerShipFormDataSave');

//Foreign Income
Route::get('/income/foreignIncome', 'Client\Income\ForeignIncomeController@index');
Route::get('/ForeignIncomeRadioSave', 'Client\Income\ForeignIncomeController@ForeignIncomeRadioSave');
Route::get('/ForeignIncomeFormDataSave', 'Client\Income\ForeignIncomeController@ForeignIncomeFormDataSave');
Route::get('/income/foreignIncome/income', 'Client\Income\ForeignIncomeController@income');
//Forestry Investment
Route::get('/income/forestryInvestment', 'Client\Income\ForestryInvestmentController@index');
Route::get('/ForestryInvesetmentFormDataSave', 'Client\Income\ForestryInvestmentController@DataSave');
// Employee Share
Route::get('/income/employeeShare', 'Client\Income\EmployeeShareController@index');
Route::get('/income/employeeShare/schemes', 'Client\Income\EmployeeShareController@schemes');
Route::get('/EmployeeShareFormDataSave', 'Client\Income\EmployeeShareController@EmployeeShareFormDataSave');
// Other Income
Route::get('/income/otherIncome', 'Client\Income\OtherIncomeController@index');
Route::get('/OtherIncomeFormDataSave', 'Client\Income\OtherIncomeController@OtherIncomeFormDataSave');
//Route::get('/income/otherIncome', 'Client\Income\OtherIncomeController@index');
// Allowance
//Route::get('/income/Allowance', 'Client\Income\AllowancesController@index');
//Limp Sums 
//Route::get('/income/LumpSums', 'Client\Income\LumpSumsController@index');
//
//
Route::get('/PayPaymentSummaryAdd', 'Client\Income\SalaryAndWagesController@PayPaymentSummaryAdd');
Route::get('/PaygPaymentSummarySave', 'Client\Income\SalaryAndWagesController@PaygPaymentSummarySave');
Route::get('/SalaryAndWagesSave', 'Client\Income\SalaryAndWagesController@SalaryAndWagesSave');


//######################### Deduction Section #######################
Route::get('/deduction/mainPage', 'Client\Deduction\DeductionController@index');
// Car Expenses
Route::get('/deduction/carExpenses', 'Client\Deduction\CarExpensesController@carExpenses');
Route::get('/deduction/carExpenses/vehicleExpenses', 'Client\Deduction\CarExpensesController@vehicleExpenses');
Route::get('/CarExpenFormDataSave', 'Client\Deduction\CarExpensesController@CarExpenFormDataSave');
// Uniform Travel
Route::get('/deduction/uniformTravel', 'Client\Deduction\UniformTravelController@index');
Route::get('/UniformTravelDataSave', 'Client\Deduction\UniformTravelController@DataSave');
// Other Expenses
Route::get('/deduction/otherExpenses', 'Client\Deduction\OtherExpensesController@index');
Route::get('/deduction/otherExpenses/deprecativeDeduction', 'Client\Deduction\OtherExpensesController@deprecativeDeduction');
Route::get('/deduction/otherExpenses/OtherDeductibleExpenses', 'Client\Deduction\OtherExpensesController@OtherDeductibleExpenses');
Route::get('/DeprecativeDeducDataSave', 'Client\Deduction\OtherExpensesController@DeprecativeDeducDataSave');
Route::get('/OtherExpensesSa', 'Client\Deduction\OtherExpensesController@OtherExpensesSa');
Route::get('/OtherDeducFormDataSave', 'Client\Deduction\OtherExpensesController@OtherDeducFormDataSave');
//Self Education
Route::get('/deduction/selfEducation/', 'Client\Deduction\SelfEducationController@index');
Route::get('/deduction/selfEducation/form', 'Client\Deduction\SelfEducationController@form');
Route::get('/deduction/selfEducation/depriciationDeduction', 'Client\Deduction\SelfEducationController@depriciationDeduction');
Route::get('/SelfEduFormSave', 'Client\Deduction\SelfEducationController@SelfEduFormSave');
Route::get('/DeprecativeDeducDataSaveSelf', 'Client\Deduction\SelfEducationController@DeprecativeDeducDataSaveSelf');
//Gift Donation
Route::get('/deduction/giftDonation', 'Client\Deduction\GiftDonationController@index');
Route::get('/GiftDonationDataSave', 'Client\Deduction\GiftDonationController@GiftDonationDataSave');
//Tax Investment
Route::get('/deduction/taxInvestment', 'Client\Deduction\TaxInvestmentController@index');
Route::get('/TaxInvestmentSave', 'Client\Deduction\TaxInvestmentController@TaxInvestmentSave');

//######################### Deduction Section #######################
Route::get('/otherdetails/mainPage', 'Client\OtherDetails\OtherDetailsController@index');
// Medical Expenses
Route::get('/otherdetails/medicalExpenses', 'Client\OtherDetails\MedicalExpensesController@index');
Route::get('/MedicalExpeSave', 'Client\OtherDetails\MedicalExpensesController@MedicalExpeSave');
//Private Coverage
Route::get('/otherdetails/privateCoverage', 'Client\OtherDetails\PrivateCoverageController@index');
Route::get('/otherdetails/privateCoverage/PrivateHealthInsurance', 'Client\OtherDetails\PrivateCoverageController@PrivateHealthInsurance');
Route::get('/PrivateHealthInsuSave', 'Client\OtherDetails\PrivateCoverageController@PrivateHealthInsuSave');
//Zone Offset
Route::get('/otherdetails/zoneOffset', 'Client\OtherDetails\ZoneOffsetController@index');
Route::get('/ZoneOffsetSaveData', 'Client\OtherDetails\ZoneOffsetController@ZoneOffsetSaveData');
// PAYG Installment
Route::get('/otherdetails/paygInstallments', 'Client\OtherDetails\PAYGInstallment@index');
Route::get('/paygInstallmentsave', 'Client\OtherDetails\PAYGInstallment@paygInstallmentsave');
// Other Items
Route::get('/otherdetails/otherItems', 'Client\OtherDetails\OtherItemsController@index');
Route::get('/OtherItemsSave', 'Client\OtherDetails\OtherItemsController@OtherItemsSave');
//Investor Venture
Route::get('/otherdetails/investorVenture', 'Client\OtherDetails\InvestorVentureController@index');
Route::get('/otherdetails/investorVenture/{id}', 'Client\OtherDetails\InvestorVentureController@second');
Route::get('/InvestVentureSave', 'Client\OtherDetails\InvestorVentureController@InvestVentureSave');

//######################### Deduction Section #######################
//Review
Route::get('/review/final', 'Client\Review\ReviewController@index');
//Finish
Route::get('/finish', 'Client\Finish\FinishController@index');



// Ajax Related Route
Route::get('/signUpData', 'Client\AjaxController@signUpData');
//Route::get('/checklistSelect', 'Client\AjaxController@checklistSelect');
Route::get('/checklistSelect', 'Client\AjaxController@checklistSelect');
Route::get('/findState', 'Client\AjaxController@findState');
Route::get('/findCities', 'Client\AjaxController@findCities');
Route::get('/GetPreciousPostalAddresss', 'Client\AjaxController@GetPreciousPostalAddresss');
Route::get('/GetHomePostalAddress', 'Client\AjaxController@GetHomePostalAddress');
Route::get('/GetPreviousName', 'Client\AjaxController@GetPreviousName');
Route::get('/SuburbAjaxPro', 'Client\AjaxController@SuburbAjaxPro');

