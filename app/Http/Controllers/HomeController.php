<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetalRate;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\TutorialVideo;
use App\Models\BlogPost;
use App\Models\CmsPricingPlan;
use App\Models\CmsPricingComparisonSetting;
use App\Models\CmsPricingSetting;
use App\Models\CmsInvoiceSolutionPage;
use App\Models\CmsSolution;
use Illuminate\Support\Facades\Auth;
use App\Models\CmsBanner;

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
        if (Auth::guard('admin')->check()) {
            $customer = Customer::where('admin_id', Auth::guard('admin')->id())->first();
            if ($customer) {
                return redirect()->route('customers.details', $customer->id);
            }
        }
        return redirect()->route('customers');
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
    // $categories = Category::all();
      $categories = Category::where('admin_id', Auth::id())
        ->orderBy('category_id', 'DESC')
        ->get();

        return view( 'Inventory/Products/category',compact('categories') );
    }
 public function subcategory()
{
    $categories = Category::where('admin_id', Auth::id())
        ->with('subcategories')
        ->orderBy('category_id', 'DESC')
        ->get();

    return view('Inventory/Products/subcategory', compact('categories'));
}
  public function metalrates()
 {
    // $metalRates = MetalRate::all();
     $metalRates = MetalRate::where('admin_id', Auth::id())
        ->orderBy('id', 'DESC')
        ->get();

        return view( 'Inventory/Products/metalrates',compact('metalRates') );
    }
    public function editproducts()
 {
        return view( 'Inventory/Products/edit-products' );
    }

  public function productlist()
{
   $products = Product::with(['category', 'subcategory', 'supplier', 'retailPurchase', 'wholesaleStock'])
    ->where('admin_id', Auth::id())
    ->where('availability', 'available')
    ->where('is_direct_sell', 0)
    ->orderBy('id', 'DESC')
    ->get();

   $templates = \App\Models\PrintTemplate::all();

    return view('Inventory/Products/product-list', compact('products', 'templates'));
}

  public function directSellProducts()
{
   $products = Product::with('category')   // Load category
    ->where('admin_id', Auth::id())
    ->where('is_direct_sell', 1)
    ->orderBy('id', 'DESC')
    ->get();

   $templates = \App\Models\PrintTemplate::all();

    return view('Inventory/Products/direct-sell-product-list', compact('products', 'templates'));
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
        $banners = CmsBanner::firstOrCreate([]);
        $faqs = Faq::orderBy('id')->limit(4)->get();
        $testimonials = Testimonial::orderBy('id')->get();

        return view('invoice_front.index', compact('banners', 'faqs', 'testimonials'));
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


          public function invoiceFront(){
            $banners = CmsBanner::firstOrCreate([]);
            $faqs = Faq::orderBy('id')->limit(4)->get();
            $testimonials = Testimonial::orderBy('id')->get();
            return view('invoice_front.index', compact('banners', 'faqs', 'testimonials'));
          }
           public function blog(Request $request)
    {
        $blogs = BlogPost::orderByDesc('date')
            ->orderByDesc('id')
                   ->get();

        return view('invoice_front.blog', [
            'blogs' => $blogs,
                   'latestBlogs' => $blogs->take(5),
        ]);
    }
    public function blogdetails(Request $request, ?BlogPost $blog = null)
    {
        $blog = $blog ?? BlogPost::orderByDesc('date')->orderByDesc('id')->firstOrFail();
               $latestBlogs = BlogPost::whereKeyNot($blog->getKey())
                   ->orderByDesc('date')
                   ->orderByDesc('id')
                   ->limit(5)
                   ->get();

               return view('invoice_front.blog-details', compact('blog', 'latestBlogs'));
    }
     public function contact(Request $request)
    {
        return view('invoice_front.contact');
    }
       public function pricing(Request $request)
    {
        $pricingSettings = CmsPricingSetting::firstOrCreate([], [
            'main_heading' => 'The right plan to grow your',
            'main_heading_highlight' => 'jewellery business',
            'subheading' => "Everything you need to bill faster, manage inventory, and make smarter decisions.\nStart free—no credit card required.",
            'yearly_discount_badge' => 'Save up to 41%',
            'bottom_benefits' => [
                'No setup fee',
                'Free data migration',
                'Friendly onboarding support',
            ],
        ]);
        $pricingComparison = CmsPricingComparisonSetting::firstOrCreate([], [
            'eyebrow' => 'COMPARE PLANS',
            'title' => 'Find your perfect fit',
            'description' => 'All plans cover the essentials. Choose based on your team and reporting needs.',
            'feature_heading' => 'Feature',
            'features' => [],
        ]);

        // Ensure 4th plan (Enterprise) exists if only 3 plans were seeded
        if (CmsPricingPlan::where('name', 'Enterprise')->doesntExist()) {
            CmsPricingPlan::create([
                'name' => 'Enterprise',
                'plan_label' => 'FOR LARGE ENTERPRISES',
                'is_featured' => false,
                'popular_badge_text' => null,
                'description' => 'Complete custom ERP solution with unlimited branches & dedicated SLA support.',
                'monthly_price' => 9999,
                'monthly_discount' => 17,
                'monthly_cut_price' => 12000,
                'monthly_savings' => 2001,
                'monthly_billing_text' => 'Billed monthly',
                'yearly_price' => 89999,
                'yearly_discount' => 25,
                'yearly_cut_price' => 120000,
                'yearly_savings' => 30001,
                'yearly_billing_text' => 'Billed annually',
                'currency_symbol' => '₹',
                'button_text' => 'Contact Sales',
                'button_link' => '#jewelSignupModal',
                'trial_note' => '30 days free · Dedicated setup',
                'features' => [
                    'Unlimited branches & users',
                    'Custom ERP & API integrations',
                    '24/7 dedicated account manager',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ]);
        }

        $pricingPlans = CmsPricingPlan::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('invoice_front.pricing', compact('pricingSettings', 'pricingPlans', 'pricingComparison'));
    }
          public function buyNow(Request $request)
    {
        return view('invoice_front.buyNow');
    }

    
           public function FAQS(Request $request)
    {
        $faqs = Faq::orderBy('id')->get();

        return view('invoice_front.faqs', compact('faqs'));
    }
            public function privacypolicy(Request $request)
    {
        return view('invoice_front.privacy-policy');
    }
             public function termsconditions(Request $request)
    {
        return view('invoice_front.terms-conditions');
    }

               public function help(Request $request)
    {
        return view('invoice_front.help');
    }
    
               public function refundandcancellation(Request $request)
    {
        return view('invoice_front.refund-and-cancellation');
    }       

               public function integration(Request $request)
    {
        return view('invoice_front.integration');
    }
                public function videos(Request $request)
    {
        $videos = TutorialVideo::orderBy('id')->get();

        return view('invoice_front.videos', [
            'videos' => $videos,
            'categories' => TutorialVideo::CATEGORIES,
        ]);
    }
        //   public function pricing(){
        //     return view('invoice_front.pricing');
        //   }
        //   public function contact(){
        //     return view('invoice_front.contact');
        //   }
        //   public function faqs(){
        //       return view('invoice_front.faqs');
        //   }
        //   public function privacypolicy(){
        //       return view('invoice_front.privacy-policy');
        //   }
        //   public function refundpolicy(){
        //       return view('invoice_front.refund-policy');
        //   }
        //   public function termsconditions(){
        //       return view('invoice_front.terms-condition');
        //   }


          // =======================solutions==========================
             public function invoiceandsolution(Request $request)
    {
        $page = CmsInvoiceSolutionPage::firstOrCreate(
            [],
            ['content' => CmsInvoiceSolutionPage::defaultContent()]
        );
        $faqs = Faq::orderBy('id')->limit(4)->get();
        $relatedSolutionConfig = [
            'Barcode & RFID Tagging' => [
                'url' => '/barcode-and-rfid-tagging',
                'icon' => 'bi bi-upc-scan',
            ],
            'Old Gold Exchange' => [
                'url' => '/old-gold-exchange',
                'icon' => 'bi bi-arrow-left-right',
            ],
            'Discount & Scheme Management' => [
                'url' => '/discount-and-scheme-management',
                'icon' => 'bi bi-percent',
            ],
        ];
        $solutionsByTitle = CmsSolution::whereIn('title', array_keys($relatedSolutionConfig))
            ->where('is_active', true)
            ->get()
            ->keyBy('title');
        $relatedSolutions = collect($relatedSolutionConfig)
            ->map(function ($config, $title) use ($solutionsByTitle) {
                $solution = $solutionsByTitle->get($title);

                if ($solution) {
                    $solution->setAttribute('page_url', $config['url']);
                    $solution->setAttribute('page_icon', $config['icon']);
                }

                return $solution;
            })
            ->filter()
            ->values();

        return view('invoice_front.invoice-and-solution', [
            'pageContent' => $page->content,
            'faqs' => $faqs,
            'relatedSolutions' => $relatedSolutions,
        ]);
    }
           public function purchasemanagement(Request $request)
    {
        return view('invoice_front.purchase-management');
    }
           public function karigarandjobwork(Request $request)
    {
        return view('invoice_front.karigar-and-job-work');
    }
      public function barcodeandrfidtagging(Request $request)
    {
        return view('invoice_front.barcode-and-rfid-tagging');
    }
  public function realtimemisreport(Request $request)
    {
        return view('invoice_front.real-time-mis-report');
    }
   public function discountandschememanagement(Request $request)
    {
        return view('invoice_front.discount-and-scheme-management');
    }
  public function multibranchmanagement(Request $request)
    {
        return view('invoice_front.multi-branch-management');
    }
   
     public function oldgoldexchange(Request $request)
    {
        return view('invoice_front.old-gold-exchange');
    }
        public function inventorymanagement(Request $request)
    {
        return view('invoice_front.inventory-management');
    }
}
