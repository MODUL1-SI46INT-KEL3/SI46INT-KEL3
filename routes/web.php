<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\AdminMedicineController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminMedicalRecordController;
use App\Http\Controllers\AdminPrescriptionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminSymptomController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DoctorReviewController;



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

// Patient Prescriptions
Route::get('/patients/prescriptions', [PrescriptionController::class, 'patientPrescriptions'])->name('patients.prescriptions')->middleware('auth');
Route::get('/patients/prescriptions/{prescription}/view', [PrescriptionController::class, 'patientPrescriptionView'])->name('patients.prescriptions.view')->middleware('auth');
Route::get('/patients/prescriptions/{prescription}/download', [PrescriptionController::class, 'patientPrescriptionDownload'])->name('patients.prescriptions.download')->middleware('auth');

// Doctor 
Route::get('/admindoctors', [MedicineController::class, 'index'])->name('admindoctors.index');
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/admindoctors/export', [PdfController::class, 'doctor_exportPdf'])->name('admindoctors.doctor_export');
Route::get('/admindoctors', [AdminDoctorController::class, 'index'])->name('admindoctors.index');

// Doctor Dashboard
Route::get('/doctordash/home', [DoctorDashboardController::class, 'home'])->name('doctordash.home');
Route::get('/doctordash', [DoctorDashboardController::class, 'index'])->name('doctordash.index');
Route::get('/doctordash/login', [AuthController::class, 'showDoctorLoginForm'])->name('doctordash.login.form');
Route::post('/doctordash/login', [AuthController::class, 'doctorLogin'])->name('doctordash.login');

//Appointments
Route::get('/appointments/book', [AppointmentController::class, 'startBooking'])->name('appointments.book');

Route::get('/appointments/step1', [AppointmentController::class, 'createStep1'])->name('appointments.step1_specialist');
Route::post('/appointments/step1', [AppointmentController::class, 'postStep1']);

Route::get('/appointments/step2', [AppointmentController::class, 'createStep2'])->name('appointments.step2_time');
Route::post('/appointments/step2', [AppointmentController::class, 'postStep2']);

Route::get('/appointments/step3', [AppointmentController::class, 'createStep3'])->name('appointments.step3_overview');
Route::post('/appointments/step3', [AppointmentController::class, 'postStep3']); 

Route::get('/appointments/step4', [AppointmentController::class, 'createStep4'])->name('appointments.step4_confirmation');

Route::get('/specializations/{id}/doctors', [DoctorController::class, 'getDoctorsBySpecialization']);

// Medical Records
Route::prefix('doctordash')->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records.index');
    Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('/medical-records/{patient}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('/medical-records/{record}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
    Route::put('/medical-records/{record}', [MedicalRecordController::class, 'update'])->name('medical-records.update');
    Route::delete('/medical-records/{record}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
    Route::get('/medical-records/{record}/download', [MedicalRecordController::class, 'downloadFile'])->name('medical-records.download');
    Route::get('/medical-records/{record}/print', [MedicalRecordController::class, 'printReport'])->name('medical-records.print');
});

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

Route::prefix('doctordash')->name('doctor.')->middleware(['auth'])->group(function () {
    Route::get('/reviews', [DoctorReviewController::class, 'index'])->name('reviews.index');
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
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Symptoms
Route::get('/symptoms', [SymptomController::class, 'index'])->name('symptoms.index');
Route::post('/symptoms/recommend', [SymptomController::class, 'recommend'])->name('symptoms.recommend');

// Export
Route::get('/adminPatient/export', [PdfController::class, 'patient_exportPdf'])->name('adminPatient.patient_export');
Route::get('/adminAppointment/export', [PdfController::class, 'appointments_exportPdf'])->name('adminPatient.appointment_export');
Route::get('/admindoctors/export', [PdfController::class, 'doctor_exportPdf'])->name('admindoctors.doctor_export');
Route::get('/adminmedicine/export', [PdfController::class, 'medicine_exportPdf'])->name('adminmedicine.medicine_export');
Route::get('/adminMedicalRecord/export', [PdfController::class, 'medicalRecord_exportPdf'])->name('adminMedicalRecord.export');
Route::get('/adminPrescription/export', [PdfController::class, 'prescription_exportPdf'])->name('adminPrescription.export');
Route::get('/adminsymptoms/export', [PdfController::class, 'symptom_exportPdf'])->name('adminsymptoms.symptom_export');

//Admin Appointments
Route::prefix('adminAppointment')->name('adminAppointment.')->group(function () {
    Route::get('/', [AdminAppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AdminAppointmentController::class, 'create'])->name('create');
    Route::post('/', [AdminAppointmentController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminAppointmentController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminAppointmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminAppointmentController::class, 'destroy'])->name('destroy');
});


// Admin Medical Records
Route::get('/adminMedicalRecord', [AdminMedicalRecordController::class, 'index'])->name('adminMedicalRecord.index');
Route::get('/adminMedicalRecord/{patient}', [AdminMedicalRecordController::class, 'show'])->name('adminMedicalRecord.show');
Route::get('/adminMedicalRecord/{record}/view', [AdminMedicalRecordController::class, 'view'])->name('adminMedicalRecord.view');
Route::get('/adminMedicalRecord/{record}/download', [AdminMedicalRecordController::class, 'downloadFile'])->name('adminMedicalRecord.download');
Route::get('/adminMedicalRecord/{record}/print', [AdminMedicalRecordController::class, 'printReport'])->name('adminMedicalRecord.print');

// Admin Prescriptions
Route::get('/adminPrescription', [AdminPrescriptionController::class, 'index'])->name('adminPrescription.index');
Route::get('/adminPrescription/{patient}', [AdminPrescriptionController::class, 'show'])->name('adminPrescription.show');
Route::get('/adminPrescription/{prescription}/view', [AdminPrescriptionController::class, 'view'])->name('adminPrescription.view');
Route::get('/adminPrescription/{prescription}/download', [AdminPrescriptionController::class, 'downloadFile'])->name('adminPrescription.download');
Route::get('/adminPrescription/{prescription}/print', [AdminPrescriptionController::class, 'printReport'])->name('adminPrescription.print');

// Resource Routes
Route::resource('admins', AdminController::class);
Route::resource('adminarticle', AdminArticleController::class);
Route::resource('adminPatient', AdminPatientController::class);
Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('admindoctors', AdminDoctorController::class);
Route::resource('adminmedicine', AdminMedicineController::class);
Route::resource('doctordash', DoctorDashboardController::class);
Route::resource('adminsymptoms', AdminSymptomController::class);
Route::resource('symptoms', SymptomController::class);
Route::resource('medicines', MedicineController::class);


// Feedback & Review Routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



// Optional category-specific routes if you want dropdown redirection working:
Route::get('/reviews/website', [ReviewController::class, 'index'])->name('reviews.website');
Route::get('/reviews/appointment', [ReviewController::class, 'index'])->name('reviews.appointment');
Route::get('/reviews/shop', [ReviewController::class, 'index'])->name('reviews.shop');


Route::prefix('adminreviews')->name('adminreviews.')->group(function () {
    Route::get('/', [AdminReviewController::class, 'index'])->name('index');
    Route::get('/{id}', [AdminReviewController::class, 'show'])->name('show');
    Route::delete('/{id}', [AdminReviewController::class, 'destroy'])->name('destroy');
    Route::patch('/send/{id}', [AdminReviewController::class, 'markAsSent'])->name('markSent');
    Route::patch('/retract/{id}', [AdminReviewController::class, 'markAsUnsent'])->name('markUnsent');
});




// Schedule
Route::resource('schedules', ScheduleController::class)->names([
    'index' => 'adminschedules.index',
    'create' => 'adminschedules.create',
    'store' => 'adminschedules.store',
    'edit' => 'adminschedules.edit',
    'update' => 'adminschedules.update',
    'destroy' => 'adminschedules.destroy',
]);
Route::get('schedules/export/pdf', [ScheduleController::class, 'export'])->name('adminschedules.export');


// Payments
use App\Http\Controllers\PaymentController;

Route::resource('adminpayments', paymentController::class)->names([
    'index' => 'adminpayments.index',
    'create' => 'adminpayments.create',
    'store' => 'adminpayments.store',
    'edit' => 'adminpayments.edit',
    'update' => 'adminpayments.update',
    'destroy' => 'adminpayments.destroy',
]);


Route::get('/specializations/{id}/doctors', [AppointmentController::class, 'getDoctorsBySpecialization']);

//cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{medicine}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

});
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::post('/cart/{id}/toggle-select', [CartController::class, 'toggleSelect'])->name('cart.toggleSelect');
Route::patch('/cart-items/{id}/toggle-selected', [CartItemController::class, 'toggleSelected'])
    ->name('cart-items.toggle-selected');


//Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::get('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
});


?>