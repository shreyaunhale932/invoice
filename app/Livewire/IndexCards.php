<?php

namespace App\Livewire;

use Livewire\Component;

class IndexCards extends Component
{
    public function render()
    {
        $adminId = auth()->id();

        $amountDue = \App\Models\SellInvoice::where('admin_id', $adminId)->sum('amount_left');
        $customersCount = \App\Models\Customer::where('admin_id', $adminId)->count();
        $invoicesCount = \App\Models\SellInvoice::where('admin_id', $adminId)->count();
        // $estimatesCount = \App\Models\Invoice::where('admin_id', $adminId)->count();

        $cards = [
            [
                "dash-widget-icon" => "dash-widget-icon bg-1",
                "icon-class" => "fa-solid fa-indian-rupee-sign",
                "dash-title" => "Amount Due",
                "dash-counts" => number_format($amountDue, 2),
                "progress-bar" => "progress-bar bg-5",
                "progress-width" => "75%",
                "progress-aria" => "75",
                "arrow-class" => "fas fa-arrow-down me-1",
                "arrow-color" => "text-danger me-1",
                "since-last-week" => "0%"
            ],
            [
                "dash-widget-icon" => "dash-widget-icon bg-2",
                "icon-class" => "fas fa-users",
                "dash-title" => "Customers",
                "dash-counts" => number_format($customersCount),
                "progress-bar" => "progress-bar bg-6",
                "progress-width" => "65%",
                "progress-aria" => "65",
                "arrow-class" => "fas fa-arrow-up me-1",
                "arrow-color" => "text-success me-1",
                "since-last-week" => "0%"
            ],
            [
                "dash-widget-icon" => "dash-widget-icon bg-3",
                "icon-class" => "fas fa-file-alt",
                "dash-title" => "Invoices",
                "dash-counts" => number_format($invoicesCount),
                "progress-bar" => "progress-bar bg-7",
                "progress-width" => "85%",
                "progress-aria" => "85",
                "arrow-class" => "fas fa-arrow-up me-1",
                "arrow-color" => "text-success me-1",
                "since-last-week" => "0%"
            ],
            [
                "dash-widget-icon" => "dash-widget-icon bg-4",
                "icon-class" => "far fa-file",
                "dash-title" => "Estimates",
                "dash-counts" => number_format(0),
                "progress-bar" => "progress-bar bg-8",
                "progress-width" => "45%",
                "progress-aria" => "45",
                "arrow-class" => "fas fa-arrow-down me-1",
                "arrow-color" => "text-danger me-1",
                "since-last-week" => "0%"
            ]
        ];

        return view('livewire.index-cards', compact('cards'));
    }
}
