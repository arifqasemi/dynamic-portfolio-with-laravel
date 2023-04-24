<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Home\Slider;
use App\Http\Controllers\Home\aboutController;
use App\Http\Controllers\Home\portfolioController;
use App\Http\Controllers\contactsControllerPage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin profile route
Route::middleware(['Auth'])->group(function () {
   

Route::get('/admin/logout', [adminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [adminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/Editprofile', [adminController::class, 'Editprofile'])->name('profile.edit');
Route::post('/admin/Editeprofile', [adminController::class, 'StoreProfile'])->name('store.profile');

Route::get('/change/password', [adminController::class, 'ChangePassword'])->name('change.password');
 Route::post('/update/password', [adminController::class, 'UpdatePassword'])->name('update.password');

});
// Home slider route
Route::get('/Home/slider', [Slider::class, 'HomeSliderMethod'])->name('home.slide');
Route::post('/update/slider', [Slider::class, 'UpdateSlider'])->name('update.slider');
Route::get('/', [Slider::class, 'HomeFrontend'])->name('Home');

//about  route
Route::get('/about/page', [aboutController::class, 'aboutPage'])->name('about.page');
Route::post('/update/about', [aboutController::class, 'updateAbout'])->name('update.about');
Route::get('/about', [aboutController::class, 'about'])->name('about');
Route::get('/about/multi/image', [aboutController::class, 'AboutMultiImage'])->name('about.multiImage');
Route::post('/store/multimage', [aboutController::class, 'StoreMultiImage'])->name('store.multimage');
Route::get('/all/multi/image', [aboutController::class, 'AllMultiImage'])->name('about.allmultiImage');
Route::get('/edit/multi/image/{id}', [aboutController::class, 'EditMultiImage'])->name('edit.multi.image');
Route::post('/update/multi/image', [aboutController::class, 'UpdateMultiImage'])->name('update.multi.image');
Route::get('/delete/multi/image/{id}', [aboutController::class, 'DeleteMultiImage'])->name('delete.multi.image');





 // Porfolio All Route 
 Route::controller(portfolioController::class)->group(function () {
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->name('store.protfolio');
    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.protfolio');
    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
    Route::get('/portfolio/details/{id}', 'PortfolioDetails')->name('portfolio.details');
    Route::get('/portfolio', 'HomePortfolio')->name('home.portfolio');



    
 // Contact All Route 
Route::controller(contactsControllerPage::class)->group(function () {
    Route::get('/contact', 'Contact')->name('contact.me');
    Route::post('/store/message', 'StoreMessage')->name('store.message');   
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');   
    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');  
    Route::get('/portfolio/details/{id}', 'PortfolioDetails')->name('portfolio.details');


});
});
require __DIR__.'/auth.php';
