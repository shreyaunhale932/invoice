<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SellInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\PurityModel;
use App\Models\MetalRate;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customers(Request $request)
    {
        $query = Customer::where('admin_id', Auth::guard('admin')->id());
        
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $customers = $query->get();
        return view('Customers/customers', compact('customers'));
    }
    public function addcustomer()
    {

        return view('Customers/add-customer');
    }
    public function store(Request $request)
{
    // dd($request);
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string',
        'country' => 'nullable|string',
        'state' => 'nullable|string',
        'city' => 'nullable|string',
        'pincode' => 'nullable|string|max:10',
        'bank_name' => 'nullable|string|max:255',
        'branch' => 'nullable|string|max:255',
        'account_holder_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'ifsc' => 'nullable|string|max:20',
        'gst_no' => 'nullable|string|max:50',
        'adhaar_no' => 'nullable|string|max:50',
        'pan_no' => 'nullable|string|max:50',
        'tan' => 'nullable|string|max:50',
        'dob' => 'nullable|date',
        'anniversary_date' => 'nullable|date',
    ]);

    $customer = Customer::create([
        'admin_id' => Auth::guard('admin')->id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'country' => $request->country,
        'state' => $request->state,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'bank_name' => $request->bank_name,
        'branch' => $request->branch,
        'account_holder_name' => $request->account_holder_name,
        'account_number' => $request->account_number,
        'ifsc' => $request->ifsc,
        'gst_no' => $request->gst_no,
        'adhaar_no' => $request->adhaar_no,
        'pan_no' => $request->pan_no,
        'tan' => $request->tan,
        'dob' => $request->dob,
        'anniversary_date' => $request->anniversary_date,
    ]);

    // AJAX request
    if ($request->ajax()) {

        return response()->json([
            'success' => true,
            'customer' => $customer
        ]);
    }

    return redirect()->route('customers')
        ->with('success', 'Customer added successfully!');
}
    public function addproducts()
    {
        $adminId = Auth::guard('admin')->id();

        $categories = Category::where('admin_id', $adminId)
            ->orderBy('category_id', 'DESC')
            ->get();

        $subcategories = Subcategory::where('admin_id', $adminId)
            ->orderBy('subcategory_id', 'DESC')
            ->get();

        $purities = PurityModel::where('admin_id', $adminId)
            ->orderBy('id', 'DESC')
            ->get();

        $metalRates = MetalRate::where('admin_id', $adminId)
            ->orderBy('id', 'DESC')
            ->get();

        $lastBarcode = Product::where('admin_id', $adminId)
            ->orderBy('id', 'DESC')
            ->value('barcode');

        if ($lastBarcode) {

            // Case 1: Barcode is only number (1002)
            if (ctype_digit($lastBarcode)) {
                $newBarcode = (int)$lastBarcode + 1;
            }
            // Case 2: Barcode has prefix + number (GLD001 / NBB00021)
            else {

                preg_match('/^([A-Za-z]+)(\d+)$/', $lastBarcode, $matches);

                if (count($matches) == 3) {
                    $prefix = $matches[1];
                    $number = $matches[2];

                    $incremented = (int)$number + 1;

                    // Keep same zero format
                    $newNumber = str_pad($incremented, strlen($number), '0', STR_PAD_LEFT);

                    $newBarcode = $prefix . $newNumber;
                } else {
                    // fallback
                    $newBarcode = 1001;
                }
            }
        } else {
            $newBarcode = 1001;
        }

        $stones = \App\Models\Stone::all();
        $clarities = \App\Models\Clarity::all();
        $colors = \App\Models\Color::all();
        $cuts = \App\Models\Cut::all();
        $mms = \App\Models\Mm::all();
        $chalnis = \App\Models\Chalni::all();
        $shapes = \App\Models\Shape::all();
        $packet_types = \App\Models\PacketType::all();

        return view('Inventory/Products/add-products', compact(
            'categories',
            'subcategories',
            'purities',
            'metalRates',
            'newBarcode',
            'stones',
            'clarities',
            'colors',
            'cuts',
            'mms',
            'chalnis',
            'shapes',
            'packet_types'
        ));
    }
    public function edit($id)
    {
        $customer = Customer::where('id', $id)->where('admin_id', Auth::guard('admin')->id())->firstOrFail();
        return view('Customers/edit-customer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::where('id', $id)->where('admin_id', Auth::guard('admin')->id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'bank_name' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc' => 'nullable|string|max:20',
            'gst_no' => 'nullable|string|max:50',
            'adhaar_no' => 'nullable|string|max:50',
            'pan_no' => 'nullable|string|max:50',
            'tan' => 'nullable|string|max:50',
            'dob' => 'nullable|date',
            'anniversary_date' => 'nullable|date',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc' => $request->ifsc,
            'gst_no' => $request->gst_no,
            'adhaar_no' => $request->adhaar_no,
            'pan_no' => $request->pan_no,
            'tan' => $request->tan,
            'dob' => $request->dob,
            'anniversary_date' => $request->anniversary_date,
        ]);

        return redirect()->route('customers')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->where('admin_id', Auth::guard('admin')->id())->firstOrFail();
        $customer->delete();

        return redirect()->route('customers')->with('success', 'Customer deleted successfully!');
    }

    public function exportPdf()
    {
        $customers = Customer::where('admin_id', Auth::guard('admin')->id())->get();
        $pdf = Pdf::loadView('pdf.customers', compact('customers'))->setPaper('A4', 'portrait');
        return $pdf->download('customer-list.pdf');
    }

    public function exportCsv(Request $request)
    {
        $query = Customer::where('admin_id', Auth::guard('admin')->id());
        
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $customers = $query->get();
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=customer-list.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Name', 'Phone', 'Email', 'City', 'Created At'];

        $callback = function() use($customers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->phone,
                    $customer->email,
                    $customer->city,
                    $customer->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function details($id)
    {
        $customer = Customer::where('id', $id)->where('admin_id', Auth::guard('admin')->id())->firstOrFail();
        
        $invoices = SellInvoice::where('user_id', $id)
            ->where('admin_id', Auth::guard('admin')->id())
            ->orderBy('id', 'desc')
            ->get();
            
        $cards = [
            [
                'title' => 'Total Invoice',
                'class' => 'bg-info-light',
                'icon'  => 'receipt-item.svg',
                'amount' => $invoices->sum('final_amount'),
                'number_of_invoice' => $invoices->count(),
            ],
            [
                'title' => 'Outstanding',
                'class' => 'bg-primary-light',
                'icon'  => 'transaction-minus.svg',
                'amount' => $invoices->where('amount_left', '>', 0)->sum('amount_left'),
                'number_of_invoice' => $invoices->where('amount_left', '>', 0)->count(),
            ],
            [
                'title' => 'Total Overdue',
                'class' => 'bg-warning-light',
                'icon'  => 'archive-book.svg',
                'amount' => $invoices
                    ->whereIn('status', ['pending', 'partial'])
                    ->sum('amount_left'),
                'number_of_invoice' => $invoices->whereIn('status', ['pending', 'partial'])->count(),
            ],
            [
                'title' => 'Recurring',
                'class' => 'bg-danger-light',
                'icon'  => '3d-rotate.svg',
                'amount' => $invoices->where('status', 'partial')->sum('final_amount'),
                'number_of_invoice' => $invoices->where('status', 'partial')->count(),
            ],
        ];

        return view('Customers/customer-details', compact('customer', 'invoices', 'cards'));
    }
}

