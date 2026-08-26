<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
// use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MetalRateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PurityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SellInvoiceController;
use App\Http\Controllers\DayBookController;
use Illuminate\Support\Str;
use App\Models\Invoice;
use App\Http\Controllers\LabelDesignerController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\VisitorController;

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

Route::get('/login', [HomeController::class, 'login'])->name('login');

Route::get('/',[HomeController::class,'invoiceFront'])->name('invoice-front');
Route::get('/pricing',[HomeController::class,'pricing'])->name('pricing');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/privacy-policy',[HomeController::class,'privacypolicy'])->name('privacy-policy');
Route::get('/refund-policy',[HomeController::class,'refundpolicy'])->name('refund-policy');
Route::get('/terms-conditions',[HomeController::class,'termsconditions'])->name('terms-conditions');
Route::get('/faqs',[HomeController::class,'faqs'])->name('faqs');
Route::post('/contact/store', [VisitorController::class, 'store'])
    ->name('contact.store');


Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware([CheckUserRole::class . ':superadmin'])->group(function () {
//     Route::get('/superadmin/superdashboard', [AdminController::class, 'superdashboard'])->name('superadmin.superdashboard');

// });
// Super Admin can add Admins
Route::middleware(['auth.check', 'checkUserRole:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/createAdmin', [SuperAdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/admin/store', [SuperAdminController::class, 'storeAdmin'])->name('admin.store');
    Route::put('/superadmin/admin/update/{id}', [SuperAdminController::class, 'updateAdmin'])->name('admin.update');
    Route::delete('/superadmin/admin/delete/{id}', [SuperAdminController::class, 'destroyAdmin'])->name('admin.destroy');
    Route::get('/visitor',[VisitorController::class,'getvisitor'])->name('visitor');
});

// Admin Routes with Firm Management
Route::middleware(['auth:admin', 'tenant'])->group(function () {
    Route::get('/firms/select', [\App\Http\Controllers\FirmController::class, 'select'])->name('firms.select');
    Route::post('/firms/switch', [\App\Http\Controllers\FirmController::class, 'switch'])->name('firms.switch');
    Route::resource('firms', \App\Http\Controllers\FirmController::class);
});

// Admin can add Clients (Now with Firm Isolation)
Route::middleware(['auth:admin', 'tenant', 'firm'])->group(function () {
    // Expense Routes
    Route::get('/expenses', [\App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [\App\Http\Controllers\ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses/store', [\App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');
    Route::put('/expenses/{expense}', [\App\Http\Controllers\ExpenseController::class, 'update'])
        ->name('expenses.update');

    Route::delete('/expenses/{expense}', [\App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Route::get('/admin/customers', [AdminController::class, 'myCustomers'])->name('admin.customers');
    Route::get('/client/create', [AdminController::class, 'createClient'])->name('client.create');
    Route::post('/client/store', [AdminController::class, 'storeClient'])->name('client.store');
    Route::get('app/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/admin/setting', [AdminController::class, 'storesetting'])->name('admin.setting');
    Route::get('/bank-account', [AdminController::class, 'bank_account'])->name('bank-account');
    Route::post('/admin/bank', [AdminController::class, 'store'])->name('admin.bank');
    Route::get('add-customer', [CustomerController::class, 'addcustomer'])->name('add-customer');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers', [CustomerController::class, 'customers'])->name('customers');
    Route::get('/customers/{id}', [CustomerController::class, 'details'])->name('customers.details');
    Route::get('/customers/export/pdf', [CustomerController::class, 'exportPdf'])->name('customers.export.pdf');
    Route::get('/customers/export/csv', [CustomerController::class, 'exportCsv'])->name('customers.export.csv');
    Route::get('/add-products', [CustomerController::class, 'addproducts'])->name('add-products');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/get-customer-details', [InvoiceController::class, 'getCustomerDetails'])->name('getCustomerDetails');
    // Route::get('/invoice-details/{id}', [InvoiceController::class, 'invoice_details'])->name('invoice-details');
    Route::get('/invoice-details/{uuid}', [InvoiceController::class, 'invoice_details'])->name('invoice-details');
    Route::get('/invoices', [InvoiceController::class, 'invoices'])->name('invoices');
    Route::get('/edit-invoice/{uuid}', [InvoiceController::class, 'edit_invoice'])->name('edit-invoice');
    Route::put('/edit-invoice/{uuid}', [InvoiceController::class, 'edit_invoice'])->name('invoices.update');
    Route::PUT('/invoice-columns/update', [InvoiceController::class, 'updatecolumns'])->name('invoice-columns.update');
    Route::get('invoice-columns-index', [InvoiceController::class, 'invoice_columns_index'])->name('invoice-columns.index');

    Route::get('/purity', [PurityController::class, 'index'])->name('purity');
    Route::post('/purity/store', [PurityController::class, 'store'])->name('purity.store');
    Route::get('purity/{id}/edit', [PurityController::class, 'edit'])->name('purity.edit');
    Route::put('purity/{id}', [PurityController::class, 'update'])->name('purity.update');
    Route::delete('purity/{id}', [PurityController::class, 'destroy'])->name('purity.destroy');


    Route::get('/metal-rates', [HomeController::class, 'metalrates'])->name('metal-rates');
    Route::post('/metal-rates', [MetalRateController::class, 'addmetalrates'])->name('metal-rates');
    Route::post('/metal-rates/bulk-update', [MetalRateController::class, 'bulkUpdate'])->name('metal-rates.bulk-update');
    Route::put('/metal-rates/{id}', [MetalRateController::class, 'update'])->name('metal-rates.update');
    Route::delete('/metal-rates/{id}', [MetalRateController::class, 'destroy'])
        ->name('metal-rates.destroy');

    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    // routes/web.php
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    Route::post('/check-product-code', [ProductController::class, 'checkProductCode'])
        ->name('check.product.code');
    Route::get('/get-next-post-code', [ProductController::class, 'getNextPostCode'])
        ->name('products.getNextPostCode');
    Route::get('/products/search-precode', [ProductController::class, 'searchPreCode'])
        ->name('products.searchPreCode');
    Route::get('/products/get-precode-details', [ProductController::class, 'getPreCodeDetails'])
        ->name('products.getPreCodeDetails');
    Route::get('/category', [HomeController::class, 'category'])->name('category');
    Route::post('/category', [CategoryController::class, 'addcategory'])->name('category');
    Route::put('/category{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])
        ->name('category.destroy');

    Route::get('/subcategory', [HomeController::class, 'subcategory'])->name('subcategory');
    Route::post('/subcategory', [SubCategoryController::class, 'addsubcategory'])->name('subcategory');
    Route::put('/subcategory{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategory/{id}', [SubCategoryController::class, 'destroy'])
        ->name('subcategory.destroy');


    Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
    Route::get('/products/searchPacket', [ProductController::class, 'searchPacket'])->name('products.searchPacket');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');


    Route::get('inventory-history/{id}', [InventoryController::class, 'history'])->name('inventory.history');

    //  Route::get('inventory', [InventoryController::class, 'index']);
    Route::post('inventory/stock-in', [InventoryController::class, 'stockIn'])->name('inventory.stock.in');
    Route::post('inventory/stock-out', [InventoryController::class, 'stockOut'])->name('inventory.stock.out');
    Route::get('inventory/item-products/{itemId}', [InventoryController::class, 'getProductsForItem'])->name('inventory.item.products');

    Route::get('/inventories', [InventoryController::class, 'indexInventory'])->name('inventory.index');
    // Route::get('/inventory-history', [HomeController::class, 'inventoryhistory'])->name('inventory-history');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::post(
        '/sell-invoice/add-item',
        [SellInvoiceController::class, 'addItem']
    )->name('sell.invoice.addItem');

    Route::post(
        '/sell-invoice/add-direct-sell',
        [SellInvoiceController::class, 'addDirectSellItem']
    )->name('sell.invoice.addDirectSell');

    Route::get('/sell-invoice/edit/{id}', function ($id) {
        // Determine if we need a controller method or just return the view
        // Since add_invoice view is powered by JS and customer-dropdown,
        // we might need to pass the ID to the view so JS can auto-load it.
        // Let's use SellInvoiceController method to be clean.
        return app(SellInvoiceController::class)->edit($id);
    })->name('sell.invoice.edit');

    Route::get(
        '/sell-invoice/get-pending/{customerId}',
        [SellInvoiceController::class, 'getPendingInvoice']
    )->name('sell.invoice.getPending');

    Route::get(
        '/sell-invoice/customer-unsettled-entries/{customerId}/{invoiceId?}',
        [SellInvoiceController::class, 'getCustomerUnsettledEntries']
    )->name('sell.invoice.unsettled');

    Route::get(
        '/sell-invoice/get/{id}',
        [SellInvoiceController::class, 'getInvoiceById']
    )->name('sell.invoice.getById');

    Route::post(
        '/sell-invoice/remove-item',
        [SellInvoiceController::class, 'removeItem']
    )->name('sell.invoice.removeItem');

    Route::post(
        '/sell-invoice/update-item',
        [SellInvoiceController::class, 'updateItem']
    )->name('sell.invoice.updateItem');

    Route::post(
        '/sell-invoice/finalize',
        [SellInvoiceController::class, 'finalize']
    )->name('sell.invoice.finalize');

    Route::post(
        '/sell-invoice/update',
        [SellInvoiceController::class, 'update']
    )->name('sell.invoice.update');

    Route::delete(
        '/sell-invoice/delete/{id}',
        [SellInvoiceController::class, 'destroy']
    )->name('sell.invoice.destroy');

    Route::get(
        '/sell-invoice/view/{id}',
        [SellInvoiceController::class, 'show']
    )->name('sell.invoice.view');

    Route::get('/sell-invoice/send-mail/{id}',
    [SellInvoiceController::class, 'sendInvoiceMail'])
    ->name('sell.invoice.sendMail');
    Route::get('/invoice/pdf/{id}', [SellInvoiceController::class, 'generatePDF'])
        ->name('invoice.pdf');
Route::get('/invoice/send-whatsapp/{id}', [SellInvoiceController::class, 'sendWhatsApp'])
    ->name('sell.invoice.sendWhatsapp');
    // Invoice Template Routes
    Route::get(
        '/invoice-template/editor',
        [App\Http\Controllers\InvoiceTemplateController::class, 'index']
    )->name('invoice.template.index');

    Route::post(
        '/invoice-template/update',
        [App\Http\Controllers\InvoiceTemplateController::class, 'update']
    )->name('invoice.template.update');

    Route::post(
        '/invoice-template/reset',
        [App\Http\Controllers\InvoiceTemplateController::class, 'reset']
    )->name('invoice.template.reset');

    Route::post(
        '/invoice-template/blocks/store',
        [App\Http\Controllers\InvoiceTemplateController::class, 'storeBlock']
    )->name('invoice.template.block.store');

    Route::post(
        '/invoice-template/blocks/{id}/update',
        [App\Http\Controllers\InvoiceTemplateController::class, 'updateBlock']
    )->name('invoice.template.block.update');

    Route::delete(
        '/invoice-template/blocks/{id}/delete',
        [App\Http\Controllers\InvoiceTemplateController::class, 'deleteBlock']
    )->name('invoice.template.block.delete');

    Route::get('/generate-uuid-for-old-invoices', function () {
        $invoices = Invoice::whereNull('uuid')->get();

        foreach ($invoices as $invoice) {
            $invoice->uuid = Str::uuid();
            $invoice->save();
        }

        return "UUID Generated Successfully for Old Records";
    });
    Route::get('/setup-columns', function () {
        $columns = [
            ['name' => 'Product', 'type' => 'text'],
            ['name' => 'HSN', 'type' => 'text'],
            ['name' => 'Quantity', 'type' => 'number'],
            ['name' => 'Rate', 'type' => 'number'],
            ['name' => 'Discount', 'type' => 'number'],
            ['name' => 'GST', 'type' => 'number'],
            ['name' => 'Amount', 'type' => 'number'],
        ];

        foreach ($columns as $index => $col) {
            \App\Models\InvoiceColumn::create([
                'name' => $col['name'],
                'type' => $col['type'],
                'is_custom' => false,
                'is_visible' => true,
                'position' => $index,
            ]);
        }

        return 'Default columns inserted!';
    });
    Route::get('/edit-products', [HomeController::class, 'editproducts'])->name('edit-products');
    Route::get('/product-list', [HomeController::class, 'productlist'])->name('product-list');
    Route::get('/direct-sell-products', [HomeController::class, 'directSellProducts'])->name('direct-sell-products');
    // Accounting Routes
    Route::get('/accounting/trial-balance', [\App\Http\Controllers\AccountingController::class, 'trialBalance'])->name('accounting.trial-balance');
    Route::get('/accounting/profit-loss', [\App\Http\Controllers\AccountingController::class, 'profitAndLoss'])->name('accounting.profit-loss');
    Route::get('/accounting/balance-sheet', [\App\Http\Controllers\AccountingController::class, 'balanceSheet'])->name('accounting.balance-sheet');
    Route::get('/accounting/chart-of-accounts', [\App\Http\Controllers\AccountingController::class, 'chartOfAccounts'])->name('accounting.chart-of-accounts');
    Route::get('/accounting/ledger/{id}', [\App\Http\Controllers\AccountingController::class, 'ledger'])->name('accounting.ledger');
    Route::get('/accounting/sync-all', [\App\Http\Controllers\AccountingController::class, 'syncAll'])->name('accounting.sync-all');
    Route::post('/accounting/post-invoice/{id}', [\App\Http\Controllers\AccountingController::class, 'postInvoice'])->name('accounting.post-invoice');
    Route::post('/accounting/accounts', [\App\Http\Controllers\AccountingController::class, 'storeAccount'])->name('accounting.accounts.store');
    Route::put('/accounting/accounts/{id}', [\App\Http\Controllers\AccountingController::class, 'updateAccount'])->name('accounting.accounts.update');
    Route::delete('/accounting/accounts/{id}', [\App\Http\Controllers\AccountingController::class, 'deleteAccount'])->name('accounting.accounts.delete');
    Route::get('/reports/day-book', [DayBookController::class, 'index'])->name('day-book.index');

    // Customer Transaction Routes
    Route::get('/customer/transactions', [\App\Http\Controllers\CustomerTransactionController::class, 'index'])->name('customer.transactions.index');
    Route::get('/customer/transactions/add', [\App\Http\Controllers\CustomerTransactionController::class, 'create'])->name('customer.transactions.add');
    Route::post('/customer/transactions/store', [\App\Http\Controllers\CustomerTransactionController::class, 'store'])->name('customer.transactions.store');
    Route::get('/customer/transactions/{id}/edit', [\App\Http\Controllers\CustomerTransactionController::class, 'edit'])->name('customer.transactions.edit');
    Route::put('/customer/transactions/{id}/update', [\App\Http\Controllers\CustomerTransactionController::class, 'update'])->name('customer.transactions.update');
    Route::get('/customer/transactions/{id}/refund', [\App\Http\Controllers\CustomerTransactionController::class, 'refund'])->name('customer.transactions.refund');
    Route::get('/customer/invoices/{id}/refund', [\App\Http\Controllers\CustomerTransactionController::class, 'refundInvoice'])->name('customer.invoices.refund');
    Route::delete('/customer/transactions/{id}/delete', [\App\Http\Controllers\CustomerTransactionController::class, 'destroy'])->name('customer.transactions.destroy');
    Route::get('/customer/reports/transactions', [\App\Http\Controllers\CustomerTransactionController::class, 'report'])->name('customer.reports.transactions');

    Route::get('/payments', [HomeController::class, 'payments'])->name('payments');

    Route::get('/stock-report', [PageController::class, 'stock_report'])->name('stock-report');
    Route::get('/sales-report', [PageController::class, 'sales_report'])->name('sales-report');
    Route::get('/stock-summary', [PageController::class, 'stock_summary'])->name('stock-summary');
    Route::get('/old-metal-received', [PageController::class, 'old_metal_received_report'])->name('old-metal-received');
    Route::get('/old-diamond-received', [PageController::class, 'old_diamond_received_report'])->name('old-diamond-received');

    // Packet Master Routes
    Route::resource('packet-masters', \App\Http\Controllers\PacketMasterController::class);

    // Packet Attributes Routes (Dynamic)
    Route::get('packet-attributes/{type}', [\App\Http\Controllers\PacketAttributeController::class, 'index'])->name('packet-attributes.index');
    Route::post('packet-attributes/{type}', [\App\Http\Controllers\PacketAttributeController::class, 'store'])->name('packet-attributes.store');
    Route::get('packet-attributes/{type}/{id}/edit', [\App\Http\Controllers\PacketAttributeController::class, 'edit'])->name('packet-attributes.edit');
    Route::put('packet-attributes/{type}/{id}', [\App\Http\Controllers\PacketAttributeController::class, 'update'])->name('packet-attributes.update');
    Route::delete('packet-attributes/{type}/{id}', [\App\Http\Controllers\PacketAttributeController::class, 'destroy'])->name('packet-attributes.destroy');

    Route::get('/invoice/{id}/whatsapp',[SellInvoiceController::class,'sendWhatsAppInvoice'])->name('invoice.whatsapp');
Route::get('/invoice/{id}/email',[SellInvoiceController::class,'sendInvoiceEmail'])->name('invoice.email');
Route::get('/invoice/{id}/sms',[SellInvoiceController::class,'sendInvoiceSMS'])->name('invoice.sms');

Route::get('/invoices-overdue', [PageController::class, 'invoices_overdue'])->name('invoices-overdue');
Route::get('/invoices-paid', [PageController::class, 'invoices_paid'])->name('invoices-paid');
Route::get('/invoices-recurring', [PageController::class, 'invoices_recurring'])->name('invoices-recurring');
Route::get('/invoices-refunded', [PageController::class, 'invoices_refunded'])->name('invoices-refunded');
Route::get('/invoices-unpaid', [PageController::class, 'invoices_unpaid'])->name('invoices-unpaid');

    // Barcode & Label Printing Routes

    Route::get('/labels/templates', [LabelDesignerController::class, 'index'])->name('labels.templates.index');
    Route::get('/labels/designer', [LabelDesignerController::class, 'create'])->name('labels.designer.create');
    Route::post('/labels/designer', [LabelDesignerController::class, 'store'])->name('labels.designer.store');
    Route::get('/labels/designer/{template}/edit', [LabelDesignerController::class, 'edit'])->name('labels.designer.edit');
    Route::put('/labels/designer/{template}', [LabelDesignerController::class, 'update'])->name('labels.designer.update');
    Route::delete('/labels/templates/{template}', [LabelDesignerController::class, 'destroy'])->name('labels.templates.destroy');

    Route::get('/labels/print/preview/{template_id}/{product_id}', [PrintController::class, 'preview'])->name('labels.print.preview');
    Route::get('/labels/print/bulk', [PrintController::class, 'bulkPrintView'])->name('labels.print.bulk');
    Route::post('/labels/print/bulk', [PrintController::class, 'processBulk'])->name('labels.print.processBulk');

});



Route::get('Dashboard/index', [CustomAuthController::class, 'dashboard']);
// Route::get('Pages/Authentication/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('Pages/Authentication/register', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// PageController
Route::get('/delete-account-request', [PageController::class, 'account'])->name('delete-account-request');
Route::get('/permission', [PageController::class, 'permission'])->name('permission');
Route::get('/roles-permission', [PageController::class, 'roles'])->name('roles-permission');

Route::get('/contact-messages', [PageController::class, 'contact'])->name('contact-messages');
Route::get('/ticket-details', [PageController::class, 'details'])->name('ticket-details');
Route::get('/tickets-closed', [PageController::class, 'closed'])->name('tickets-closed');
Route::get('/tickets-kanban', [PageController::class, 'kanban'])->name('tickets-kanban');
Route::get('/tickets-list-closed', [PageController::class, 'list_closed'])->name('tickets-list-closed');
Route::get('/tickets-list-open', [PageController::class, 'list_open'])->name('tickets-list-open');
Route::get('/tickets-list-pending', [PageController::class, 'list_pending'])->name('tickets-list-pending');
Route::get('/tickets-list-resolved', [PageController::class, 'list_resolved'])->name('tickets-list-resolved');
Route::get('/tickets-list', [PageController::class, 'list'])->name('tickets-list');
Route::get('/tickets-open', [PageController::class, 'open'])->name('tickets-open');
Route::get('/tickets-pending', [PageController::class, 'pending'])->name('tickets-pending');
Route::get('/tickets-resolved', [PageController::class, 'resolved'])->name('tickets-resolved');
Route::get('/tickets', [PageController::class, 'tickets'])->name('tickets');
Route::get('/companies', [PageController::class, 'companies'])->name('companies');
Route::get('/domain-request', [PageController::class, 'domain_request'])->name('domain-request');
Route::get('/domain', [PageController::class, 'domain'])->name('domain');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/purchase-transaction', [PageController::class, 'purchase_transaction'])->name('purchase-transaction');
Route::get('/subscription', [PageController::class, 'subscription'])->name('subscription');
Route::get('/mail-pay-invoice', [PageController::class, 'mail_pay_invoice'])->name('mail-pay-invoice');
Route::get('/pay-online', [PageController::class, 'pay_online'])->name('pay-online');
Route::get('/signature-invoice', [PageController::class, 'signature_invoice'])->name('signature-invoice');
Route::get('/signature-list', [PageController::class, 'signature_list'])->name('signature-list');
Route::get('/signature-preview-invoice', [PageController::class, 'signature_preview_invoice'])->name('signature-preview-invoice');
Route::get('/add-delivery-challans', [PageController::class, 'add_delivery_challans'])->name('add-delivery-challans');
Route::get('/add-quotations', [PageController::class, 'add_quotations'])->name('add-quotations');
Route::get('/delivery-challans', [PageController::class, 'delivery_challans'])->name('delivery-challans');
Route::get('/edit-delivery-challans', [PageController::class, 'edit_delivery_challans'])->name('edit-delivery-challans');
Route::get('/edit-quotations', [PageController::class, 'edit_quotations'])->name('edit-quotations');
Route::get('/quotations', [PageController::class, 'quotations'])->name('quotations');
Route::get('/payment-summary', [PageController::class, 'payment_summary'])->name('payment-summary');

Route::get('/expense-report', [PageController::class, 'expense_report'])->name('expense-report');
Route::get('/income-report', [PageController::class, 'income_report'])->name('income-report');
Route::get('/low-stock-report', [PageController::class, 'low_stock_report'])->name('low-stock-report');
Route::get('/payment-report', [PageController::class, 'payment_report'])->name('payment-report');
Route::get('/purchase-report', [PageController::class, 'purchase_report'])->name('purchase-report');
Route::get('/quotation-report', [PageController::class, 'quotation_report'])->name('quotation-report');

Route::get('/sales-return-report', [PageController::class, 'sales_return_report'])->name('sales-return-report');

Route::get('/purchase-return', [PageController::class, 'purchase_return'])->name('purchase-return');
Route::get('/profit-loss-list', [PageController::class, 'profit_loss_list'])->name('profit-loss-list');
Route::get('/tax-purchase', [PageController::class, 'tax_purchase'])->name('tax-purchase');
Route::get('/tax-sales', [PageController::class, 'tax_sales'])->name('tax-sales');
Route::get('/add-credit-notes', [PageController::class, 'add_credit_notes'])->name('add-credit-notes');
Route::get('/credit-notes', [PageController::class, 'credit_notes'])->name('credit-notes');
Route::get('/edit-credit-notes', [PageController::class, 'edit_credit_notes'])->name('edit-credit-notes');
Route::get('/recurring-invoices', [PageController::class, 'recurring_invoices'])->name('recurring-invoices');
// Route::get('/add-invoice', [PageController::class, 'add_invoice'])->name('add-invoice');
Route::get('/cashreceipt-1', [PageController::class, 'cashreceipt_1'])->name('cashreceipt-1');
Route::get('/cashreceipt-2', [PageController::class, 'cashreceipt_2'])->name('cashreceipt-2');
Route::get('/cashreceipt-3', [PageController::class, 'cashreceipt_3'])->name('cashreceipt-3');
Route::get('/cashreceipt-4', [PageController::class, 'cashreceipt_4'])->name('cashreceipt-4');
// Route::get('/edit-invoice', [PageController::class, 'edit_invoice'])->name('edit-invoice');
Route::get('/invoice-details-admin', [PageController::class, 'invoice_details_admin'])->name('invoice-details-admin');
// Route::get('/invoice-details', [PageController::class, 'invoice_details'])->name('invoice-details');
Route::get('/invoice-five', [PageController::class, 'invoice_five'])->name('invoice-five');
Route::get('/invoice-four-a', [PageController::class, 'invoice_four_a'])->name('invoice-four-a');
Route::get('/invoice-one-a', [PageController::class, 'invoice_one_a'])->name('invoice-one-a');
Route::get('/invoice-template', [PageController::class, 'invoice_template'])->name('invoice-template');
Route::get('/invoice-three', [PageController::class, 'invoice_three'])->name('invoice-three');
Route::get('/invoice-two', [PageController::class, 'invoice_two'])->name('invoice-two');
Route::get('/invoices-cancelled', [PageController::class, 'invoices_cancelled'])->name('invoices-cancelled');
Route::get('/invoices-draft', [PageController::class, 'invoices_draft'])->name('invoices-draft');
// Route::get('/invoices-overdue', [PageController::class, 'invoices_overdue'])->name('invoices-overdue');
// Route::get('/invoices-paid', [PageController::class, 'invoices_paid'])->name('invoices-paid');
// Route::get('/invoices-recurring', [PageController::class, 'invoices_recurring'])->name('invoices-recurring');
// Route::get('/invoices-refunded', [PageController::class, 'invoices_refunded'])->name('invoices-refunded');
// Route::get('/invoices-unpaid', [PageController::class, 'invoices_unpaid'])->name('invoices-unpaid');
// Route::get('/invoices', [PageController::class, 'invoices'])->name('invoices');
// Route::get('/bank-account', [PageController::class, 'bank_account'])->name('bank-account');
Route::get('/company-settings', [PageController::class, 'company_settings'])->name('company-settings');
Route::get('/email-settings', [PageController::class, 'email_settings'])->name('email-settings');
Route::get('/invoice-settings', [PageController::class, 'invoice_settings'])->name('invoice-settings');
Route::get('/payment-settings', [PageController::class, 'payment_settings'])->name('payment-settings');
Route::get('/plan-billing', [PageController::class, 'plan_billing'])->name('plan-billing');
Route::get('/preferences', [PageController::class, 'preferences'])->name('preferences');

Route::get('/tax-rates', [PageController::class, 'tax_rates'])->name('tax-rates');
Route::get('/template-invoice', [PageController::class, 'template_invoice'])->name('template-invoice');
Route::get('/two-factor', [PageController::class, 'two_factor'])->name('two-factor');
Route::get('/custom-filed', [PageController::class, 'custom_filed'])->name('custom-filed');
Route::get('/accordions', [PageController::class, 'accordions'])->name('accordions');
Route::get('/alerts', [PageController::class, 'alerts'])->name('alerts');
Route::get('/avatar', [PageController::class, 'avatar'])->name('avatar');
Route::get('/badges', [PageController::class, 'badges'])->name('badges');
Route::get('/buttongroup', [PageController::class, 'buttongroup'])->name('buttongroup');
Route::get('/breadcrumbs', [PageController::class, 'breadcrumbs'])->name('breadcrumbs');
Route::get('/buttons', [PageController::class, 'buttons'])->name('buttons');
Route::get('/cards', [PageController::class, 'cards'])->name('cards');
Route::get('/carousel', [PageController::class, 'carousel'])->name('carousel');
Route::get('/dropdowns', [PageController::class, 'dropdowns'])->name('dropdowns');
Route::get('/grid', [PageController::class, 'grid'])->name('grid');
Route::get('/images', [PageController::class, 'images'])->name('images');
Route::get('/lightbox', [PageController::class, 'lightbox'])->name('lightbox');
Route::get('/media', [PageController::class, 'media'])->name('media');
Route::get('/modal', [PageController::class, 'modal'])->name('modal');
Route::get('/offcanvas', [PageController::class, 'offcanvas'])->name('offcanvas');
Route::get('/pagination', [PageController::class, 'pagination'])->name('pagination');
Route::get('/placeholders', [PageController::class, 'placeholders'])->name('placeholders');
Route::get('/popover', [PageController::class, 'popover'])->name('popover');
Route::get('/progress', [PageController::class, 'progress'])->name('progress');
Route::get('/rangeslider', [PageController::class, 'rangeslider'])->name('rangeslider');
Route::get('/spinners', [PageController::class, 'spinners'])->name('spinners');
Route::get('/sweetalerts', [PageController::class, 'sweetalerts'])->name('sweetalerts');
Route::get('/tab', [PageController::class, 'tab'])->name('tab');
Route::get('/toastr', [PageController::class, 'toastr'])->name('toastr');
Route::get('/tooltip', [PageController::class, 'tooltip'])->name('tooltip');
Route::get('/typography', [PageController::class, 'typography'])->name('typography');
Route::get('/video', [PageController::class, 'video'])->name('video');
Route::get('/chart-apex', [PageController::class, 'chart_apex'])->name('chart-apex');
Route::get('/chart-c3', [PageController::class, 'chart_c3'])->name('chart-c3');
Route::get('/chart-flot', [PageController::class, 'chart_flot'])->name('chart-flot');
Route::get('/chart-js', [PageController::class, 'chart_js'])->name('chart-js');
Route::get('/chart-morris', [PageController::class, 'chart_morris'])->name('chart-morris');
Route::get('/chart-peity', [PageController::class, 'chart_peity'])->name('chart-peity');
Route::get('/clipboard', [PageController::class, 'clipboard'])->name('clipboard');
Route::get('/counter', [PageController::class, 'counter'])->name('counter');
Route::get('/drag-drop', [PageController::class, 'drag_drop'])->name('drag-drop');
Route::get('/form-wizard', [PageController::class, 'form_wizard'])->name('form-wizard');
Route::get('/horizontal-timeline', [PageController::class, 'horizontal_timeline'])->name('horizontal-timeline');
Route::get('/notification', [PageController::class, 'notification'])->name('notification');
Route::get('/rating', [PageController::class, 'rating'])->name('rating');
Route::get('/ribbon', [PageController::class, 'ribbon'])->name('ribbon');
Route::get('/scrollbar', [PageController::class, 'scrollbar'])->name('scrollbar');
Route::get('/stickynote', [PageController::class, 'stickynote'])->name('stickynote');
Route::get('/text-editor', [PageController::class, 'text_editor'])->name('text-editor');
Route::get('/timeline', [PageController::class, 'timeline'])->name('timeline');
Route::get('/form-basic-inputs', [PageController::class, 'form_basic_inputs'])->name('form-basic-inputs');
Route::get('/form-fileupload', [PageController::class, 'form_fileupload'])->name('form-fileupload');
Route::get('/form-horizontal', [PageController::class, 'form_horizontal'])->name('form-horizontal');
Route::get('/form-input-groups', [PageController::class, 'form_input_groups'])->name('form-input-groups');
Route::get('/form-select2', [PageController::class, 'form_select2'])->name('form-select2');
Route::get('/form-vertical', [PageController::class, 'form_vertical'])->name('form-vertical');
Route::get('/form-mask', [PageController::class, 'form_mask'])->name('form-mask');
Route::get('/form-validation', [PageController::class, 'form_validation'])->name('form-validation');
Route::get('/icon-fontawesome', [PageController::class, 'icon_fontawesome'])->name('icon-fontawesome');
Route::get('/icon-feather', [PageController::class, 'icon_feather'])->name('icon-feather');
Route::get('/icon-flag', [PageController::class, 'icon_flag'])->name('icon-flag');
Route::get('/icon-ionic', [PageController::class, 'icon_ionic'])->name('icon-ionic');
Route::get('/icon-material', [PageController::class, 'icon_material'])->name('icon-material');
Route::get('/icon-pe7', [PageController::class, 'icon_pe7'])->name('icon-pe7');
Route::get('/icon-simpleline', [PageController::class, 'icon_simpleline'])->name('icon-simpleline');
Route::get('/icon-themify', [PageController::class, 'icon_themify'])->name('icon-themify');
Route::get('/icon-typicon', [PageController::class, 'icon_typicon'])->name('icon-typicon');
Route::get('/icon-weather', [PageController::class, 'icon_weather'])->name('icon-weather');
Route::get('/data-tables', [PageController::class, 'data_tables'])->name('data-tables');
Route::get('/tables-basic', [PageController::class, 'tables_basic'])->name('tables-basic');
Route::get('/notifications', [PageController::class, 'notifications'])->name('notifications');

//HomeController

Route::get('/chat', [HomeController::class, 'chat'])->name('chat');
Route::get('/calendar', [HomeController::class, 'calendar'])->name('calendar');
Route::get('/inbox', [HomeController::class, 'inbox'])->name('inbox');
Route::get('/all-blogs', [HomeController::class, 'allblogs'])->name('all-blogs');
Route::get('/inactive-blog', [HomeController::class, 'inactiveblog'])->name('inactive-blog');
Route::get('/blog-comments', [HomeController::class, 'blogcomments'])->name('blog-comments');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/inactive', [HomeController::class, 'inactive'])->name('inactive');
Route::get('/cities', [HomeController::class, 'cities'])->name('cities');
Route::get('/countries', [HomeController::class, 'countries'])->name('countries');
Route::get('/states', [HomeController::class, 'states'])->name('states');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/pages', [HomeController::class, 'pages'])->name('pages');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/active-customers', [HomeController::class, 'activecustomers'])->name('active-customers');
// Route::get('/add-customer', [HomeController::class, 'addcustomer'])->name('add-customer');
Route::get('/customer-details', [HomeController::class, 'customerdetails'])->name('customer-details');
Route::get('/customers-ledger', [HomeController::class, 'customersledger'])->name('customers-ledger');
// Route::get('/customers', [HomeController::class, 'customers'])->name('customers');
Route::get('/deactive-customers', [HomeController::class, 'deactivecustomers'])->name('deactive-customers');
Route::get('/edit-customer', [HomeController::class, 'editcustomer'])->name('edit-customer');
Route::get('/ledger', [HomeController::class, 'ledger'])->name('ledger');
Route::get('/vendors', [HomeController::class, 'vendors'])->name('vendors');
Route::get('/index-five', [HomeController::class, 'indexfive'])->name('index-five');
Route::get('/index-four', [HomeController::class, 'indexfour'])->name('index-four');
Route::get('/index-three', [HomeController::class, 'indexthree'])->name('index-three');
Route::get('/index-two', [HomeController::class, 'indextwo'])->name('index-two');
// Route::get('/', [HomeController::class, 'index'])->name('index');


// Route::get('/add-products', [HomeController::class, 'addproducts'])->name('add-products');


Route::get('/units', [HomeController::class, 'units'])->name('units');

Route::get('/membership-addons', [HomeController::class, 'membershipaddons'])->name('membership-addons');
Route::get('/membership-plans', [HomeController::class, 'membershipplans'])->name('membership-plans');
Route::get('/subscribers', [HomeController::class, 'subscribers'])->name('subscribers');
Route::get('/transactions', [HomeController::class, 'transactions'])->name('transactions');
Route::get('/forgot-password', [HomeController::class, 'forgotpassword'])->name('forgot-password');
Route::get('/lock-screen', [HomeController::class, 'lockscreen'])->name('lock-screen');
// Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/blank-page', [HomeController::class, 'blankpage'])->name('blank-page');
Route::get('/error-404', [HomeController::class, 'error'])->name('error-404');
Route::get('/maps-vector', [HomeController::class, 'mapsvector'])->name('maps-vector');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');


Route::get('/add-purchase-return', [HomeController::class, 'addpurchasereturn'])->name('add-purchase-return');
Route::get('/add-purchases-order', [HomeController::class, 'addpurchasesorder'])->name('add-purchases-order');
Route::get('/add-purchases', [HomeController::class, 'addpurchases'])->name('add-purchases');
Route::get('/debit-notes', [HomeController::class, 'debitnotes'])->name('debit-notes');
Route::get('/edit-purchase-return', [HomeController::class, 'editpurchasereturn'])->name('edit-purchase-return');
Route::get('/edit-purchases-order', [HomeController::class, 'editpurchasesorder'])->name('edit-purchases-order');
Route::get('/edit-purchases', [HomeController::class, 'editpurchases'])->name('edit-purchases');
Route::get('/purchase-orders', [HomeController::class, 'purchaseorders'])->name('purchase-orders');
Route::get('/purchase-details', [HomeController::class, 'purchasedetails'])->name('purchase-details');
Route::get('/purchases', [HomeController::class, 'purchases'])->name('purchases');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/email-template', [PageController::class, 'emailtemplate'])->name('email-template');
Route::get('/seo-settings', [PageController::class, 'seosettings'])->name('seo-settings');
Route::get('/saas-settings', [PageController::class, 'saassettings'])->name('saas-settings');
Route::get('/saas-login', [HomeController::class, 'saaslogin'])->name('saas-login');
Route::get('/saas-register', [HomeController::class, 'saasregister'])->name('saas-register');
Route::post('/saas-register-submit', [\App\Http\Controllers\Auth\RegistrationController::class, 'register'])->name('saas.register.submit');
Route::post('/saas-verify-otp', [\App\Http\Controllers\Auth\RegistrationController::class, 'verifyOtp'])->name('saas.verify.otp');



Route::get('/plans-list', [HomeController::class, 'planslist'])->name('plans-list');
Route::get('/invoice-subscription', [HomeController::class, 'invoicesubscription'])->name('invoice-subscription');
