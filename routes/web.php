<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\AdminMedicineController;

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

// Medicine 
Route::get('/adminmedicine', [MedicineController::class, 'index'])->name('adminmedicine.index');

// Export
Route::get('/adminPatient/export', [PdfController::class, 'patient_exportPdf'])->name('adminPatient.patient_export');
Route::get('/admindoctors/export', [PdfController::class, 'doctor_exportPdf'])->name('admindoctors.doctor_export');
Route::get('/adminmedicine/export', [PdfController::class, 'medicine_exportPdf'])->name('adminmedicine.medicine_export');

// Resource Routes
Route::resource('admins', AdminController::class);
Route::resource('adminPatient', AdminPatientController::class);
Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('admindoctors', AdminDoctorController::class);
Route::resource('adminmedicine', AdminMedicineController::class);

?>