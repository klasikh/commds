<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Request_typeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mat_transfertController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\MaterialsCategoryController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Login', [
//         'canLogin' => Route::has('login'),
//         'isLogged' => Route::has('dashboard'),
//         // 'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'logged'])->name('dashboard');


Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    // Route::resource('admins', AdminController::class)->parameters(['admins' => 'user'])->only(['index', 'update']);

    Route::resource('admins', AdminController::class)->parameters(['admins' => 'user'])->except(['create', 'show', 'edit']);
    // Route::get('requests/show', [RequestController::class, 'show'])->parameters(['requests' => 'request']);

    Route::resource('users', UserController::class)->parameters(['users' => 'user']);

    Route::resource('departments', DepartmentController::class)->except(['create', 'edit']);

    Route::resource('services', ServiceController::class)->except(['create', 'show', 'edit']);

    Route::resource('grades', GradeController::class)->except(['create', 'show', 'edit']);

    Route::resource('permissions', PermissionController::class)->except(['create', 'show', 'edit']);

    Route::resource('roles', RoleController::class)->except(['create', 'show', 'edit']);

    Route::resource('request_types', Request_typeController::class)->except(['create', 'show', 'edit']);

    Route::resource('memos', MemoController::class)->except(['create', 'show', 'edit']);

});



//Route::prefix('user')->name('user.')->middleware(['auth:sanctum', 'verified'])->group(function () {
//   Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
//

 //   Route::prefix('users')->name('permissions.')->group( function () {
 //       Route::get('/', [PermissionController::class, 'index'])->name('index');
  //      Route::post('/', [PermissionController::class, 'store'])->name('store');
  //      Route::patch('/{permission}', [PermissionController::class, 'update'])->name('update');
  //      Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
  //  });
// });


Route::prefix('user')->name('user.')->middleware(['auth:sanctum', 'verified', 'role:user|super-admin|admin'])->group(function () {
  Route::get('dashboard', [UserUserController::class, 'index'])->name('dashboard.index');

  Route::resource('requests', RequestController::class)->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer|user'])->parameters(['requests' => 'request']);
 
  Route::resource('mat_transferts', Mat_transfertController::class)->parameters(['mat_transferts' => 'mat_transfert']);

  Route::resource('users', UserController::class);

  Route::resource('departments', DepartmentController::class)->except(['create', 'show', 'edit']);

  // Route::resource('materials', MaterialsController::class)->parameters(['materials_lists' => 'material']);

  Route::resource('matscat', MaterialsCategoryController::class)->parameters(['materials_categories' => 'materials_category']);

  // Route::resource('signs', SignController::class)->except(['create', 'show', 'edit']);

});

// ROUTES FOR MATERIALS LISTS

Route::get('/user/materials', [MaterialsController::class, 'index'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.index');

Route::get('/user/materials/create', [MaterialsController::class, 'create'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.create');

Route::post('/user/materials/store', [MaterialsController::class, 'store'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.store');

Route::patch('/user/materials/update', [MaterialsController::class, 'update'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.update');

Route::post('/user/materials/addMat', [MaterialsController::class, 'addMat'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.addMat');

Route::patch('/user/materials/updateMat', [MaterialsController::class, 'updateMat'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.updateMat');

// Route::post('/user/materials/delete', [MaterialsController::class, 'destroy'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.destroy');

Route::post('/user/materials/delete/{id}', [MaterialsController::class, 'deleteMat'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.deleteMat');


// END ROUTES FOR MATERIALS

// ROUTES FOR CATEGORIES MATERIAL

Route::get('/user/materials/categories', [MaterialsCategoryController::class, 'index'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.categories');

Route::post('/user/matscat/deleteMatCat/{id}', [MaterialsCategoryController::class, 'deleteMatCat'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.matscat.deleteMatCat');

// Route::post('/user/matscat/destroy', [MaterialsCategoryController::class, 'destroy'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.matscat.destroy');

// Route::post('/user/materials/addCat', [MaterialsCategoryController::class, 'store'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.matscat.store');

// Route::patch('/user/materials/UpCat/{id}', [MaterialsCategoryController::class, 'update'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.matscat.update');

// Route::post('/user/materials/DelCat/{id}', [MaterialsCategoryController::class, 'delete'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.matscat.delete');

// END ROUTES FOR CATEGORIES MATERIAL

// ROUTES FOR MANAGEMENT MATERIAL
Route::get('/user/materials/manage', [MaterialsController::class, 'manage'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.manage');

Route::post('/user/materials/dropMat/{id}', [MaterialsController::class, 'dropMat'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|user'])->name('user.materials.dropMat');

Route::post('signature/', [SignController::class, 'addSign'])->name('user.signatures.addSign');
Route::post('/signs', [SignController::class, 'addSign'])->name('sign');
Route::post('sign', [SignController::class, 'insert_image']);

Route::get('books', [SignController::class, 'signe']);   
Route::get('store_image/fetch_imag/{id}', [SignController::class, 'fetch_image']);
Route::post('store_image/delete/{id}', [SignController::class, 'destroy']);
Route::post('posts', [SignController::class, 'index'])->name('posts');

Route::get('messages', [MessageController::class, 'index'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer|user'])->name('messages');

Route::get('messages/chat', [MessageController::class, 'chat'])->name('messages.chat')->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer|user']);

Route::post('messages/chat{}', [MessageController::class, 'store'])->name('messages.store')->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer|user']);

// Route::get('messages/searchUsers', [MessageController::class, 'searchUsers'])->middleware(['auth:sanctum', 'verified', 'role:super-admin|admin|moderator|developer|user']);


Route::get('requests/notsent', [RequestController::class, 'notsent'])->name('user.requests.notsent')->middleware(['auth:sanctum', 'verified', 'role:user']);

Route::get('requests/sent', [RequestController::class, 'sent'])->name('user.requests.sent')->middleware(['auth:sanctum', 'verified', 'role:user']);

Route::get('requests/finalized', [RequestController::class, 'finalized'])->name('user.requests.finalized')->middleware(['auth:sanctum', 'verified', 'role:user']);

Route::get('requests/delete', [RequestController::class, 'delete'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.delete');

Route::post('requests/sendRequest', [RequestController::class, 'sendRequest'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.sendRequest');

Route::get('requests/received', [RequestController::class, 'received'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.received');

Route::get('requests/onProcess', [RequestController::class, 'onProcess'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.onProcess');

Route::post('requests/sendAgain', [RequestController::class, 'sendAgain'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.sendAgain');

Route::get('requests/traited', [RequestController::class, 'traited'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.traited');

Route::post('requests/approve', [RequestController::class, 'approve'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.approve');

Route::post('requests/transRequest', [RequestController::class, 'transRequest'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.transRequest');

Route::post('requests/sendBackupTo', [RequestController::class, 'sendBackupTo'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.sendBackupTo');

Route::post('requests/reject', [RequestController::class, 'reject'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.reject');

Route::post('requests/undo', [RequestController::class, 'undo'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.undo');

Route::get('requests/backup', [RequestController::class, 'backup'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.request.backup');

// Route::get('requests/makeDelivery', [RequestController::class, 'makeDelivery'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.makeDelivery');

Route::post('/mat_transferts/createDeliv', [Mat_transfertController::class, 'createDeliv'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('mat_transferts.createDeliv');
Route::post('/signature', [SignController::class, 'store'])->name('user.sign.store');

Route::get('/mat_transferts/show/{id}', [Mat_transfertController::class, 'show'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.mat_transferts.show');

Route::get('/mat_transferts/edit', [Mat_transfertController::class, 'edit'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.mat_transferts.edit');

Route::post('/mat_transferts/update', [Mat_transfertController::class, 'update'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.mat_transferts.update');

Route::post('/mat_transferts/destroy', [Mat_transfertController::class, 'destroy'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.mat_transferts.destroy');

Route::post('/requests/commandAdd', [RequestController::class, 'addCommandN'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.addCommandN');

// Route::post('requests/addDeliv', [RequestController::class, 'addDeliv'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.requests.addDeliv');

// Route::get('messages/getMessages', [MessageController::class, 'getMessages'])->middleware(['auth:sanctum', 'verified', 'role:user'])->name('user.messages.getMessages');



// Route::middleware(['auth:sanctum', 'verified'])->get('/mails', [TestController::class, 'bar'])->name('messages');

// Route::resource(['auth:sanctum', 'verified'])->get('/mails', [MessageController::class, 'index'])->name('messages.index');
