<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CartController;


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



route::view('/','auth/login')->name('login')->middleware('guest');
route::view('dashboard','dashboard/dashboard')->name('dashboard')->middleware('auth');

route::post('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Empleados
route::get('/add-employee',[EmployeeController::class, 'index'])->name('add.employee')->middleware('auth');
route::post('/insert-employee',[EmployeeController::class, 'store']);
route::get('/all-employee',[EmployeeController::class, 'allemployees'])->name('all.employee')->middleware('auth');
route::get('/view-employee/{id}',[EmployeeController::class, 'viewemployee'])->middleware('auth');
route::get('/delete-employee/{id}',[EmployeeController::class, 'deleteemployee'])->middleware('auth');
route::get('/edit-employee/{id}',[EmployeeController::class, 'editemployee'])->middleware('auth');
route::post('/update-employee/{id}',[EmployeeController::class, 'updateemployee']);

// Clientes
route::get('/add-customer',[CustomerController::class, 'index'])->name('add.customer')->middleware('auth');
route::post('/insert-customer',[CustomerController::class, 'store']);
route::get('/all-customer',[CustomerController::class, 'allcustomer'])->name('all.customer')->middleware('auth');
route::get('/view-customer/{id}',[CustomerController::class, 'viewcustomer'])->middleware('auth');
route::get('/delete-customer/{id}',[CustomerController::class, 'deletecustomer'])->middleware('auth');
route::get('/edit-customer/{id}',[CustomerController::class, 'editcustomer'])->middleware('auth');
route::post('/update-customer/{id}',[CustomerController::class, 'updatecustomer']);

// Proveedores
route::get('/add-supplier',[SupplierController::class, 'index'])->name('add.supplier')->middleware('auth');
route::post('/insert-supplier',[SupplierController::class, 'store']);
route::get('/all-supplier',[SupplierController::class, 'allsupplier'])->name('all.supplier')->middleware('auth');
route::get('/view-supplier/{id}',[SupplierController::class, 'viewsupplier'])->middleware('auth');
route::get('/delete-supplier/{id}',[SupplierController::class, 'deletesupplier'])->middleware('auth');
route::get('/edit-supplier/{id}',[SupplierController::class, 'editsupplier'])->middleware('auth');
route::post('/update-supplier/{id}',[SupplierController::class, 'updatesupplier']);

// Salarios
route::get('/add-salary',[SalaryController::class, 'index'])->name('add.salary')->middleware('auth');
route::post('/insert-salary',[SalaryController::class, 'store']);
route::get('/all-salary',[SalaryController::class, 'allsalary'])->name('all.salary')->middleware('auth');
route::get('/edit-salary/{id}',[SalaryController::class, 'editsalary'])->middleware('auth');
route::post('/update-salary/{id}',[SalaryController::class, 'updatesalary']);
route::get('/delete-salary/{id}',[SalaryController::class, 'deletesalary'])->middleware('auth');
route::get('/view-salary/{id}',[SalaryController::class, 'viewsalary'])->middleware('auth');


// Categorias
route::get('/add-category',[CategoryController::class, 'index'])->name('add.category')->middleware('auth');
route::post('/insert-category',[CategoryController::class, 'store']);
route::get('/all-category',[CategoryController::class, 'allcategory'])->name('all.category')->middleware('auth');
route::get('/delete-category/{id}',[CategoryController::class, 'deletecategory'])->middleware('auth');
route::get('/edit-category/{id}',[CategoryController::class, 'editcategory'])->middleware('auth');
route::post('/update-category/{id}',[CategoryController::class, 'updatecategory']);

// Productos
route::get('/add-product',[ProductController::class, 'index'])->name('add.product')->middleware('auth');
route::post('/insert-product',[ProductController::class, 'store']);
route::get('/all-product',[ProductController::class, 'allproduct'])->name('all.product')->middleware('auth');
route::get('/delete-product/{id}',[ProductController::class, 'deleteproduct'])->middleware('auth');
route::get('/edit-product/{id}',[ProductController::class, 'editproduct'])->middleware('auth');
route::post('/update-product/{id}',[ProductController::class, 'updateproduct']);
route::get('/view-product/{id}',[ProductController::class, 'viewproduct'])->middleware('auth');



// Gastos
route::get('/add-expense',[ExpenseController::class, 'index'])->name('add.expense')->middleware('auth');
route::post('/insert-expense',[ExpenseController::class, 'store']);
route::get('/today-expense',[ExpenseController::class, 'todayexpense'])->name('today.expense')->middleware('auth');
route::get('/edit-totday-expense/{id}',[ExpenseController::class, 'edittodayexpense'])->middleware('auth');
route::post('/update-expense/{id}',[ExpenseController::class, 'updateTodayExpense']);
route::get('/delete-totday-expense/{id}',[ExpenseController::class, 'deleteTodayExpense'])->middleware('auth');
route::get('/monthly-expense',[ExpenseController::class, 'monthlyexpense'])->name('monthly.expense')->middleware('auth');
route::get('/january-expense',[ExpenseController::class, 'januaryexpense'])->name('january.expense')->middleware('auth');
route::get('/febreary-expense',[ExpenseController::class, 'febrearyexpense'])->name('febreary.expense')->middleware('auth');
route::get('/march-expense',[ExpenseController::class, 'marchexpense'])->name('march.expense')->middleware('auth');
route::get('/april-expense',[ExpenseController::class, 'aprilexpense'])->name('april.expense')->middleware('auth');
route::get('/may-expense',[ExpenseController::class, 'mayexpense'])->name('may.expense')->middleware('auth');
route::get('/june-expense',[ExpenseController::class, 'juneexpense'])->name('june.expense')->middleware('auth');
route::get('/july-expense',[ExpenseController::class, 'julyexpense'])->name('july.expense')->middleware('auth');
route::get('/august-expense',[ExpenseController::class, 'augustexpense'])->name('august.expense')->middleware('auth');
route::get('/septembre-expense',[ExpenseController::class, 'septembreexpense'])->name('septembre.expense')->middleware('auth');
route::get('/october-expense',[ExpenseController::class, 'octoberexpense'])->name('october.expense')->middleware('auth');
route::get('/november-expense',[ExpenseController::class, 'novemberexpense'])->name('november.expense')->middleware('auth');
route::get('/december-expense',[ExpenseController::class, 'decemberexpense'])->name('december.expense')->middleware('auth');


// Asistencias
route::get('/take-attendence',[AttendenceController::class, 'takeattendence'])->name('take.attendence')->middleware('auth');
route::post('/insert-attendence',[AttendenceController::class, 'insertattendence']);
route::get('/all-attendence',[AttendenceController::class, 'allattendence'])->name('all.attendence')->middleware('auth');
route::get('/edit-attendence/{edit_date}',[AttendenceController::class, 'editattendence'])->middleware('auth');
route::post('/update-attendence',[AttendenceController::class, 'updateattendence']);
route::get('/view-attendence/{edit_date}',[AttendenceController::class, 'viewattendence'])->middleware('auth');


// Ajustes
route::get('/setting',[SettingController::class, 'setting'])->name('setting')->middleware('auth');
route::post('/update-website/{id}',[SettingController::class, 'updatewebsite']);


// Importar y exportar productos
route::get('/import-product',[ProductController::class, 'importproduct'])->name('import.product')->middleware('auth');
route::get('/export',[ProductController::class, 'export'])->name('export')->middleware('auth');
route::post('/import',[ProductController::class, 'import'])->name('import')->middleware('auth');

// Terminal de punto de venta
route::get('/pos',[PosController::class, 'index'])->name('pos')->middleware('auth');
route::get('/all-orders',[PosController::class, 'pendingorders'])->name('pending.orders')->middleware('auth');
route::get('/view-order-status/{id}',[PosController::class, 'vieworderstatus'])->middleware('auth');
route::get('/delete-order-status/{id}',[PosController::class, 'deleteorderstatus'])->middleware('auth');




route::post('/add-cart',[CartController::class, 'addtocart'])->name('add.cart')->middleware('auth');
route::post('/card-update/{rowId}',[CartController::class, 'cartupdate'])->name('cart.update')->middleware('auth');
route::get('/card-remove/{rowId}',[CartController::class, 'cartremove'])->name('cart.remove')->middleware('auth');
route::post('/create-invoice',[CartController::class, 'createinvoice'])->name('create.invoice')->middleware('auth');
route::post('/final-invoice',[CartController::class, 'finalinvoice'])->name('final.invoice')->middleware('auth');
