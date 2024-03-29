<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentPostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
});
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/dich-vu', [HomeController::class, 'listService'])->name('list-service');
Route::get('/chi-tiet-dich-vu', [HomeController::class, 'detailService'])->name('detail-service');
Route::get('/gioi-thieu', [HomeController::class, 'introduce'])->name('introduce');
Route::get('/lien-he', [FeedbackController::class, 'feedbackForm'])->name('contact');
Route::post('/lien-he', [FeedbackController::class, 'sendFeedback']);

Route::get('/bai-viet', [PostController::class, 'getNewestBlog'])->name('blog');
Route::get('/bai-viet/{categoryPostId}-{categoryPostSlug}.html', [PostController::class, 'getCategoryBlog'])->name('blog-category');
Route::get('/bai-viet/{categoryPostId}-{categoryPostSlug}/{postId}-{postSlug}.html', [PostController::class, 'detailBlog'])->name('detail-blog');
Route::post('send-comment', [PostController::class, 'sendComment'])->name('send-comment');

Route::get('/booking', [HomeController::class, 'booking'])->name('booking')->middleware('checkStylist');
Route::get('/list-service', [HomeController::class, 'listService'])->name('listService');
Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'history'])->name('history');


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');
Route::get('/forget-password', [PasswordController::class, 'formForget'])->name('forgetPassword');
Route::post('/forget-password', [PasswordController::class, 'postForget']);
Route::get('/reset-password/{token}/{email}', [PasswordController::class, 'formReset'])->name('formReset');
Route::post('/reset-password', [PasswordController::class, 'saveReset']);
Route::get('/register', [CustomerController::class, 'registerForm'])->name('register');
Route::post('/register', [CustomerController::class, 'saveRegister']);
Route::get('/change-password', [PasswordController::class, 'formChange'])->name('changePassword');
Route::post('/change-password', [PasswordController::class, 'postChange']);

Route::middleware('checkLogin')->group(function () {
    Route::prefix('dashboard')->middleware('checkAdmin')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('index');
        Route::prefix('user-management')->name('user.')->group(function () {
            Route::get('list-user', [\App\Http\Controllers\UserController::class, 'getListUser'])->name('list');
            Route::middleware('checkAdmin')->group(function () {
                Route::get('edit-user/{userId}', [\App\Http\Controllers\UserController::class, 'editUser'])->name('edit');
                Route::post('edit-user/{userId}', [\App\Http\Controllers\UserController::class, 'postEditUser']);
                Route::get('delete-user/{userId}', [\App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete');
                Route::get('add-user', [\App\Http\Controllers\UserController::class, 'createUser'])->name('create');
                Route::post('add-user', [\App\Http\Controllers\UserController::class, 'postCreateUser']);
            });
        });

        Route::prefix('role-management')->name('role.')->group(function () {
            Route::get('list-role', [\App\Http\Controllers\RoleController::class, 'getListRole'])->name('list');
            Route::middleware('checkAdmin')->group(function () {
                Route::get('add-role', [\App\Http\Controllers\RoleController::class, 'addRole'])->name('create');
                Route::post('add-role', [\App\Http\Controllers\RoleController::class, 'postAddRole']);
            });
        });
        Route::prefix('feedback-management')->name('feedback.')->group(function () {
            Route::get('list-feedback', [\App\Http\Controllers\FeedbackController::class, 'getFeedback'])->name('index');
            Route::get('remove-feedback/{id}', [FeedbackController::class, 'remove'])->name('remove');
        });

        Route::prefix('discount-management')->name('discount.')->group(function () {
            Route::get('list-discount', [\App\Http\Controllers\DiscountController::class, 'getListDiscount'])->name('list');
            Route::get('add-discount', [\App\Http\Controllers\DiscountController::class, 'addDiscount'])->name('create');
            Route::post('add-discount', [\App\Http\Controllers\DiscountController::class, 'postAddDiscount']);
            Route::get('edit-discount/{discountId}', [\App\Http\Controllers\DiscountController::class, 'editDiscount'])->name('edit');
            Route::post('edit-discount/{discountId}', [\App\Http\Controllers\DiscountController::class, 'postEditDiscount']);
        });

        Route::prefix('booking-management')->name('booking.')->group(function () {
            Route::middleware('checkAdmin')->group(function () {
                Route::get('list-booking', [\App\Http\Controllers\BookingController::class, 'getAllBooking'])->name('list');
                Route::get('all-list-booking', [\App\Http\Controllers\BookingController::class, 'getBookingListAjax'])->name('getAllBooking');
                Route::post('update-booking', [\App\Http\Controllers\BookingController::class, 'updateStatus'])->name('updateBooking');
                Route::get('booking', [\App\Http\Controllers\BookingController::class, 'getListBooking'])->name('index');
                Route::post('update', [\App\Http\Controllers\BookingController::class, 'updateBooking'])->name('update');
            });
        });

        Route::prefix('category-post-management')->name('category-post.')->group(function () {
            Route::get('list-category-post', [\App\Http\Controllers\CategoryPostController::class, 'getListCategoryPost'])->name('list');
            Route::get('add-category-post', [\App\Http\Controllers\CategoryPostController::class, 'addCategoryPost'])->name('create');
            Route::post('add-category-post', [\App\Http\Controllers\CategoryPostController::class, 'postAddCategoryPost']);
            Route::get('edit-category-post/{categoryPostId}', [\App\Http\Controllers\CategoryPostController::class, 'editCategoryPost'])->name('edit');
            Route::post('edit-category-post/{categoryPostId}', [\App\Http\Controllers\CategoryPostController::class, 'postEditCategoryPost']);
        });

        Route::prefix('post-management')->name('post.')->group(function () {
            Route::get('list-post', [PostController::class, 'getListPost'])->name('list');
            Route::get('add-post', [PostController::class, 'addPost'])->name('create');
            Route::post('add-post', [PostController::class, 'postAddPost']);
            Route::get('edit-post/{postId}-{postSlug}', [PostController::class, 'editPost'])->name('edit');
            Route::post('edit-post/{postId}-{postSlug}', [PostController::class, 'postEditPost']);
        });

        Route::prefix('service')->name('service.')->group(function () {
            Route::get('/', [ServiceController::class, 'getService'])->name('index');
            Route::get('/add', [ServiceController::class, 'addForm'])->name('add');
            Route::post('/add', [ServiceController::class, 'saveAdd']);
            Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
        });

        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [StaffController::class, 'getService'])->name('index');
            Route::get('/add', [StaffController::class, 'addForm'])->name('add');
            Route::post('/add', [StaffController::class, 'saveAdd']);
            Route::get('/edit/{id}', [StaffController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [StaffController::class, 'saveEdit']);
            Route::get('/remove/{id}', [StaffController::class, 'remove'])->name('remove');
        });

        Route::prefix('comment-management')->name('comment.')->group(function () {
            Route::get('/list-comment', [CommentPostController::class, 'getListComment'])->name('list');
            Route::get('/edit-comment/{id}', [CommentPostController::class, 'commentForm'])->name('edit');
            Route::post('/edit-comment/{id}', [CommentPostController::class, 'saveEdit']);
            Route::get('/remove/{id}', [CommentPostController::class, 'remove'])->name('remove');
        });

        Route::prefix('statistic')->name('statistic.')->group(function () {
            Route::get('/', [\App\Http\Controllers\StatisticOtherController::class, 'statisticOther'])->name('index');
            Route::post('/statistic-by-stylist', [\App\Http\Controllers\StatisticOtherController::class, 'staticByStylist'])->name('staticByStylist');
            Route::post('/statistic-by-turnover', [\App\Http\Controllers\StatisticOtherController::class, 'staticTurnover'])->name('staticTurnover');

        });
    });

    Route::get('/profile', [UserController::class, 'myProfile'])->name('my-profile');
    Route::get('/change-information', [CustomerController::class, 'changeInformation'])->name('change-infomation');
    Route::post('/change-information', [CustomerController::class, 'saveChangeInformation']);
    Route::get('/change-information/change-password', [CustomerController::class, 'changePasswordForm'])->name('change-password');
    Route::post('/change-information/change-password', [CustomerController::class, 'saveNewPassword']);

    Route::prefix('rating')->name('rating.')->group(function () {
        Route::get('/{booking_id}', [RatingController::class, 'ratingStylist'])->name('rating');
        Route::post('/{booking_id}', [RatingController::class, 'saveRating']);
    });
});
Route::post('/booking', [HomeController::class, 'postBooking']);
Route::get('/bookingDate/{date}', [HomeController::class, 'bookingDate'])->name('bookingDate');
Route::get('/booking/success/{bookingID}', [HomeController::class, 'bookingSuccess'])->name('success');
Route::post('/check-discount', [HomeController::class, 'checkDiscountCode'])->name('checkDiscount');
Route::middleware('checkBooking')->group(function () {
    Route::get('/cart/{bookingId}', [HomeController::class, 'cart'])->name('cart');
    Route::post('/cart/{bookingId}', [HomeController::class, 'confirmBooking']);
    Route::get('/cancel/{bookingId}', [HomeController::class, 'cancelBooking'])->name('cancel');
    Route::get('/booking/edit/{bookingID}', [HomeController::class, 'editBooking'])->name('edit.booking');
    Route::post('/booking/edit/{bookingID}', [HomeController::class, 'saveEditBooking']);
});
Route::post('update-status-booking', [\App\Http\Controllers\HistoryController::class, 'updateBookingStatus'])->name('update-status-booking');
Route::get('getStatusBooking', [\App\Http\Controllers\BookingController::class, 'checkBooking'])->name('checkBooking');
Route::get('confirmPhoneNumber', [\App\Http\Controllers\VerifyPhoneNumberController::class, 'verifyPhone'])->name('verifyPhone');
