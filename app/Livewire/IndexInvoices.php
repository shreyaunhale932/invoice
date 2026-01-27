<?php

namespace App\Livewire;

use Livewire\Component;

class IndexInvoices extends Component
{
    public function render()
    {
        $adminId = auth()->id();
        $invoices = \App\Models\SellInvoice::with('customer')
            ->where('admin_id', $adminId)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.index-invoices', compact('invoices'));
    }
}
