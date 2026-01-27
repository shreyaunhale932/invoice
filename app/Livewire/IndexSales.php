<?php

namespace App\Livewire;

use Livewire\Component;

class IndexSales extends Component
{
    public function render()
    {
        $adminId = auth()->id();
        
        $totalSales = \App\Models\SellInvoice::where('admin_id', $adminId)->sum('final_amount');
        $receipts = \App\Models\SellInvoice::where('admin_id', $adminId)->sum('total_received');
        $expenses = \App\Models\Expense::where('admin_id', $adminId)->sum('amount');
        $earnings = $receipts - $expenses;

        return view('livewire.index-sales', [
            'totalSales' => $totalSales,
            'receipts' => $receipts,
            'expenses' => $expenses,
            'earnings' => $earnings,
        ]);
    }
}
