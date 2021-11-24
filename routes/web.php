<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\AccessController;
use App\Http\Controllers\System\AnnouncementController;
use App\Http\Controllers\System\Admin\AnnouncementController as AdminAnnouncement;
use App\Http\Controllers\System\Admin\UserController as AdminUser;
use App\Http\Controllers\System\SiteController;
use App\Http\Controllers\System\DashboardController;
use App\Http\Controllers\System\UserController;

Route::get('/', [SiteController::class, 'index']);
Route::get('/login', [AccessController::class, 'login'])->name('login');
Route::post('/loginAction',[AccessController::class, 'loginAction'])->name('login.action');

Route::middleware(['checked','active'])->prefix('/system')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout',[AccessController::class, 'logout'])->name('logout');
    Route::get('/announcementViews',[AnnouncementController::class, 'index'])->name('announcement.index');
    Route::get('/announcementView/{id}',[AnnouncementController::class, 'show'])->name('announcement.show');
    Route::post('/announcementCreate',[AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('/myVacancies',[AnnouncementController::class, 'myVacancies'])->name('announcement.my.vacancies');
    Route::delete('/destroy',[AnnouncementController::class, 'destroy'])->name('announcement.destroy');
    Route::get('/',[UserController::class, 'index'])->name('user.index');
    Route::put('/update',[UserController::class, 'update'])->name('user.update');
});

//ROTAS DO SISTEM A PARA USUÁRIOS ATIVOS, LOGADAS ATIVOS E COM PERFIL DE ACESSO ADMIN
Route::middleware(['checked', 'active', 'admin'])->prefix('/system/adm')->group(function () {
    Route::get('/announcementViews',[AdminAnnouncement::class, 'index'])->name('announcement.adm.index');
    Route::get('/announcementCreate',[AdminAnnouncement::class, 'create'])->name('announcement.adm.create');
    Route::post('/announcementStore',[AdminAnnouncement::class, 'store'])->name('announcement.adm.store');
    Route::get('/announcement/{id}',[AdminAnnouncement::class, 'edit'])->name('announcement.adm.edit');
    Route::put('/announcement',[AdminAnnouncement::class, 'update'])->name('announcement.adm.update');
    Route::delete('/announcement/{id}',[AdminAnnouncement::class, 'destroy'])->name('announcement.adm.delete');
    Route::delete('/destroyAnnouncementAll',[AdminAnnouncement::class, 'deleteForAll'])->name('announcement.adm.delete.all');
    Route::get('/userIndex',[AdminUser::class, 'index'])->name('user.adm.index');
    Route::get('/userCreate',[AdminUser::class, 'create'])->name('user.adm.create');
    Route::post('/userStore',[AdminUser::class, 'store'])->name('user.adm.store');
    Route::get('/userEdit/{id}',[AdminUser::class, 'edit'])->name('user.adm.edit');
    Route::put('/userUpdate',[AdminUser::class, 'update'])->name('user.adm.update');
    Route::delete('/destroy/{id}',[AdminUser::class, 'destroy'])->name('user.adm.delete');
    Route::delete('/destroyUserAll',[AdminUser::class, 'deleteForAll'])->name('user.adm.delete.all');
});
