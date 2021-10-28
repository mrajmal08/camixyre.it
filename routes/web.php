<?php

use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin'], function(){

    // Admin Auth Routes
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::view('login', 'admin.auth.login')->name('admin.login');
        Route::post('login', 'AdminController@login')->name('admin.auth');
    });

    // Admin Routes
    Route::group(['middleware' => 'admin.auth'], function(){

        // Dashboard Routes
        Route::get('/', 'AdminController@dashboard');
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.home');

        // Profile Routes
        Route::resource('author', 'ProfileController');

        // Abandoned Cart Routes
        Route::resource('abandoned-cart', 'AbandonedCartController');

        // Order Routes
        Route::resource('order', 'OrdersController');

        // Invoice Routes
        Route::resource('invoice', 'InvoiceController');
        Route::get('generate-pdf/{orderNumber}', 'InvoiceController@generatePdf')->name('generate.pdf');

        // Review Routes
        Route::resource('review', 'ReviewController');

        // Ecommerce Routes
        Route::resource('product', 'ProductController');
        Route::resource('category', 'CategoryController');

        // Page Routes
        Route::resource('page', 'PageController');

        // Blog Routes
        Route::resource('post', 'PostController');

        // User Routes
        Route::resource('user', 'UserController');

        // User Routes
        Route::resource('newsletter', 'NewsletterController');

        // Setting Route
        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('settings/update', 'SettingsController@update')->name('settings.update');

        // Paypal Setting Routes
        Route::get('payments/paypal', 'PaypalController@index')->name('paypal');
        Route::put('payments/paypal/update', 'PaypalController@update')->name('paypal.update');

        // Bank Transfer Setting Routes
        Route::get('payments/bank-transfer', 'BankTransferController@index')->name('bank-transfer');
        Route::put('payments/bank-transfer/update', 'BankTransferController@update')->name('bank-transfer.update');

        // Logout Route
        Route::post('logout', 'AdminController@logout')->name('admin.logout');

        // Media Routes
        Route::get('media', [App\Http\Controllers\MediaController::class, 'media']);
        Route::post('get-media', [App\Http\Controllers\MediaController::class, 'getMedia'])->name('media.get');
        Route::post('upload-media', [App\Http\Controllers\MediaController::class, 'uploadMedia'])->name('media.upload');
        Route::get('media/destroy/{image}', [App\Http\Controllers\MediaController::class, 'destroy']);
        
    });
    
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Old URL Redirections
Route::redirect('/it/product/tagliere-da-cucina-gordon-spianatoia-per-impastare-made-in-italy', '/it/product/oneclod-variante-del-piano-di-lavoro-della-cucina-in-acciaio-inossidabile-con-angolo-curvo');
Route::redirect('/it/product/tagliere-da-cucina-carlo-spianatoia-per-impastare-made-in-italy', '/it/product/oneclod-tagliere-in-acciaio-inossidabile');
Route::redirect('/it/product/tagliere-da-cucina-carlo-big-spianatoia-per-impastare-made-in-italy', '/it/product/oneclod-tagliere-in-acciaio-inossidabile');
Route::redirect('/en/product/stainless-steel-pressure-cooker-5l-extra-lid-in-temperd-glass-oneclod', '/en/product/oneclod-stainless-steel-cutting-board');
Route::redirect('/it/product/tagliere-da-cucina-gualtiero-spianatoia-per-impastare-angolo-curvo-made-in-italy', '/it/product/oneclod-variante-del-piano-di-lavoro-della-cucina-in-acciaio-inossidabile-con-angolo-curvo');
Route::redirect('/it/product/tagliere-da-cucina-antonino-spianatoia-per-impastare-acciaio-inox-made-in-italy', '/it/product/oneclod-tagliere-in-acciaio-inox-per-impastare-dolci-pizza-pane');
Route::redirect('/it/product/tagliere-da-cucina-80x60-cm-antonino-spianatoia-per-impastare-made-in-italy', '/it/product/oneclod-tagliere-in-acciaio-inox-per-impastare-dolci-pizza-pane');
Route::redirect('/en/product/kitchen-board-antonino-junior-pastry-board-satin-stainless-steel-worktop-for-kneading', '/en/product/oneclod-stainless-steel-chopping-board-for-kneading-pizza-bread-sweets');
Route::redirect('/en/product/kitchen-board-antonino-big-pastry-board-satin-stainless-steel-worktop-for-kneading', '/en/product/oneclod-stainless-steel-chopping-board-for-kneading-pizza-bread-sweets');
Route::redirect('/it/product/pentola-a-pressione-in-acciaio-inossidabile-5l-coperchio-extra-in-vetro-e-ricettario-oneclod', '/it/product/pentola-a-pressione-oneclod-floria-acciaio-inossidabile-5l');
Route::redirect('/en/product/gualtiero-juinior-stainless-steel-kitchen-worktop-for-kneading-the-cutting-board-with-oneclod-non-slip-mat', '/en/product/oneclod-stainless-steel-kitchen-worktop-variation-with-curved-corner');
Route::redirect('/it/product/tagliere-da-cucina-48-x-43-cm-antonino-spianatoia-per-impastare-made-in-italy', '/it/product/oneclod-tagliere-in-acciaio-inox-per-impastare-dolci-pizza-pane');
Route::redirect('/en/product/worktop-kitchen-carlo-junior-worktop-satin-stainless-steel-kitchen-cutting-board-for-kneading-pizza-bread-sweets-with-anti-slip-mat-', '/en/product/oneclod-stainless-steel-cutting-board');
Route::redirect('/en/product/kitchen-worktop-with-edges-cutting-board-brushed-stainless-steel-serving-board-for-kneading-model-gordon-with-anti-slip-mat-tray', '/en/shop');
Route::redirect('/en/product/worktop-kitchen-carlo-worktop-satin-stainless-steel-kitchen-cutting-board-for-kneading-pizza-bread-sweets-with-anti-slip-mat', '/en/product/oneclod-stainless-steel-cutting-board');
Route::redirect('/en/product/kitchen-worktop-stainless-steel-variation-with-curved-corner-board-50x47x01-and-2-cm-of-curved-angle-for-kneading-cutting-board-with-anti-slip-mat', '/en/product/oneclod-stainless-steel-kitchen-worktop-variation-with-curved-corner');
Route::redirect('/en/product/oneclod-table-cutlery-set-for-6-people-in-stainless-steel-24-pieces-6-forks-6-spoons-6-knives-6-tea-spoons-the-cutlery-are-dishwasher-safe-model-leonardo-gold', '/en/product/polished-stainless-steel-cutlery-set-for-6-people');
Route::redirect('/it/product/oneclod-set-di-posate-da-tavola-per-6-persone-in-acciaio-inox-24-pezzi-6-forchette-6-cucchiai-6-coltelli-6-cucchiaini-da-t-le-posate-sono-lavabili-in-lavastoviglie-modello-leonardo-gold', '/it/product/servizio-di-posate-in-acciaio-inox-lucido-per-6-persone');
Route::redirect('/it/product/oneclod-set-di-posate-da-tavola-per-6-persone-in-acciaio-inox-24-pezzi-6-forchette-6-cucchiai-6-coltelli-6-cucchiaini-da-t-le-posate-sono-lavabili-in-lavastoviglie-modello-leonardo-black', '/it/product/servizio-di-posate-in-acciaio-inox-lucido-per-6-persone');

// Default Languages List
$languageList = 'en|it|fr|es|de';

// Redirect To Default Language
if($position = Location::get()):
    $countryName = $position->countryName;
    $countryCode = strtolower($position->countryCode);
    switch($countryCode):
        case "it":
            Route::redirect('/', 'it');
            break;
        case "fr":
            Route::redirect('/', 'fr');
            break;
        case "es":
            Route::redirect('/', 'es');
            break;
        case "de":
            Route::redirect('/', 'de');
            break;
        default:
            Route::redirect('/', 'en');
    endswitch;
else:
    Route::redirect('/', 'en');
endif;

// Web Routes
Route::group(['prefix' => '/{language}/', 'where' => ['language' => $languageList]], function(){

    // Home Routes
    Route::get('/', [App\Http\Controllers\WebControllers\HomeController::class, 'index'])->name('/');
    Route::get('/home', [App\Http\Controllers\WebControllers\HomeController::class, 'index'])->name('homepage');

    // User Dashboard Routes
    Route::get('/dashboard/profile', [App\Http\Controllers\WebControllers\UserDashboardController::class, 'profile'])->name('profile');
    Route::post('update-profile', [App\Http\Controllers\WebControllers\UserDashboardController::class, 'update'])->name('profile.update');
    Route::post('change-password', [App\Http\Controllers\WebControllers\UserDashboardController::class, 'change'])->name('change.password');
    Route::get('/dashboard/orders', [App\Http\Controllers\WebControllers\UserDashboardController::class, 'orders'])->name('orders');
    Route::get('/dashboard/order/{orderNumber}', [App\Http\Controllers\WebControllers\UserDashboardController::class, 'viewOrder'])->name('orders.view');

    // Auth Routes
    Route::get('/login', [App\Http\Controllers\WebControllers\HomeController::class, 'login'])->name('login.page');
    Route::get('/register', [App\Http\Controllers\WebControllers\HomeController::class, 'register'])->name('register.page');
    Route::get('/logout', [App\Http\Controllers\WebControllers\HomeController::class, 'logout'])->name('logout.user');
    Route::get('/reset', [App\Http\Controllers\WebControllers\HomeController::class, 'reset'])->name('password.reset');
    
    // Products Routes
    Route::get('/shop', [App\Http\Controllers\WebControllers\ProductController::class, 'index'])->name('shop');
    Route::get('/product/{slug}', [App\Http\Controllers\WebControllers\ProductController::class, 'show'])->name('product');
    Route::post('submit-review', [App\Http\Controllers\WebControllers\ProductController::class, 'submitReview'])->name('submit-review');
    
    // Blog Routes
    Route::get('/blog', [App\Http\Controllers\WebControllers\PostController::class, 'index'])->name('blog');
    Route::get('/post/{slug}', [App\Http\Controllers\WebControllers\PostController::class, 'show'])->name('post');

    // Dynamic Pages Route
    Route::get('/page/{slug}', [App\Http\Controllers\WebControllers\PageController::class, 'index'])->name('page');

    // Wishlist Routes
    Route::get('/wishlist', [App\Http\Controllers\WebControllers\WishlistController::class, 'index'])->name('wishlist');
    Route::get('/add-to-wishlist/{id}', [App\Http\Controllers\WebControllers\WishlistController::class, 'store'])->name('wishlist.add');
    Route::get('/destroy-wishlist/{id}', [App\Http\Controllers\WebControllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
    
    // Cart Routes
    Route::get('cart', [App\Http\Controllers\WebControllers\CartController::class, 'index'])->name('cart');
    Route::post('add-to-cart', [App\Http\Controllers\WebControllers\CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update', [App\Http\Controllers\WebControllers\CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/delete/{id}', [App\Http\Controllers\WebControllers\CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout Routes
    Route::get('/checkout', [App\Http\Controllers\WebControllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/fulfill/order', [App\Http\Controllers\WebControllers\CheckoutController::class, 'fulfillOrder'])->name('checkout.fulfill.order');
    Route::post('/checkout/paylater/order', [App\Http\Controllers\WebControllers\CheckoutController::class, 'paylaterOrder'])->name('checkout.paylater.order');
    Route::post('/checkout/validate', [App\Http\Controllers\WebControllers\CheckoutController::class, 'prePaymentValidation'])->name('checkout.validate');

    // PayPal Routes
    Route::post('/payment/createOrderPayPal', [App\Http\Controllers\PaypalController::class, 'createOrderPayPal']);
    Route::post('/payment/captureOrderPayPal/{orderId}', [App\Http\Controllers\PaypalController::class, 'captureOrderPayPal']);

    // Payment Successful Route
    Route::get('/checkout/success/thank-you/{orderId}', [App\Http\Controllers\WebControllers\CheckoutController::class, 'showThanks'])->name('thanks');

    // Send Email Route
    Route::post('send-email', [App\Http\Controllers\WebControllers\CheckoutController::class, 'sendEmail'])->name('order.submit.email');

    // Subscribe Newsletter Route
    Route::post('/subscribe', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.add');

    // Search Products Route
    Route::post('/search', [App\Http\Controllers\WebControllers\HomeController::class, 'search'])->name('search.products');

    // Generate PDF Route
    Route::get('/generate-pdf/{orderNumber}', 'InvoiceController@generatePdf')->name('user.generate.pdf');

    // 404 For Undefined Routes
    Route::any('/{page?}/{slug?}', [App\Http\Controllers\WebControllers\HomeController::class, 'error'])->where('page','.*')->name('404');
    
});

/*
|--------------------------------------------------------------------------
| Other Routes
|--------------------------------------------------------------------------
*/

// Clear Website Cache
Route::get('/clear-cache', function(){
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
