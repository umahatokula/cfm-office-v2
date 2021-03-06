<?php

use App\Http\Controllers\AccountSettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\CellsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ChurchesController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LifeCoachController;
use App\Http\Controllers\GrowthPathController;
use App\Http\Controllers\MinistriesController;
use App\Http\Controllers\AgeProfilesController;
use App\Http\Controllers\CellMembersController;
use App\Http\Controllers\ChurchRolesController;
use App\Http\Controllers\FirstTimersController;
use App\Http\Controllers\ExpenseHeadsController;
use App\Http\Controllers\InvolvementsController;
use App\Http\Controllers\RequisitionsController;
use App\Http\Controllers\ServiceTeamsController;
use App\Http\Controllers\CellAttendanceController;
use App\Http\Controllers\ChurchServicesController;
use App\Http\Controllers\FollowupTargetController;
use App\Http\Controllers\SalaryScheduleController;
use App\Http\Controllers\ChartOfAccountsController;
use App\Http\Controllers\FollowUpReasonsController;
use App\Http\Controllers\FollowupReportsController;
use App\Http\Controllers\LifeCoachTargetController;
use App\Http\Controllers\StaffBankDetailController;
use App\Http\Controllers\RetireRequisitionsController;
use App\Http\Controllers\WeeklyChurchReportController;
use App\Http\Controllers\CfcKidsWeeklyReportController;
use App\Http\Controllers\PostServiceAccountsController;
use App\Http\Controllers\SpecialRequisitionsController;
use App\Http\Controllers\SalaryScheduleElementController;


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

// require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('dashboard');
});



// ==================================MIGRATION FROM OLD==================================

Route::group(['middleware' => 'auth'], function() {

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Members
    Route::get('members/{member}/notify', [MembersController::class, 'notify'])->name('members.notify');
    Route::post('members/notify', [MembersController::class, 'notifyPost'])->name('members.notifyPost');
    Route::get('members/{id}/picture', 					[MembersController::class, 'getPicture'])->name('members.picture');
    // Route::get('members/delete/{id}', 					[MembersController::class, 'delete'])->name('members.delete');
    Route::get('members/cell/{member_id}/{cell_id}', 	[MembersController::class, 'addTocell'])->name('members.cell');
    Route::get('members/search', 						[MembersController::class, 'search'])->name('members.search');
    Route::post('members/autocomplete', 				[MembersController::class, 'search'])->name('members.search');
    Route::post('members/service-teams', 				[MembersController::class, 'addToServiceTeam'])->name('members.service-teams');
    Route::resource('members', MembersController::class);

    // staff
    Route::get('staff/{staff}/notify', [StaffController::class, 'notify'])->name('staff.notify');
    Route::post('staff/notify', [StaffController::class, 'notifyPost'])->name('staff.notifyPost');
    Route::resource('staff', StaffController::class);

    // staff bank details
    Route::get('staff/{staff}/bank-details', [StaffBankDetailController::class, 'create'])->name('staff.bankDetails');
    Route::get('staff/{staff}/bank-details/create', [StaffBankDetailController::class, 'create'])->name('staff.bankDetails.create');
    Route::post('staff/bank-details', [StaffBankDetailController::class, 'store'])->name('staff.bankDetails.store');
    Route::get('staff/{staffBankDetail}/{staff}/bank-details/edit', [StaffBankDetailController::class, 'edit'])->name('staff.bankDetails.edit');
    Route::put('staff/{staff}/bank-details', [StaffBankDetailController::class, 'update'])->name('staff.bankDetails.update');
    Route::get('staff/bank-details/all', [StaffBankDetailController::class, 'allBankDetails']);

    // Cells
    Route::get('cells/leader-profile/{id}', 	[CellsController::class, 'leaderProfile'])->name('cell.leader-profile');
    Route::get('cells/delete/{id}', 	[CellsController::class, 'delete'])->name('cells.delete');
    Route::get('cells/suggest/{member_id}', 	[CellsController::class, 'suggest'])->name('cells.suggest');
    Route::get('cells/search', 			[CellsController::class, 'search'])->name('cells.search');
    Route::get('cells/show-form/{id}', 	['as'=>CellsController::class, 'showReportForm'])->name('show-form');
    Route::post('cells/store-report', 	['as'=>CellsController::class, 'storeReport'])->name('store-report');
    Route::get('cells/weekly-report-details/{id}', 	[CellsController::class, 'weeklyReportDetails'])->name('cells.weekly-report-details');
    Route::get('cells/delete-weekly-report/{id}', 	[CellsController::class, 'deleteReportForm'])->name('cells.delete-weekly-report');
    Route::get('cells/edit-weekly-report/{id}', 	[CellsController::class, 'editReportForm'])->name('cells.edit-weekly-report');
    Route::put('cells/update-weekly-report/{id}', 	[CellsController::class, 'updateReport'])->name('cells.update-weekly-report');
    Route::get('cells/quarterly-follow-up/{id}', 	[CellsController::class, 'quarterlyFollowup'])->name('cells.quarterly-follow-up');
    Route::post('cells/store-quarterly-follow-up/', [CellsController::class, 'storeQuarterlyFollowup'])->name('cells.store-quarterly-');
    Route::get('cells/filtered/{id?}', [CellsController::class, 'filtered'])->name('cells.filtered');
    Route::resource('cells', CellsController::class);

    // Cell Members
    Route::get('cell-members/{id}/delete', 	[CellMembersController::class, 'delete'])->name('cell-members.delete');
    Route::get('cell-members/{cell_id}/create', 	[CellMembersController::class, 'create'])->name('cell-members.create');
    Route::get('cell-members/{cell_id}/show', 	[CellMembersController::class, 'show'])->name('cell-members.show');
    Route::get('cell-members/{cell_id}/edit', 	[CellMembersController::class, 'edit'])->name('cell-members.edit');
    Route::put('cell-members/{id}', 	[CellMembersController::class, 'update'])->name('cell-members.update');
    Route::post('cell-members/', 	[CellMembersController::class, 'store'])->name('cell-members.store');

    // Cell Attendance
    Route::get('cell-attendance/get/{cell_id}/{year}/{month_id}', 	[CellAttendanceController::class, 'getAttendance'])->name('cell-attendance.get');
    Route::put('cell-attendance/filter/{cell_id}', 	[CellAttendanceController::class, 'filter'])->name('cell-attendance.filter');
    Route::resource('cell-attendance', CellAttendanceController::class);

    //Service Teams
    Route::get('service-teams/{id}/delete', 	[ServiceTeamsController::class, 'delete'])->name('service-teams.delete');
    Route::get('service-teams/suggest/{member_id}', 	[ServiceTeamsController::class, 'suggest'])->name('service-teams.suggest');
    Route::get('service-teams/search', 		[ServiceTeamsController::class, 'search'])->name('service-teams.search');
    Route::resource('service-teams', ServiceTeamsController::class);

    //Users
    Route::get('users/{id}/delete', [UsersController::class, 'delete'])->name('users.delete');
    Route::resource('users', UsersController::class);

    //Involements
    Route::get('involements/{member}/show', 	[InvolvementsController::class, 'show'])->name('involements.show');

    //Ministries
    Route::post('members/ministry', [MinistriesController::class, 'addMembersToMinistry']);
    Route::resource('ministries', MinistriesController::class);

    //Church
    Route::resource('churches', ChurchesController::class);

    //Church Roles
    Route::post('members/church-role', 	[ChurchRolesController::Class, 'addMembersToChurchRole'])->name('members.church-role');
    Route::post('church-role/delete', 	[ChurchRolesController::Class, 'delete'])->name('church-role.delete');
    Route::resource('church-role', ChurchRolesController::class);

    //Growth Paths
    Route::post('members/growth-path', [GrowthPathController::class, 'addMembersToGrowthPath'])->name('members.growth-path');
    Route::resource('growth-path', GrowthPathController::class);

    //Family
    Route::post('family/find-member', [FamilyController::class, 'findMember'])->name('family.find-member');
    Route::post('family/add-member', [FamilyController::class, 'addMemberToFamily'])->name('family.add-member');
    Route::post('family/delete-member', [FamilyController::class, 'deleteFamilyMember'])->name('family.delete-member');
    Route::resource('family', FamilyController::class);

    // follow up reasons
    Route::post('follow-up-reasons/delete', [FollowUpReasonsController::class, 'delete'])->name('follow-up-reasons.delete');
    Route::resource('follow-up-reasons', FollowUpReasonsController::class);

    // regions
    Route::post('regions/delete', [RegionsController::class, 'delete'])->name('regions.delete');
    Route::resource('regions', RegionsController::class);

    // age profile
    Route::post('age-profile/delete', [AgeProfilesController::class, 'delete'])->name('age-profile.delete');
    Route::resource('age-profile', AgeProfilesController::class);

    // settings
    Route::resource('settings', SettingsController::class);

    //Church Service
    Route::get('church-services/pdf/{date_from?}/{date_to?}/{service_type_id?/{church_id?}}', [ChurchServicesController::class, 'churchServicePDF'])->name('church-services.pdf');
    Route::get('church-services/{id}/details/pdf', [ChurchServicesController::class, 'churchServiceDetailsPDF'])->name('church-services.details.pdf');
    Route::get('church-services/{id}/delete', [ChurchServicesController::class, 'delete'])->name('church-services.delete');
    Route::get('church-services/{id}/admin-pastor-approve', [ChurchServicesController::class, 'adminPastorApprove'])->name('church-services.admin-pastor-approve');
    Route::get('church-services/{id}/head-pastor-approve', [ChurchServicesController::class, 'headPastorApprove'])->name('church-services.head-pastor-approve');
    Route::post('church-services/search', [ChurchServicesController::class, 'search'])->name('church-services.search');
    Route::resource('church-services', ChurchServicesController::class);

    //First Timers
    Route::get('first-timers/{id}/delete', [FirstTimersController::class, 'delete'])->name('first-timers.delete');
    Route::post('first-timers/search', [FirstTimersController::class, 'search'])->name('first-timers.search');
    Route::post('first-timers/autocomplete', [FirstTimersController::class, 'autocomplete'])->name('first-timers.autocomplete');
    Route::resource('first-timers', FirstTimersController::class);

    // Accounts
    Route::resource('accounts', AccountsController::class);

    // Church Weekly Report
    Route::get('weekly-church-report/create', [WeeklyChurchReportController::class, 'create'])->name('weekly-church-report.create');
    Route::get('weekly-church-report/{id?}', [WeeklyChurchReportController::class, 'index'])->name('weekly-church-report.index');
    Route::get('weekly-church-report/{id}/edit', [WeeklyChurchReportController::class, 'edit'])->name('weekly-church-report.edit');
    Route::put('weekly-church-report/{id}/update', [WeeklyChurchReportController::class, 'update'])->name('weekly-church-report.update');
    Route::post('weekly-church-report/store', [WeeklyChurchReportController::class, 'store'])->name('weekly-church-report.store');
    Route::post('weekly-church-report/review/{id}', [WeeklyChurchReportController::class, 'review'])->name('weekly-church-report.review');
    // Route::resource('weekly-church-report', WeeklyChurchReportController::class);



    //SMS
    Route::get('sms', [SMSController::class, 'index'])->name('sms.index');
    Route::get('sms/show-single/{customer}', [SMSController::class, 'showSingle'])->name('sms.show-single');
    Route::post('sms/send-single', [SMSController::class, 'sendSingle'])->name('sms.send-single');
    Route::post('sms/create/group', [SMSController::class, 'createGroup'])->name('sms.create.group');
    Route::post('sms/edit/group', [SMSController::class, 'editGroup'])->name('sms.edit.group');
    Route::post('sms/send', [SMSController::class, 'send'])->name('sms.send');
    Route::get('sms/get-group-phones/{group_id}', [SMSController::class, 'getGroupPhoneNumbers'])->name('sms.get-group-phones');
    Route::get('sms/my-members', [SMSController::class, 'myMembers'])->name('sms.my-members');


    //CFC KIDS WEEKLY REPORT
    Route::get('cfc-kids-weekly-report/{id}/delete', [CfcKidsWeeklyReportController::class, 'delete'])->name('cfc-kids-weekly-report.delete');
    Route::resource('cfc-kids-weekly-report', CfcKidsWeeklyReportController::class);

    // REPORTS
    Route::get('reports/service-days/', [ReportsController::class, 'serviceDays'])->name('reportsServiceDays');
    Route::get('reports/service-days/pdf/{first_date_from}/{first_date_to}/{second_date_from?}/{second_date_to?}', [ReportsController::class, 'reportsChurchServicesPdf'])->name('reportsChurchServicesPdf');
    Route::get('reports/general', [ReportsController::class, 'general'])->name('reportsGeneral');

    // ========================================================================================================

    // life choaches
    Route::get('life-coaches/create-target/{lifeCoach}', [LifeCoachController::class, 'createTarget'])->name('life-coaches.create-target');
    Route::post('life-coaches/create-target', [LifeCoachController::class, 'createTargetStore'])->name('life-coaches.create-target.store');
    Route::get('life-coaches/assign-target/{lifeCoach}', [LifeCoachController::class, 'assign'])->name('life-coaches.assign');
    Route::post('life-coaches/assign-target/save', [LifeCoachController::class, 'assignStore'])->name('life-coaches.assign.store');
    Route::get('life-coaches/coach-targets', [LifeCoachController::class, 'index'])->name('coach-targets');
    Route::resource('life-coaches', LifeCoachController::class);
    // Route::delete('life-coach/coach-targets/{target}/reports/delete', [ReportController::class, 'destroy'])->name('delete-report');

    // followup targets
    Route::get('followup-targets/assign/{followupTarget}', [FollowupTargetController::class, 'assign'])->name('followup-targets.assign');
    Route::post('followup-targets/assign', [FollowupTargetController::class, 'assignStore'])->name('followup-targets.assign.store');
    Route::get('followup-targets/{followupTarget}/delete', [FollowupTargetController::class, 'delete'])->name('followup-targets.delete');
    Route::resource('followup-targets', FollowupTargetController::class);

    Route::get('followup-reports/{target}', [FollowupReportsController::class, 'index'])->name('followup-reports.all-reports');
    Route::get('followup-reports/{target}/create', [FollowupReportsController::class, 'create'])->name('followup-reports.create');
    Route::post('followup-reports/store', [FollowupReportsController::class, 'store'])->name('followup-reports.store');
    Route::get('followup-reports/{report}/show', [FollowupReportsController::class, 'show'])->name('followup-reports.show');
    Route::get('followup-reports/{target}/edit', [FollowupReportsController::class, 'edit'])->name('followup-reports.edit');
    Route::put('followup-reports/{target}/update', [FollowupReportsController::class, 'update'])->name('followup-reports.update');

    // Users
    Route::resource('users', UsersController::class);




    // =========================================Accounting==============================================
    Route::prefix('accounting')->group(function () {

        // coa
        Route::resource('dashboard', AccountsController::class);

        // salaries
        Route::get('salaries/staff/{staff}/edit', [SalaryController::class, 'editStaffSalary'])->name('salaries.staff.edit');
        Route::get('salaries/{salaryId}/preview', [SalaryController::class, 'preview'])->name('salaries.staff.preview');
        Route::get('salaries/{salaryId}/export', [SalaryController::class, 'export'])->name('salaries.staff.export');
        Route::get('salaries/{salaryId}/pdf', [SalaryController::class, 'pdf'])->name('salaries.staff.pdf');
        Route::resource('salaries', SalaryController::class);

        // salaries schedule
        Route::resource('salaries-schedules', SalaryScheduleController::class);

        // salaries schedule elements
        Route::resource('salaries-schedule-elements', SalaryScheduleElementController::class);

        // Post Service Accounts
        Route::resource('post-service-accounts', PostServiceAccountsController::class);

        // Expense Heads
        Route::get('expense-heads/{id}/activate', [ExpenseHeadsController::class, 'activate'])->name('expense-heads.activate');
        Route::get('expense-heads/{id}/deactivate', [ExpenseHeadsController::class, 'deactivate'])->name('expense-heads.deactivate');
        Route::resource('expense-heads', ExpenseHeadsController::class);

        // Requisitions
        Route::get('requisitions/{id}/process', [RequisitionsController::class, 'process'])->name('requisitions.process');
        Route::put('requisitions/{id}/approve', [RequisitionsController::class, 'approve'])->name('requisitions.approve');
        Route::get('requisitions/{id}/decline', [RequisitionsController::class, 'decline'])->name('requisitions.decline');
        Route::get('requisitions/show-pay', [RequisitionsController::class, 'pay'])->name('requisitions.show-pay');
        Route::put('requisitions/{id}/pay', [RequisitionsController::class, 'payStore'])->name('requisitions.pay');
        Route::post('requisitions/pay/filter', [RequisitionsController::class, 'payFilter'])->name('requisitions.pay.filter');
        Route::post('requisitions/filter', [RequisitionsController::class, 'filter'])->name('requisitions.filter');
        Route::resource('requisitions', RequisitionsController::class);

        // Retire Requisitions
        Route::post('retire-requisitions/autocomplete', [RetireRequisitionsController::class, 'autocomplete'])->name('retire-requisitions.search');
        Route::post('retire-requisitions/search', [RetireRequisitionsController::class, 'search'])->name('retire-requisitions.search');
        Route::resource('retire-requisitions', RetireRequisitionsController::class);

        // Special Requisitions
        Route::get('special-requisitions/{id}/process', [SpecialRequisitionsController::class, 'process'])->name('special-requisitions.process');
        Route::put('special-requisitions/{id}/approve', [SpecialRequisitionsController::class, 'approve'])->name('special-requisitions.approve');
        Route::get('special-requisitions/{id}/decline', [SpecialRequisitionsController::class, 'decline'])->name('special-requisitions.decline');
        Route::get('special-requisitions/show-pay', [SpecialRequisitionsController::class, 'pay'])->name('special-requisitions.show-pay');
        Route::put('special-requisitions/{id}/pay', [SpecialRequisitionsController::class, 'payStore'])->name('special-requisitions.pay');
        Route::post('special-requisitions/pay/filter', [SpecialRequisitionsController::class, 'payFilter'])->name('special-requisitions.pay.filter');
        Route::post('special-requisitions/filter', [SpecialRequisitionsController::class, 'filter'])->name('special-requisitions.filter');
        Route::resource('special-requisitions', SpecialRequisitionsController::Class);

        // coa
        Route::resource('coa/settings', AccountSettingController::class);
        Route::resource('coa', ChartOfAccountsController::class);
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

