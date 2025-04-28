<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\AdminMedicineController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\ScheduleController;


use App\Http\Controllers\PdfController;

// Landing
Route::get('/', function () { 
    return view('landing');})->name('views.landing');

// Admin 
Route::get('/admins/login', [AuthController::class, 'showAdminLoginForm'])->name('admins.login');
Route::post('/admins/login', [AuthController::class, 'adminLogin']);
Route::get('/admins/home', [AdminController::class, 'home'])->name('admins.home');
Route::get('/adminPatients/{id}/edit', [AdminPatientController::class, 'edit'])->name('adminPatient.edit');


// Patient
Route::get('/login', function () {
    return redirect('/patients/login');})->name('login');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/login', [AuthController::class, 'showPatientLoginForm'])->name('patients.login');
Route::post('/patients/login', [AuthController::class, 'patientLogin']);
Route::post('/patients/logout', [AuthController::class, 'logout'])->name('patients.logout');
Route::post('/patients', [AdminPatientController::class, 'store'])->name('patients.store');
Route::get('/patients/profile', [PatientController::class, 'showProfile'])->name('patients.profile')->middleware('auth');
Route::get('/patients/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::patch('/patients/update', [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/destroy/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

// Doctor 
Route::get('/admindoctors', [MedicineController::class, 'index'])->name('admindoctors.index');
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/admindoctors/export', [PdfController::class, 'doctor_exportPdf'])->name('admindoctors.doctor_export');

// Doctor Dashboard
Route::get('/doctordash/home', [DoctorDashboardController::class, 'home'])->name('doctordash.home');
Route::get('/doctordash', [DoctorDashboardController::class, 'index'])->name('doctordash.index');
Route::get('/doctordash/login', [AuthController::class, 'showDoctorLoginForm'])->name('doctordash.login.form');
Route::post('/doctordash/login', [AuthController::class, 'doctorLogin'])->name('doctordash.login');

// Prescription Records
Route::prefix('doctordash')->group(function () {
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/prescriptions/{patient}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
    Route::get('/prescriptions/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::put('/prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
    Route::delete('/prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
    Route::get('/prescriptions/{prescription}/view', [PrescriptionController::class, 'view'])->name('prescriptions.view');
    Route::get('/prescriptions/{prescription}/upload', [PrescriptionController::class, 'upload'])->name('prescriptions.upload');
    Route::post('/prescriptions/{prescription}/upload', [PrescriptionController::class, 'upload'])->name('prescriptions.upload.store');
});

//Article
Route::get('/adminarticle', [AdminArticleController::class, 'index'])->name('adminarticle.index');
Route::get('/adminarticle/create', [AdminArticleController::class, 'create'])->name('adminarticle.create');
Route::get('/adminarticle/edit', [AdminArticleController::class, 'update'])->name('adminarticle.update');
Route::post('/adminarticle', [AdminArticleController::class, 'store'])->name('adminarticle.store');
Route::get('/articles', [AdminArticleController::class, 'generalIndex'])->name('adminarticle.generalIndex');
Route::get('/articles/search', [AdminArticleController::class, 'search'])->name('articles.search');


// Medicine 
Route::get('/adminmedicine', [MedicineController::class, 'index'])->name('adminmedicine.index');

// Export
Route::get('/adminPatient/export', [PdfController::class, 'patient_exportPdf'])->name('adminPatient.patient_export');
Route::get('/admindoctors/export', [PdfController::class, 'doctor_exportPdf'])->name('admindoctors.doctor_export');
Route::get('/adminmedicine/export', [PdfController::class, 'medicine_exportPdf'])->name('adminmedicine.medicine_export');

// Resource Routes
Route::resource('admins', AdminController::class);
Route::resource('adminarticle', AdminArticleController::class);
Route::resource('adminPatient', AdminPatientController::class);
Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('admindoctors', AdminDoctorController::class);
Route::resource('adminmedicine', AdminMedicineController::class);
Route::resource('doctordash', DoctorDashboardController::class);

// Schedule
Route::resource('schedules', ScheduleController::class)->names([
    'index' => 'adminschedules.index',
    'create' => 'adminschedules.create',
    'store' => 'adminschedules.store',
    'edit' => 'adminschedules.edit',
    'update' => 'adminschedules.update',
    'destroy' => 'adminschedules.destroy',
]);

?>