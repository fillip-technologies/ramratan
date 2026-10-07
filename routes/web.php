<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormDataController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManegeBVController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderCancelController;
use App\Http\Controllers\PriceSettingController;

use App\Http\Controllers\WishListController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;







Route::get('admin/login', [AdminController::class, 'login_admin']);
Route::post('login/admin', [AdminController::class, 'admin_login'])->name('login.admin');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::get('/', [HomeController::class, 'homePage']);
Route::get('login', [HomeController::class, 'loginPage'])->name('login');
Route::get('register', [HomeController::class, 'registerPage'])->name('register');
Route::get('product-details/{slug}', [HomeController::class, 'productDescriptionPage'])->name('product_details');
Route::get('wishlist', [HomeController::class, 'wishlistPage'])->name('wishlist');
Route::get('cart', [HomeController::class, 'cartPage'])->name('cart');
// Route::get('checkout', [HomeController::class, 'checkoutPage'])->name('checkout');
Route::get('thankyou', [HomeController::class, 'thankyou'])->name('thankyou');
Route::get('view-product', [HomeController::class, 'viewProductPage'])->name('view-product');
Route::get('account-overview', [HomeController::class, 'accountOverviewPage'])->name('account-overview');
Route::get('about', [HomeController::class, 'aboutPage'])->name('about');
Route::get('aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('recipes', [HomeController::class, 'recipes'])->name('recipes');
Route::get('contactus', [HomeController::class, 'contactus'])->name('contactus');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('buy/now', [HomeController::class, 'BuyNow'])->name('buy.now');
Route::get('thankyou', [HomeController::class, 'thankyou'])->name('thankyou');
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::post('/login/user', [HomeController::class, 'login_user'])->name('user.login');
Route::get('/logout/user', [HomeController::class, 'logout'])->name('user.logout');
Route::post('save/aaddess', [HomeController::class, 'add_address'])->name('add.address');
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [HomeController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/delete/{id}', [HomeController::class, 'delete'])->name('cart.delete');
Route::post('/add/promo_code', [HomeController::class, 'applyCoupon'])->name('apply.promo');
Route::post('order/confirm', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('search', [HomeController::class, 'searchproduct'])->name('product.search');
Route::post('/filter-products', [ProductController::class, 'filterProducts'])->name('filter.products');
Route::get('/product/video/delete/{id}', [ProductController::class, 'deleteVideo'])
    ->name('product.video.delete');
Route::get('category', [ProductController::class, 'show_cate'])->name('category');
Route::delete('category/delete/{id}', [ProductController::class, 'category_delete'])->name('category.delete');
Route::get('category/edit/{id}', [ProductController::class, 'category_edit'])->name('category.edit');
Route::post('category/update/{id}', [ProductController::class, 'category_update'])->name('category.update');
Route::get('list/category', [ProductController::class, 'category_list'])->name('category.listing');
Route::post('add/product/category', [ProductController::class, 'category_add'])->name('admin.categories.store');
Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('products/store', [ProductController::class, 'store'])->name('admin.product.store');
Route::post('products/update/{id}', [ProductController::class, 'product_update'])->name('admin.product.update');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('poducts.listing');
Route::get('/products/add', [ProductController::class, 'create'])->name('admin.venue.add');
Route::get('product/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
Route::delete('product/delete/{id}', [ProductController::class, 'delete_product'])->name('product.delete');
Route::get('/venue/{id}/edit', [VenueController::class, 'edit'])->name('admin.venue.edit');
Route::put('/venue/{id}', [VenueController::class, 'update'])->name('admin.update');
Route::delete('/venue/{id}', [VenueController::class, 'destroy'])->name('admin.venue.destroy');
Route::get('/vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
Route::post('/vendors/add', [VendorController::class, 'store'])->name('admin.vendors.store');
Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit');
Route::put('/vendors/{vendors}', [VendorController::class, 'update'])->name('admin.vendors.update');
Route::get('/vendorsRegistration', [FormDataController::class, 'indexVendors'])->name('admin.vendorsreg.index');
Route::get('/contacts', [FormDataController::class, 'indexContacts'])->name('admin.contacts.index');
Route::get('/meetings', [FormDataController::class, 'indexMeetings'])->name('admin.meetings.index');
Route::get('/list/users', [ProductController::class, 'listUsers']);
Route::get('/list/order', [ProductController::class, 'listOrder']);
Route::get('offer', [ProductController::class, 'offer']);
Route::get('offer/list', [ProductController::class, 'offer_list'])->name('cupon.list');
Route::get('sub/product/data/{id}',[HomeController::class,'subcatepro'])->name('sub.product.data');
Route::post('add/offer', [HomeController::class, 'addOffer'])->name('admin.coupons.store');
Route::get('users/get-message',[MessageController::class, 'getadminmsg'])->name('getmessage');
Route::post('admin/store/message',[MessageController::class, 'adminStoreMsg'])->name('admin.store.message');

Route::get('/users', function () {
    return 'This is the admin users list';
})->name('users');


Route::get('/settings', function () {
    return 'Admin settings page';
})->name('settings');

Route::get('shipping', [ShippingController::class, 'index']);
Route::delete('shipping/{id}', [ShippingController::class, 'shipping_delete'])->name('delete_shipping');
Route::post('add/shipping', [ShippingController::class, 'shipping_store'])->name('admin.shipping.store');
Route::get('shipping/list', [ShippingController::class, 'Shipping_list']);
Route::post('shipping/update/{id}', [ShippingController::class, 'update_shipping'])->name('shipping.update');
Route::get('edit/shipoing/{id}', [ShippingController::class, 'shiping_edit'])->name('shipping.edit');
Route::get('/subcat', [ProductController::class, 'subcategory']);
Route::post('add/subcategory', [ProductController::class, 'addSubCate'])->name('add.subcate');
Route::get('list/subcate', [ProductController::class, 'list_subcategory']);
Route::delete('subcate_delete/{id}', [ProductController::class, 'subcate_delete'])->name('delete.subcate');
Route::get('edir_subCate/{id}', [ProductController::class, 'edit_subCate'])->name('edit.subcate');
Route::put('update_subCate/{id}', [ProductController::class, 'update_subCate'])->name('update.subcate');
Route::get('price/create', [PriceSettingController::class, 'price_index']);
Route::post('price/store', [PriceSettingController::class, 'price_store'])->name('price.store');
Route::get('price/list', [PriceSettingController::class, 'price_list'])->name('price.lists');
Route::put('price/update/{id}', [PriceSettingController::class, 'price_update'])->name('price.update');
Route::delete('price/delete/{id}', [PriceSettingController::class, 'price_delete'])->name('price.delete');
Route::get('prices/edit/{id}', [PriceSettingController::class, 'price_edit'])->name('price.edit');
Route::get('create-your-design', [PriceSettingController::class, 'designPage'])->name('design.create');
Route::post('add/customise/form',[PriceSettingController::class, 'customization_form'])->name('add.Customization');
Route::get('custom/list',[PriceSettingController::class, 'custom_list'])->name('custom.list');
Route::get('gold-rates', [PriceSettingController::class, 'goldRates'])->name('gold.rates');
Route::get('calculate',[PriceSettingController::class, 'calculate'])->name('calculate.price');
Route::get('search/category',[HomeController::class, 'search_category'])->name('search.category');
Route::post('store/wish',[WishListController::class, 'store_wishlist'])->name('store.wishlist');
Route::delete('/wishlist/remove', [WishListController::class, 'remove'])->name('wishlist.remove');
Route::get('forget-pass',[HomeController::class, 'forgetpassword_email'])->name('forget.password');
Route::get('get_forgetpass',[HomeController::class,'get_forget'])->name('get.forget.pass');
Route::post('reset/password',[HomeController::class, 'resetPassword'])->name('reset.password');
Route::put('/admin/orders/{id}', [HomeController::class, 'paymentupdate'])->name('admin.orders.update');

Route::get('banner/index',[ManegeBVController::class,'index'])->name('banner.video');
Route::get('banner/list',[ManegeBVController::class,'list'])->name('banner.list');
Route::post('add/banner/video',[ManegeBVController::class,'store'])->name('banner.video.store');
Route::get('banner/video/{id}',[ManegeBVController::class,'edit'])->name('banner.video.edit');
Route::post('update/banner/video/{id}',[ManegeBVController::class,'update'])->name('banner.video.update');
Route::delete('delete/banner/{id}',[ManegeBVController::class,'delete'])->name('banner.delete');
Route::get("product/search",[HomeController::class, 'product_search'])->name('search.product');

    Route::get('/remove-image/{id}/{key}', [ManegeBVController::class, 'removeImage'])->name('banner.removeImage');
    Route::get('/remove-multi-video/{id}/{key}', [ManegeBVController::class, 'removeMultiVideo'])->name('banner.removeMultiVideo');
    Route::get('/remove-single-video/{id}', [ManegeBVController::class, 'removeSingleVideo'])->name('banner.removeSingleVideo');
    Route::get('/remove-gallery-video/{id}', [ManegeBVController::class, 'removeGalleryVideo'])->name('banner.removeGalleryVideo');
Route::post('store/message',[MessageController::class, 'UerssendMessage'])->name('store.message');
Route::get('/get-messages/{order_id}', [MessageController::class, 'getMessages'])->name('get.messages');


