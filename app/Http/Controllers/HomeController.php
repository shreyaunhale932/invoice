<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetalRate;
use App\Models\Category;

class HomeController extends Controller
 {

    public function inbox()
 {
        return view( 'Applications/inbox' );
    }

    public function chat()
 {
        return view( 'Applications/Chat/chat' );
    }

    public function calendar()
 {
        return view( 'Applications/calendar' );
    }

    public function allblogs ()
 {
        return view( 'Content/Blogs/all-blogs' );
    }

    public function inactiveblog ()
 {
        return view( 'Content/Blogs/inactive-blog' );
    }

    public function blogcomments ()
 {
        return view( 'Content/Blogs/blog-comments' );
    }

    public function categories ()
 {
        return view( 'Content/Blogs/categories' );
    }

    public function inactive ()
 {
        return view( 'Content/Blogs/inactive' );
    }

    public function cities ()
 {
        return view( 'Content/Location/cities' );
    }

    public function countries ()
 {
        return view( 'Content/Location/countries' );
    }

    public function states ()
 {
        return view( 'Content/Location/states' );
    }

    public function faq()
 {
        return view( 'Content/faq' );
    }

    public function pages()
 {
        return view( 'Content/pages' );
    }

    public function testimonials()
 {
        return view( 'Content/testimonials' );
    }

    public function activecustomers()
 {
        return view( 'Customers/active-customers' );
    }

    public function addcustomer()
 {
        return view( 'Customers/add-customer' );
    }

    public function customerdetails()
 {
        return view( 'Customers/customer-details' );
    }

    public function customers()
 {
        return view( 'Customers/customers' );
    }

    public function customersledger()
 {
        return view( 'Customers/customers-ledger' );
    }

    public function deactivecustomers()
 {
        return view( 'Customers/deactive-customers' );
    }

    public function editcustomer()
 {
        return view( 'Customers/edit-customer' );
    }

    public function ledger()
 {
        return view( 'Customers/ledger' );
    }

    public function vendors()
 {
        return view( 'Customers/vendors' );
    }

    public function indexcards()
 {
        return view( 'Dashboard/index-cards' );
    }

    public function indexfive()
 {
        return view( 'Dashboard/index-five' );
    }

    public function indexfour()
 {
        return view( 'Dashboard/index-four' );
    }

    public function indexinvoices()
 {
        return view( 'Dashboard/index-invoices' );
    }

    public function indexsales()
 {
        return view( 'Dashboard/index-sales' );
    }

    public function indexthree()
 {
        return view( 'Dashboard/index-three' );
    }

    public function indextwo()
 {
        return view( 'Dashboard/index-two' );
    }

    public function index()
 {
        return view( 'Dashboard/index' );
    }

    public function expenses()
 {
        return view( 'Finance/expenses' );
    }

    public function payments()
 {
        return view( 'Finance/payments' );
    }

    public function addproducts()
 {
        return view( 'Inventory/Products/add-products' );
    }

    public function category()
 {
    $categories = Category::all();
        return view( 'Inventory/Products/category',compact('categories') );
    }
      public function subcategory()
 {
        return view( 'Inventory/Products/subcategory' );
    }
  public function metalrates()
 {
    $metalRates = MetalRate::all();
        return view( 'Inventory/Products/metalrates',compact('metalRates') );
    }
    public function editproducts()
 {
        return view( 'Inventory/Products/edit-products' );
    }

    public function productlist()
 {
        return view( 'Inventory/Products/product-list' );
    }

    public function units()
 {
        return view( 'Inventory/Products/units' );
    }

    public function inventoryhistory()
 {
        return view( 'Inventory/inventory-history' );
    }

    public function inventory()
 {
        return view( 'Inventory/inventory' );
    }

    public function membershipaddons()
 {
        return view( 'Membership/membership-addons' );
    }

    public function membershipplans()
 {
        return view( 'Membership/membership-plans' );
    }

    public function subscribers()
 {
        return view( 'Membership/subscribers' );
    }

    public function transactions()
 {
        return view( 'Membership/transactions' );
    }

    public function forgotpassword()
 {
        return view( 'Pages/Authentication/forgot-password' );
    }

    public function lockscreen()
 {
        return view( 'Pages/Authentication/lock-screen' );
    }

    public function login()
 {
        return view( 'Pages/Authentication/login' );
    }

    public function register()
 {
        return view( 'Pages/Authentication/register' );
    }

    public function blankpage()
 {
        return view( 'Pages/blank-page' );
    }

    public function error()
 {
        return view( 'Pages/error-404' );
    }

    public function mapsvector()
 {
        return view( 'Pages/maps-vector' );
    }

    public function profile()
 {
        return view( 'Pages/profile' );
    }

    public function addpurchasereturn()
 {
        return view( 'Purchases/add-purchase-return' );
    }

    public function addpurchasesorder()
 {
        return view( 'Purchases/add-purchases-order' );

    }

    public function addpurchases()
 {
        return view( 'Purchases/add-purchases' );

    }

    public function debitnotes()
 {
        return view( 'Purchases/debit-notes' );

    }

    public function editpurchasereturn()
 {
        return view( 'Purchases/edit-purchase-return' );

    }

    public function editpurchasesorder()
 {
        return view( 'Purchases/edit-purchases-order' );

    }

    public function editpurchases()
 {
        return view( 'Purchases/edit-purchases' );

    }

    public function purchaseorders()
 {
        return view( 'Purchases/purchase-orders' );

    }

    public function purchasedetails()
 {
        return view( 'Purchases/purchase-details' );

    }

    public function purchases()
 {
        return view( 'Purchases/purchases' );

    }

    public function dashboard()
 {
        return view( 'SuperAdmin/dashboard' );

    }
    public function saaslogin()
    {
           return view('pages/Authentication/saas-login' );

       }
       public function saasregister()
       {
              return view('pages/Authentication/saas-register' );

          }



    public function planslist()
    {
           return view( 'SuperAdmin/plans-list' );

       }
       public function invoicesubscription()
       {
              return view( 'SuperAdmin/invoice-subscription' );

          }
}
