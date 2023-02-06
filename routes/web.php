<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'index'])->name('index');
Route::get('/student-register', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'displayStudentRegistration'])->name('student-register');
Route::get('/lecturer-register', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'displayLecturerRegistration'])->name('lecturer-register');

Route::post('/student-register', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'processStudentRegistration'])->name('student-register-process');
Route::post('/lecturer-register', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'processLecturerRegistration'])->name('lecturer-register-process');


Route::get('/clear-cache', function () {
    Artisan::call('package:discover');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    // Artisan::call('clear:complied');
    return "Cache is cleared ... Check again";
});

Route::get('/bbb-conf', function () {
    dd(\Bigbluebutton::isConnect()); //default
})->name('bbb-conf');

Route::get('/bims/login', [\App\Http\Controllers\Auth\BimsController::class, 'login'])->name('bims.login');
Route::get('dashboard/class/{id}/end-lecture/{lectureId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processEndOnlineLecture'])->name('dashboard.class.end-lecture');
Route::get('dashboard/class/{id}/record-lecture/{lectureId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processRecordingOnlineLecture'])->name('dashboard.class.record-lecture');


Route::middleware(['auth', 'isDisabled'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'displayProfile'])->name('profile');
    Route::post('/profile-update', [App\Http\Controllers\ProfileController::class, 'processProfileUpdate'])->name('profile-update');

    Route::get('faq', [App\Http\Controllers\FAQController::class, 'showFAQ'])->name('faq');
    Route::get('help', [App\Http\Controllers\FAQController::class, 'showHelp'])->name('help');

    Route::get('dashboard/class/{id}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'index'])->name('dashboard.class');
    Route::get('dashboard/class/attendance/{course_class_id}/{class_material_id}',[App\Http\Controllers\Dashboard\ClassDashboardController::class, 'printAttendanceList'])->name('print.attendance');

    Route::get('dashboard/class/{id}/start-lecture/{lectureId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processStartOnlineLecture'])->name('dashboard.class.start-lecture');
    Route::get('dashboard/class/{id}/join-lecture/{lectureId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processJoinOnlineLecture'])->name('dashboard.class.join-lecture');
    Route::post('dashboard/class/{course_class_id}/{lectureId}/save-details', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processStudentAttendanceDetails'])->name('dashboard.class.save-details');

    Route::get('dashboard/class/submitted-assignment/{courseClassId}/view/{classMaterialId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'listOfSubmittedAssignment'])->name('submitted-assignment-list');

    Route::get('dashboard/class/responded-feedbacks/{courseClassId}/view/{courseClassFeedbackId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'listOfRespondedFeebacks'])->name('responded-feedback-list');

    Route::get('dashboard/class/submission/{classMaterialId}/student/{studentId}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'getStudentSubmission'])->name('student.submission');
   
    Route::get('dashboard/archieves', [App\Http\Controllers\Dashboard\ArchieveController::class, 'index'])->name('dashboard.archieves');

    Route::post('/attachment', [App\Http\Controllers\AttachmentController::class,"uploadFile"])->name('attachment-upload');
    
    Route::middleware('isStudent')->group(function () {
        Route::get('dashboard/student', [App\Http\Controllers\Dashboard\StudentDashboardController::class, 'index'])->name('dashboard.student');
        Route::post('/mark-as-read', [App\Http\Controllers\Dashboard\StudentDashboardController::class, 'markNotification'])->name('mark.notification');

    });

    Route::middleware('isManager')->group(function () {
        Route::get('dashboard/manager', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'index'])->name('dashboard.manager');
        Route::get('dashboard/manager/announcements', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayAnnouncements'])->name('dashboard.manager.announcements');
        Route::get('dashboard/manager/levels', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayLevels'])->name('dashboard.manager.levels');
        Route::get('dashboard/manager/calendars', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayDepartmentCalendar'])->name('dashboard.manager.calendars');
        Route::get('dashboard/manager/classes', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayClassSchedules'])->name('dashboard.manager.classes');
        Route::get('dashboard/manager/courses', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayCourseCatalog'])->name('dashboard.manager.courses');
        Route::get('dashboard/manager/lecturers', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayDepartmentLecturers'])->name('dashboard.manager.lecturers');
        Route::get('dashboard/manager/students', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayDepartmentStudents'])->name('dashboard.manager.students');
        Route::get('dashboard/manager/student/{id}', [App\Http\Controllers\Dashboard\ManagerDashboardController::class, 'displayDepartmentStudentPage'])->name('dashboard.manager.student-page');
    });

    Route::middleware('isLecturer')->group(function () {
        Route::get('dashboard/lecturer', [App\Http\Controllers\Dashboard\LecturerDashboardController::class, 'index'])->name('dashboard.lecturer');
        Route::post('dashboard/grade-update/{id}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processGradeUpdate'])->name('dashboard.lecturer.grade-update');
        Route::post('dashboard/save-comment', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processLecturerComment'])->name('dashboard.lecturer.save-comment');
        Route::get('dashboard/grade-export/{id}', [App\Http\Controllers\Dashboard\ClassDashboardController::class, 'processGradeExport'])->name('dashboard.lecturer.grade-export');
        
    });

    Route::middleware('isAdmin')->group(function () {
        Route::get('dashboard/admin', [App\Http\Controllers\Dashboard\AdminDashboardController::class, 'index'])->name('dashboard.admin');
       
        Route::get('dashboard/users', [App\Http\Controllers\ACL\ACLController::class, 'displayUserAccounts'])->name('dashboard.users');
        Route::get('dashboard/user/{id}', [App\Http\Controllers\ACL\ACLController::class, 'getUser'])->name('dashboard.user');
        Route::post('dashboard/user/{id}', [App\Http\Controllers\ACL\ACLController::class, 'updateUserAccount'])->name('dashboard.user-update');
        Route::post('dashboard/user-enable/{id}', [App\Http\Controllers\ACL\ACLController::class, 'enableUserAccount'])->name('dashboard.user-enable-account');
        Route::post('dashboard/user-disable/{id}', [App\Http\Controllers\ACL\ACLController::class, 'disableUserAccount'])->name('dashboard.user-disable-account');
        Route::post('dashboard/user-delete/{id}', [App\Http\Controllers\ACL\ACLController::class, 'deleteUserAccount'])->name('dashboard.user-delete-account');
        Route::post('dashboard/user-reset/{id}', [App\Http\Controllers\ACL\ACLController::class, 'resetPwdUserAccount'])->name('dashboard.user-pwd-reset');
        Route::get('dashboard/admin/settings', [App\Http\Controllers\Dashboard\AdminDashboardController::class, 'displayApplicationSettings'])->name('dashboard.admin-settings');
        Route::post('dashboard/admin/settings', [App\Http\Controllers\Dashboard\AdminDashboardController::class, 'processApplicationSettings'])->name('dashboard.admin-settings-process');
        Route::get('dashboard/admin/delete-settings/{key}', [App\Http\Controllers\Dashboard\AdminDashboardController::class, 'deleteApplicationSettings'])->name('dashboard.admin-delete-setting');
        Route::resource('levels', App\Http\Controllers\LevelController::class);
        Route::get('semesters/getallsemesters', [App\Http\Controllers\SemesterController::class, 'getAllSemesters'])->name('semesters.getallsemesters');
        Route::put('semesters/setcurrentsemester', [App\Http\Controllers\SemesterController::class, 'setCurrentSemester'])->name('semesters.setcurrentsemester');
        Route::get('semesters/tabs/{id}', [App\Http\Controllers\SemesterController::class, 'show'])->name('semesters.tabs.show');
        Route::resource('semesters', App\Http\Controllers\SemesterController::class);
        Route::resource('departments', App\Http\Controllers\DepartmentController::class);
        Route::resource('faculties', App\Http\Controllers\FacultyController::class);
        Route::get('faculty/{id}/departments', [App\Http\Controllers\DepartmentController::class,'facultyDepts'])->name('faculty.departments');
        Route::resource('faqs', App\Http\Controllers\FAQController::class);
        Route::resource('notifications', App\Http\Controllers\BroadcastNotificationController::class, ['except' => ['index', 'show']]);

        // Route::prefix('api')->group(function () {
        //     Route::resource('faqs', App\Http\Controllers\API\FAQAPIController::class);
        // });
    });

    
    Route::resource('announcements', App\Http\Controllers\AnnouncementController::class);

    Route::get('lectnStudAnnouncements', [App\Http\Controllers\AnnouncementController::class, 'lectnStudAnnouncements'])->name('lect-stud.announcements');

    Route::resource('courses', App\Http\Controllers\CourseController::class);

    Route::resource('courseClasses', App\Http\Controllers\CourseClassController::class);

    Route::resource('courseClassFeedbacks', App\Http\Controllers\CourseClassFeedbackController::class);

    Route::resource('courseClassFeedbackResponses', App\Http\Controllers\CourseClassFeedbackResponseController::class);

    Route::put('dashboard/classMaterials/{id}/outline', [App\Http\Controllers\CourseClassController::class, 'updateCourseClassOutline'])->name('dashboard.course-class-outline');
    Route::get('notifications/', [App\Http\Controllers\BroadcastNotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{id}', [App\Http\Controllers\BroadcastNotificationController::class, 'show'])->name('notifications.show');

    Route::resource('classMaterials', App\Http\Controllers\ClassMaterialController::class);

    Route::resource('grades', App\Http\Controllers\GradeController::class);

    Route::resource('studentClassActivity', App\Http\Controllers\StudentClassActivityController::class);

    Route::resource('calendarEntries', App\Http\Controllers\CalendarEntryController::class);

    Route::resource('lecturers', App\Http\Controllers\LecturerController::class);

    Route::resource('managers', App\Http\Controllers\ManagerController::class);

    Route::resource('students', App\Http\Controllers\StudentController::class);

    Route::resource('submissions', App\Http\Controllers\SubmissionController::class);

    Route::resource('enrollments', App\Http\Controllers\EnrollmentController::class);

    Route::resource('forums', App\Http\Controllers\ForumController::class);

    Route::resource('settings', App\Http\Controllers\SettingController::class);
    
});

Auth::routes();