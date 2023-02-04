<?php

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
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.layout2');
});




Auth::routes();



Route::middleware(['auth'])->group(function () {

    Route::get('/pagi', [App\Http\Controllers\HomeController::class, 'paginateChecking'])->name('paginate');
    Route::get('/get', [App\Http\Controllers\HomeController::class, 'getdata'])->name('get');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/salesPdf', [App\Http\Controllers\PDFController::class, 'generateSalesPDF'])->name('salesPdf');
    Route::get('/pdf_header', [App\Http\Controllers\PDFController::class, 'pdfHeader'])->name('pdf_header');
    Route::get('/invoice_maker', [App\Http\Controllers\InvoiceController::class, 'invoiceMaker'])->name('invoice');
    Route::get('/invoice_view', [App\Http\Controllers\InvoiceController::class, 'invoiceView'])->name('invoice_view');
    Route::get('/get_invoice_view', [App\Http\Controllers\InvoiceController::class, 'getInvoiceView'])->name('get_invoice_view');

    Route::get('/all_employe_data', [App\Http\Controllers\EmployeController::class, 'getAllEmployeData'])->name('all_employe_data');

    //********************************sales*************************

    Route::get('/add_seles_form', [App\Http\Controllers\SelesController::class, 'addSelesForm'])->name('add_seles_form');
    Route::get('/delete_add_seles_item', [App\Http\Controllers\SelesController::class, 'deleteAddSelesItem'])->name('delete_add_seles_item');
    Route::get('/get_purchase_limite', [App\Http\Controllers\SelesController::class, 'purchaseLimite'])->name('get_purchase_limite');
    Route::post('/add_seles', [App\Http\Controllers\SelesController::class, 'addSeles'])->name('add_seles');
    Route::get('/seles_list', [App\Http\Controllers\SelesController::class, 'salesList'])->name('seles_list');
    Route::get('/get_sales_list_table', [App\Http\Controllers\SelesController::class, 'getSalesLListTable'])->name('get_sales_list_table');
    Route::post('/add_seles_to_cart', [App\Http\Controllers\SelesController::class, 'addSeleToCart'])->name('add_seles_to_cart');
    Route::get('/add_sales_for_employe', [App\Http\Controllers\SelesController::class, 'addSalesPageForEmploye'])->name('add_sales_for_employe');
    Route::get('/add_sales_for_customer', [App\Http\Controllers\SelesController::class, 'addSalesPageForCustomer'])->name('add_sales_for_customer');
    Route::get('/get_customer_purchase_history', [App\Http\Controllers\SelesController::class, 'getCustomerPurchaseHistory'])->name('get_customer_purchase_history');
    Route::post('/add_customer_seles_to_cart', [App\Http\Controllers\SelesController::class, 'addCustomerSelesToCart'])->name('add_customer_seles_to_cart');
    Route::get('/add_customer_seles_form', [App\Http\Controllers\SelesController::class, 'addCustomerSelesForm'])->name('add_customer_seles_form');
    Route::get('/delete_customer_add_seles_item', [App\Http\Controllers\SelesController::class, 'deleteCustomerAddSelesItem'])->name('delete_customer_add_seles_item');
    Route::post('/add_customer_seles', [App\Http\Controllers\SelesController::class, 'addCustomerSeles'])->name('add_customer_seles');
    //*************************************************** */

    Route::get('/get_product_details_by_id', [App\Http\Controllers\ProductController::class, 'getProductDetailsById'])->name('get_product_details_by_id');

    Route::get('/get_product_avable_quantity', [App\Http\Controllers\ProductController::class, 'getProductAvableQuantity'])->name('get_product_avable_quantity');
    Route::get('/get_product_avable_quantity_to_shift', [App\Http\Controllers\ProductController::class, 'getProductAvableQuantityToShift'])->name('get_product_avable_quantity_to_shift');
    Route::get('/product_in_stock', [App\Http\Controllers\ProductController::class, 'productInStock'])->name('product_in_stock');
    Route::get('/shift_product', [App\Http\Controllers\ProductController::class, 'shiftProduct'])->name('shift_product');
    Route::post('/add_shift_to_cart', [App\Http\Controllers\ProductController::class, 'addShiftToCart'])->name('add_shift_to_cart');
    Route::get('/add_shift_form', [App\Http\Controllers\ProductController::class, 'addShiftForm'])->name('add_shift_form');
    Route::get('/delete_add_shift_item', [App\Http\Controllers\ProductController::class, 'deleteAddShiftItem'])->name('delete_add_shift_item');
    Route::post('/add_to_shift', [App\Http\Controllers\ProductController::class, 'addToShift'])->name('add_to_shift');
    Route::get('/shift_request_page', [App\Http\Controllers\ProductController::class, 'shiftrequestPage'])->name('shift_request_page');
    Route::get('/pending_product', [App\Http\Controllers\ProductController::class, 'pendingProduct'])->name('pending_product');
    Route::get('/get_pending_product', [App\Http\Controllers\ProductController::class, 'getPendingProduct'])->name('get_pending_product');
    Route::get('/cancel_pending_product', [App\Http\Controllers\ProductController::class, 'cancelSendedShiftingRequest'])->name('cancel_pending_product');
    Route::get('/shifting_request', [App\Http\Controllers\ProductController::class, 'shiftingRequest'])->name('shifting_request');
    Route::get('/accept_shift_request', [App\Http\Controllers\ProductController::class, 'acceptShiftRequest'])->name('accept_shift_request');
    Route::get('/cancel_shift_request', [App\Http\Controllers\ProductController::class, 'cancelShiftRequest'])->name('cancel_shift_request');

    Route::get('/due_adjustment', [App\Http\Controllers\AccountController::class, 'dueAdjustment'])->name('due_adjustment');
    Route::get('/collect_payment/{type}/{id}', [App\Http\Controllers\AccountController::class, 'collectPayment'])->name('collect_payment');
    Route::post('/paied_due', [App\Http\Controllers\AccountController::class, 'paiedDue'])->name('paied_due');
    Route::get('/payment_history', [App\Http\Controllers\AccountController::class, 'paymentHistory'])->name('payment_history');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/profile-view', [App\Http\Controllers\UserController::class, 'profile1'])->name('profile1');
    Route::post('/match_password', [App\Http\Controllers\UserController::class, 'matchPassword'])->name('match_password');
    Route::post('/update_user_info', [App\Http\Controllers\UserController::class, 'updateUserInfo'])->name('update_user_info');
});


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/add_outlet_view', [App\Http\Controllers\OutletController::class, 'addOutletView'])->name('add_outlet_view');
    Route::post('/make_outlet', [App\Http\Controllers\OutletController::class, 'makeOutlet'])->name('make_outlet');
    Route::get('/outlet_list', [App\Http\Controllers\OutletController::class, 'outletList'])->name('outlet_list');
    Route::post('/update_outlet', [App\Http\Controllers\OutletController::class, 'updateOutlet'])->name('update_outlet');
    Route::post('/delete_outlet', [App\Http\Controllers\OutletController::class, 'deleteOutlet'])->name('delete_outlet');

    Route::get('/add_user_view', [App\Http\Controllers\UserController::class, 'addUserView'])->name('add_user_view');
    Route::post('/add_user.html', [App\Http\Controllers\UserController::class, 'addUser'])->name('add_user');
    Route::get('/user_list', [App\Http\Controllers\UserController::class, 'userList'])->name('user_list');
    Route::post('/update_user', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update_user');

    Route::get('/add_employe_view', [App\Http\Controllers\EmployeController::class, 'addEmpoyeView'])->name('add_employe_view');
    Route::post('/add_employe', [App\Http\Controllers\EmployeController::class, 'addEmpoye'])->name('add_employe');
    Route::get('/employe_list', [App\Http\Controllers\EmployeController::class, 'employeList'])->name('employe_list');
    Route::post('/update_employe', [App\Http\Controllers\EmployeController::class, 'updateEmploye'])->name('update_employe');
    Route::post('/delete_employe', [App\Http\Controllers\EmployeController::class, 'deleteEmploye'])->name('delete_employe');

    Route::get('/add_purchase_view', [App\Http\Controllers\PurchaseController::class, 'addPurchaseView'])->name('add_purchase_view');
    Route::post('/add_purchase', [App\Http\Controllers\PurchaseController::class, 'addPurchase'])->name('add_purchase');
    Route::get('/purchase_list', [App\Http\Controllers\PurchaseController::class, 'purchaseList'])->name('purchase_list');
    Route::post('/update_puschase', [App\Http\Controllers\PurchaseController::class, 'updatePuschase'])->name('update_puschase');
    Route::post('/delete_puschase', [App\Http\Controllers\PurchaseController::class, 'deletePuschase'])->name('delete_puschase');

    Route::get('/add_product_view', [App\Http\Controllers\ProductController::class, 'addProductView'])->name('add_product_view');
    Route::post('/add_product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('add_product');
    Route::get('/product_list', [App\Http\Controllers\ProductController::class, 'productList'])->name('product_list');
    Route::post('/update_product', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('update_product');
    Route::get('/get_outlet_product_list', [App\Http\Controllers\ProductController::class, 'getOutletProductList'])->name('get_outlet_product_list');

    Route::get('/add_expense_view', [App\Http\Controllers\ExpenseController::class, 'addExpenseView'])->name('add_expense_view');
    Route::post('/add_expense', [App\Http\Controllers\ExpenseController::class, 'addExpense'])->name('add_expense');
    Route::get('/expense_list', [App\Http\Controllers\ExpenseController::class, 'expenseList'])->name('expense_list');
    Route::post('/update_expense', [App\Http\Controllers\ExpenseController::class, 'updateExpense'])->name('update_expense');

    Route::get('/add_customer_view', [App\Http\Controllers\CustomerController::class, 'addCustomerView'])->name('add_customer_view');
    Route::post('/add_coustomer', [App\Http\Controllers\CustomerController::class, 'addCustomer'])->name('add_coustomer');
    Route::get('/customer_list', [App\Http\Controllers\CustomerController::class, 'customerList'])->name('customer_list');
    Route::post('/update_customer', [App\Http\Controllers\CustomerController::class, 'updateCustomer'])->name('update_customer');
    Route::get('/all_customer_data', [App\Http\Controllers\CustomerController::class, 'getAllCustomerData'])->name('all_customer_data');
    Route::post('/delete_customer', [App\Http\Controllers\CustomerController::class, 'deleteCustomer'])->name('delete_customer');


    Route::get('/download_expense_list_pdf', [App\Http\Controllers\PDFController::class, 'downloadExpensePdf'])->name('download_expense_list_pdf');
    Route::get('/download_purchase_list_pdf', [App\Http\Controllers\PDFController::class, 'downloadPurchasePdf'])->name('download_purchase_list_pdf');
});

// Route::fallback(function(){
//     about('404');
// });



// .select2-container .select2-selection--single *//
