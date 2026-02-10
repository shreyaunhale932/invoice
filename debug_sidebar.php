<?php
use Illuminate\Support\Facades\Auth;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::capture());

echo "Web Guard Check: " . (Auth::guard('web')->check() ? 'True' : 'False') . "\n";
if (Auth::guard('web')->check()) {
    echo "Web User Role: " . Auth::guard('web')->user()->role . "\n";
}

echo "Admin Guard Check: " . (Auth::guard('admin')->check() ? 'True' : 'False') . "\n";
if (Auth::guard('admin')->check()) {
    echo "Admin User ID: " . Auth::guard('admin')->id() . "\n";
}
