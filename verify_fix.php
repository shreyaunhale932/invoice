<?php

use App\Models\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Initialize dummy session
Session::put('selected_firm_id', 1);

// Test Account model
$sql = Account::toSql();
echo "Account SQL: " . $sql . "\n";

if (str_contains($sql, '`accounts`.`firm_id`')) {
    echo "SUCCESS: Account firm_id is prefixed.\n";
} else {
    echo "FAILURE: Account firm_id is NOT prefixed.\n";
}

// Test join scenario similar to the error
$query = Account::whereHas('group', function ($q) {
    $q->where('type', 'Income');
})->join('journal_entry_lines', 'accounts.id', '=', 'journal_entry_lines.account_id');

$sqlJoin = $query->toSql();
echo "Join SQL: " . $sqlJoin . "\n";

// Check if there are any unprefixed 'where `firm_id` =' or 'and `firm_id` ='
// The ambiguity error happens because both tables have firm_id and the global scope adds it for both.
// With my fix, it should be `accounts`.`firm_id` and `journal_entry_lines`.`firm_id`.

if (str_contains($sqlJoin, '`accounts`.`firm_id`') && str_contains($sqlJoin, '`journal_entry_lines`.`firm_id`')) {
    echo "SUCCESS: Both joined tables have prefixed firm_id.\n";
} else {
    echo "FAILURE: Join SQL does not have correctly prefixed firm_id.\n";
}
