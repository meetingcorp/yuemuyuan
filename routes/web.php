<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/aboutus', function(){
    $aboutus = App\Models\Aboutus::first();
    return view('client.yuemu.aboutsu.index', compact('aboutus'));
});
Route::get('/news', function(){
    $news = App\Models\News::where([['publish', 1]])->orderBy('sort', 'asc')->skip(0)->take(40)->get();
    return view('client.yuemu.news.index', compact('news'));
});
Route::get('/news/{news}', function(App\Models\News $news){
    $rec = App\Models\News::where([['id', '!=', $news->id], ['publish', '=', 1]])->orderBy('sort', 'asc')->skip(0)->take(6)->get();
    return view('client.yuemu.news.show', compact('news', 'rec'));
})->name('client.news.show');

Route::get('/service', function(){
    $service = App\Models\Services::where('publish', 1)->orderBy('sort', 'asc')->skip(0)->take(40)->get();
    return view('client.yuemu.service.index', compact('service'));
});
Route::get('/service/{service}', function(App\Models\Services $service){
    $rec = App\Models\Services::where([['id', '!=', $service->id], ['publish', '=', 1]])->orderBy('sort', 'asc')->skip(0)->take(6)->get();
    return view('client.yuemu.service.show', compact('service', 'rec'));
})->name('client.service.show');

Route::get('/review', function(){
    $reviews = App\Models\Review::where([['publish', 1]])->orderBy('sort', 'asc')->skip(0)->take(40)->get();
    return view('client.yuemu.review.index', compact('reviews'));
});
Route::get('/article', function(){
    $articles = App\Models\Article::where([['publish', 1]])->orderBy('sort', 'asc')->skip(0)->take(40)->get();
    return view('client.yuemu.article.index', compact('articles'));
});
Route::get('/article/{article}', function(App\Models\Article $article){
    $rec = App\Models\Article::where([['id', '!=', $article->id], ['publish', '=', 1]])->orderBy('sort', 'asc')->skip(0)->take(6)->get();
    return view('client.yuemu.article.show', compact('article', 'rec'));
})->name('client.article.show');
Route::get('/articledetail', function(){
    return view('client.yuemu.article.detail');
});
Route::get('/newsdetail', function(){
    return view('client.yuemu.news.detail');
});
Route::get('/servicedetail', function(){
    return view('client.yuemu.service.detail');
});
Route::get('/contact', function(){
    return view('client.yuemu.contact.index');
});

// Route::get('/news', [HomeController::class, 'newsall'])->name('client.news.index');
// Route::get('/news/{news}', [HomeController::class, 'shownews'])->name('client.news.show');
// Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact.index');
// route::post('/mail', [HomeController::class, 'linenotify'])->name('client.noti');

// Auth::routes();
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginform']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

//admin only
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['is_admin']], function () {

        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');

        Route::group(['middleware' => ['can:managepermission']], function(){
            Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class);
        });

        Route::group(['middleware' => ['can:managerole']], function(){
            Route::resource('/role', App\Http\Controllers\Admin\RoleController::class);
        });

        Route::group(['middleware' => ['can:managewebsite']], function(){
            Route::resource('/setting', App\Http\Controllers\Admin\SettingController::class);
        });

        Route::group(['middleware' => ['can:manageuser']], function(){
            Route::resource('/users', App\Http\Controllers\Admin\UserController::class);
            Route::get('/users/publish/{id}', [App\Http\Controllers\Admin\UserController::class, 'publish']);
        });

        Route::group(['middleware' => ['can:managenews']], function(){
            Route::resource('/news', App\Http\Controllers\Admin\NewsController::class);
            Route::get('/news/publish/{id}', [App\Http\Controllers\Admin\NewsController::class, 'publish']);
            Route::get('/news/sort/{id}', [App\Http\Controllers\Admin\NewsController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:manageproduct']], function(){
            Route::resource('/product', App\Http\Controllers\Admin\ProductController::class)->except(['show']);
            Route::get('/product/publish/{id}', [App\Http\Controllers\Admin\ProductController::class, 'publish']);
            Route::get('/product/sort/{id}', [App\Http\Controllers\Admin\ProductController::class, 'sort']);
            Route::get('/product/getdata/{ProductCategory}', [App\Http\Controllers\Admin\ProductController::class, 'getdata']);

            Route::resource('/sub', App\Http\Controllers\Admin\SubcategoriesController::class);
            Route::get('/sub/publish/{id}', [App\Http\Controllers\Admin\SubcategoriesController::class, 'publish']);
            Route::get('/sub/sort/{id}', [App\Http\Controllers\Admin\SubcategoriesController::class, 'sort']);

            Route::resource('/category', App\Http\Controllers\Admin\ProductcateController::class);
            Route::get('/category/publish/{id}', [App\Http\Controllers\Admin\ProductcateController::class, 'publish']);
            Route::get('/category/sort/{id}', [App\Http\Controllers\Admin\ProductcateController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:managebanner']], function(){
            Route::resource('/banner', App\Http\Controllers\Admin\BannerController::class);
            Route::get('/banner/publish/{id}', [App\Http\Controllers\Admin\BannerController::class, 'publish']);
            Route::get('/banner/sort/{id}', [App\Http\Controllers\Admin\BannerController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:managereview']], function(){
            Route::resource('/review', App\Http\Controllers\Admin\ReviewController::class);
            Route::get('/review/publish/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'publish']);
            Route::get('/review/sort/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:manageservice']], function(){
            Route::resource('/service', App\Http\Controllers\Admin\ServiceController::class);
            Route::get('/service/publish/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'publish']);
            Route::get('/service/sort/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:managepromotion']], function(){
            Route::resource('/promotion', App\Http\Controllers\Admin\PromotionController::class);
            Route::get('/promotion/publish/{id}', [App\Http\Controllers\Admin\PromotionController::class, 'publish']);
            Route::get('/promotion/sort/{id}', [App\Http\Controllers\Admin\PromotionController::class, 'sort']);
        });

        Route::group(['middleware' => ['can:managearticle']], function(){
            Route::resource('/article', App\Http\Controllers\Admin\ArticleController::class);
            Route::get('/article/publish/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'publish']);
            Route::get('/article/sort/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'sort']);
        });


        Route::group(['middleware' => ['can:manageproject']], function(){
            Route::resource('/project', App\Http\Controllers\Admin\ProjectController::class)->except(['show']);
            Route::get('/project/publish/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'publish']);
            Route::get('/project/sort/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'sort']);
            Route::post('/project/uploadimage', [App\Http\Controllers\Admin\ProjectController::class, 'uploadimage'])->name('uploadimg');
            Route::post('/project/deleteimage', [App\Http\Controllers\Admin\ProjectController::class, 'deleteupload'])->name('delimg');
        });

        Route::group(['middleware' => ['can:managepdpa']], function(){
            Route::resource('/pdpa', App\Http\Controllers\Admin\PdpaController::class)->except(['show']);
            Route::get('/pdpa/publish/{id}', [App\Http\Controllers\Admin\PdpaController::class, 'publish']);
        });

        Route::group(['middleware' => ['can:manageinbox']], function(){
            Route::resource('/contact', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
        });

        Route::resource('/aboutus', App\Http\Controllers\Admin\AboutusController::class);

        Route::resource('/profile', App\Http\Controllers\Admin\ProfileController::class)->only(['show', 'update']);
        Route::post('/dropzone/upload', [App\Http\Controllers\Admin\DropzoneController::class, 'uploadimage'])->name('dropzone.upload');
        Route::post('/dropzone/delete', [App\Http\Controllers\Admin\DropzoneController::class, 'deleteupload'])->name('dropzone.delete');
    });
});
Route::get('/storage_link', function () {
    Artisan::call('storage:link');
});

// Route::get('/coo',function () {
//     Artisan::call('make:seeder UserTableSeeder');
// });

// Route::get('/dbseed',function () {
//     Artisan::call('db:seed');
// });
