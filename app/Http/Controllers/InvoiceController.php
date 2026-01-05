<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\InvoiceItem;
use App\Models\bankdetails;
use App\Models\BusinessDetail;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\CustomFieldDefinition;
use App\Models\CustomFieldValue;
use App\Models\InvoiceColumn;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;



class InvoiceController extends Controller
{
    // public function create()
    // {
    //     $customers = Customer::where('admin_id', Auth::id())->get();
    //     $banks = bankdetails::where('user_id', Auth::id())->get();
    //     $business = BusinessDetail::where('user_id', Auth::id())->first();

    //     // Fetch products along with HSN Code
    //     $products = InvoiceItem::whereHas('invoice', function ($query) {
    //             $query->where('admin_id',  Auth::id());
    //         })
    //         ->select('product_name', 'rate', 'hsn_code_id') // Include HSN Code
    //         ->distinct()
    //         ->get();
    //       dd($products->toArray());
    //     return view('Sales/Invoices/add-invoice', compact('customers', 'products', 'banks', 'business'));
    // }
    public function invoices()
    {
        $invoices = Invoice::with('customer')
            ->where('admin_id', Auth::id())
            ->get();

        return view('Sales/Invoices/invoices', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::where('admin_id', Auth::id())->get();
        $banks = bankdetails::where('user_id', Auth::id())->get();
        $business = BusinessDetail::where('user_id', Auth::id())->first();

        // Fetch products along with HSN Code from the HSN master table
        $products1 = InvoiceItem::whereHas('invoice', function ($query) {
            $query->where('admin_id',  Auth::id());
        })

            ->leftJoin('hsn_codes', 'invoice_items.hsn_code_id', '=', 'hsn_codes.id') // Join with HSN table
            ->select('invoice_items.product_name', 'invoice_items.rate', 'hsn_codes.hsn_code') // Fetch HSN Code
            ->distinct()
            ->get();
        // dd($products);exit();
        $notes = DB::table('invoice_notes_terms')
            ->where('admin_id', Auth::id())
            ->where('type', 'note')
            ->get();
        $terms = DB::table('invoice_notes_terms')
            ->where('admin_id', Auth::id())
            ->where('type', 'term')
            ->get();

        $adminId = Auth::id();

        $columns = InvoiceColumn::orderBy('id')->where('user_id', $adminId)->get();

        $allColumns = InvoiceColumn::where('user_id', $adminId)
            ->where('is_visible', true)
            ->get()
            ->map(function ($col) {
                return [
                    'name' => $col->name,
                    'key' => $col->key ?? Str::slug(strtolower($col->name), '_'),
                    'type' => $col->type,
                    'is_custom' => $col->is_custom,
                    'is_visible' => $col->is_visible,
                    'position' => $col->position,
                ];
            })
            ->sortBy('position')
            ->values()
            ->all();


        $visibleColumns = InvoiceColumn::where('user_id', $adminId)
            // ->where('is_visible', true)
            ->orderBy('position')
            ->get()->map(function ($col) {
                return [
                    'name' => $col->name,
                    'key' => $col->key ?? Str::slug(strtolower($col->name), '_'),
                    'type' => $col->type,
                    'is_custom' => $col->is_custom,
                    'is_visible' => $col->is_visible,
                    'position' => $col->position,
                ];
            })
            ->sortBy('position')
            ->values()
            ->all();

        $customFields = CustomFieldDefinition::where('admin_id', $adminId)
            ->where('model_type', 'App\Models\Invoice') // or use constant if you prefer
            ->get();
      $products = Product::with(['category', 'subcategory', 'metalRate', 'diamonds', 'stones'])->get();


        $categories = Category::all();
        $subcategories = Subcategory::all();



        return view('Sales/Invoices/add-invoice', compact('customers', 'products', 'categories', 'subcategories', 'banks', 'business', 'notes', 'terms', 'customFields', 'allColumns', 'visibleColumns'));
    }
    public function updatecolumns(Request $request)
    {
        $userId = Auth::id();
        $columns = $request->input('columns', []);

        foreach ($columns as $key => $data) {
            $existing = InvoiceColumn::where('key', $key)->where('user_id', $userId)->first();
            //   return response()->json(['status' => $existing]);
            if ($existing) {
                // Update existing column
                // if ($existing->is_custom) {
                //     $existing->name = $data['name'];
                //     $existing->type = $data['type'];
                // }
                $existing->name = $data['name'];
                if ($existing->is_custom) {
                    $existing->type = $data['type'];
                }

                $existing->is_visible = isset($data['is_visible']);
                $existing->save();
            } else {
                // Add new custom column
                InvoiceColumn::create([
                    'user_id' => $userId,
                    'name' => $data['name'],
                    'key' => $key,
                    'type' => $data['type'],
                    'is_custom' => true,
                    'is_visible' => isset($data['is_visible']),
                    'position' => InvoiceColumn::where('user_id', $userId)->max('position') + 1,
                ]);
            }
        }

        // Optionally: delete missing custom columns (if user removed row)
        $existingKeys = collect($columns)->keys();
        InvoiceColumn::where('user_id', $userId)
            ->where('is_custom', true)
            ->whereNotIn('key', $existingKeys)
            ->delete();

        // return response()->json(['status' => 'success']);

        $updatedColumns = InvoiceColumn::where('user_id', $userId)->where('is_visible', true)->get();

        return response()->json(['columns' => $updatedColumns]);
        // return response()->json([
        //     'status' => 'success',
        //     'columns' => InvoiceColumn::where('user_id', $userId)
        //         ->orderBy('position')
        //         ->get()
        //         ->map(function ($col) {
        //             return [
        //                 'name' => $col->name,
        //                 'key' => Str::slug(strtolower($col->name), '_'),
        //                 'type' => $col->type,
        //                 'is_custom' => $col->is_custom,
        //                 'is_visible' => $col->is_visible,
        //                 'position' => $col->position,
        //             ];
        //         })
        // return response()->json([
        //     'status' => 'success',
        //     'columns' => InvoiceColumn::where('user_id', Auth::id())
        //         ->where('is_visible', true)
        //         ->orderBy('position')
        //         ->get(['key', 'name', 'type'])
        // ]);
    }

    public function invoice_columns_index(Request $request)
    {
        $adminId = Auth::id();
        $allColumns = InvoiceColumn::where('user_id', $adminId)
            ->where('is_visible', true)
            ->get();
        // ->map(function ($col) {
        //     return [
        //         'name' => $col->name,
        //         'key' => $col->key ?? Str::slug(strtolower($col->name), '_'),
        //         'type' => $col->type,
        //         'is_custom' => $col->is_custom,
        //         'is_visible' => $col->is_visible,
        //         'position' => $col->position,
        //     ];
        // })
        // ->sortBy('position')
        // ->values()
        // ->all();
        return response()->json(['columns' => $allColumns]);
    }
    // public function store(Request $request)
    // {



    //     $invoice = Invoice::create([
    //         'admin_id' => Auth::id(),
    //         'customer_id' => $request->customer_id,
    //         'invoice_number' => 'INV-' . time(),
    //         'invoice_date'    => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
    //         'due_date'        => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
    //         'total_amount' => collect($request->products)->sum(fn($p) => $p['quantity'] * $p['price']),
    //         'notes' => $request->notes,
    //         'terms' => $request->terms,


    //     ]);
    //     // dd($invoice);exit();
    //     $products = $request->products ?? [];
    //     //   dd($products);exit();
    //     if (!empty($products)) {

    //         // Check if it's single product (not in array of arrays)
    //         if (isset($products['name'])) {
    //             $products = [$products]; // Wrap single product in array
    //         }

    //         foreach ($products as $product) {
    //             InvoiceItem::create([
    //                 'invoice_id' => $invoice->id,
    //                 'product_name'       => $product['name'],
    //                 'quantity'   => $product['quantity'],
    //                 'rate'      => $product['price'],
    //                 'total'      => $product['quantity'] * $product['price'],
    //                 'admin_id' => Auth::id(),
    //                 'discount' => $product['discount'] ?? 0,
    //                 'tax' => $product['gst'] ?? 0,
    //                 'cgst' => $product['cgst'] ?? 0,
    //                 'sgst' => $product['sgst'] ?? 0,
    //                 'igst' =>  $product['igst'] ?? 0,
    //             ]);
    //         }
    //     }
    //     // Save existing predefined field values
    //     foreach ($request->input('custom_fields_existing', []) as $fieldId => $value) {
    //         CustomFieldValue::create([
    //             'custom_field_definition_id' => $fieldId,
    //             'model_type' => Invoice::class,
    //             'model_id' => $invoice->id,
    //             'value' => $value,
    //         ]);
    //     }

    //     // Save new field definitions + values
    //     foreach ($request->input('custom_fields_new', []) as $input) {
    //         $label = trim($input['label'] ?? '');
    //         $value = trim($input['value'] ?? '');

    //         if ($label === '' || $value === '') continue;

    //         $definition = CustomFieldDefinition::firstOrCreate([
    //             'admin_id' => Auth::id(),
    //             'model_type' => Invoice::class,
    //             'field_label' => $label
    //         ], [
    //             'field_key' => \Str::slug($label, '_'),
    //             'field_type' => 'text'
    //         ]);

    //         CustomFieldValue::create([
    //             'custom_field_definition_id' => $definition->id,
    //             'model_type' => Invoice::class,
    //             'model_id' => $invoice->id,
    //             'value' => $value,
    //         ]);
    //     }



    //     return redirect()->route('invoice-details', ['uuid' => $invoice->uuid])->with('success', 'Invoice created successfully.');
    // }
    public function store(Request $request)
    {


        $products = $request->products ?? [];
        $totalAmount = is_array($products)
            ? collect($products)->sum(fn($p) => $p['quantity'] * $p['price'])
            : 0;

        // Create the invoice
        $invoice = Invoice::create([
            'admin_id' => Auth::id(),
            'customer_id' => $request->customer_id,
            'invoice_number' => 'INV-' . time(),
            'invoice_date' => Carbon::createFromFormat('d-m-Y', $request->invoice_date)->format('Y-m-d'),
            'due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
            'total_amount' => $totalAmount,
            'notes' => $request->notes,
            'terms' => $request->terms,
        ]);

        // Save invoice items
        if (!empty($products)) {
            if (isset($products['name'])) {
                $products = [$products]; // Wrap single product
            }

            foreach ($products as $product) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_name' => $product['name'],
                    'quantity' => $product['quantity'],
                    'rate' => $product['price'],
                    'total' => $product['quantity'] * $product['price'],
                    'admin_id' => Auth::id(),
                    'discount' => $product['discount'] ?? 0,
                    'tax' => $product['gst'] ?? 0,
                    'cgst' => $product['cgst'] ?? 0,
                    'sgst' => $product['sgst'] ?? 0,
                    'igst' => $product['igst'] ?? 0,
                ]);
            }
        }

        // Save predefined custom field values
        if ($request->filled('custom_fields_existing')) {
            foreach ($request->input('custom_fields_existing') as $fieldId => $value) {
                CustomFieldValue::create([
                    'custom_field_definition_id' => $fieldId,
                    'model_type' => Invoice::class,
                    'model_id' => $invoice->id,
                    'value' => $value,
                ]);
            }
        }

        // Save new custom fields and their values
        if ($request->filled('custom_fields_new')) {
            foreach ($request->input('custom_fields_new') as $input) {
                $label = trim($input['label'] ?? '');
                $value = trim($input['value'] ?? '');

                if ($label === '' || $value === '') continue;

                $definition = CustomFieldDefinition::firstOrCreate([
                    'admin_id' => Auth::id(),
                    'model_type' => Invoice::class,
                    'field_label' => $label,
                ], [
                    'field_key' => Str::slug($label, '_'),
                    'field_type' => 'text',
                ]);

                CustomFieldValue::create([
                    'custom_field_definition_id' => $definition->id,
                    'model_type' => Invoice::class,
                    'model_id' => $invoice->id,
                    'value' => $value,
                ]);
            }
        }



        return redirect()->route('invoice-details', ['uuid' => $invoice->uuid])
            ->with('success', 'Invoice created successfully.');
    }

    public function getCustomerDetails(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        if ($customer) {
            return response()->json([
                'success' => true,
                'customer' => $customer
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    public function invoice_details($uuid)
    {
        $invoice = Invoice::with(['customer', 'items', 'bank', 'business', 'users'])
            ->where('uuid', $uuid)
            ->where('admin_id', Auth::id())
            ->firstOrFail();

        return view('Sales/Invoices/invoice-details', compact('invoice'));
    }
    public function edit_invoice($uuid)
    {
        $invoice = Invoice::with(['customer', 'items', 'bank', 'business', 'users'])
            ->where('uuid', $uuid)
            ->where('admin_id', Auth::id())
            ->firstOrFail();
        $business = BusinessDetail::where('user_id', Auth::id())->first();
        $customers = Customer::where('admin_id', Auth::id())->get();
        $banks = bankdetails::where('user_id', Auth::id())->get();
        // Fetch products along with HSN Code from the HSN master table
        $products = InvoiceItem::whereHas('invoice', function ($query) {
            $query->where('admin_id',  Auth::id());
        })




            ->leftJoin('hsn_codes', 'invoice_items.hsn_code_id', '=', 'hsn_codes.id') // Join with HSN table
            ->select('invoice_items.product_name', 'invoice_items.rate', 'hsn_codes.hsn_code') // Fetch HSN Code
            ->distinct()
            ->get();
        $notes = DB::table('invoice_notes_terms')
            ->where('admin_id', Auth::id())
            ->where('type', 'note')
            ->get();
        $terms = DB::table('invoice_notes_terms')
            ->where('admin_id', Auth::id())
            ->where('type', 'term')
            ->get();

        // foreach ($invoice->items as $item) {
        //     echo $item->product_name . '<br>';
        // }


        // dd($invoice->items);

        return view('Sales/Invoices/edit-invoice', compact('invoice', 'customers', 'products', 'banks', 'notes', 'terms', 'business'));
    }
}
