
document.addEventListener('input', function (e) {

    // Only trigger calculation for relevant inputs
    if (!e.target.closest('#entryTable')) return;

    calculateRow(e.target.closest('tr'));
});

function calculateRow(row) {

    let metalRate      = parseFloat(row.querySelector('input[name="metal_rate[]"]').value) || 0;
    let qty            = parseFloat(row.querySelector('input[name="quantity[]"]').value) || 1;
    let netWeight      = parseFloat(row.querySelector('input[name="net_weight[]"]').value) || 0;
    let wastagePercent = parseFloat(row.querySelector('input[name="wastage_percent[]"]').value) || 0;
    let makingPrice    = parseFloat(row.querySelector('input[name="making_price[]"]').value) || 0;
    let gstPercent     = parseFloat(row.querySelector('input[name="gst_percent[]"]').value) || 0;

    // Gold Amount
    let goldAmount = metalRate * netWeight * qty;

    // Wastage Amount
    let wastageAmount = (goldAmount * wastagePercent) / 100;

    // Subtotal
    let subTotal = goldAmount + makingPrice;

    // GST Amount
    let gstAmount = (subTotal * gstPercent) / 100;

    // Total Amount
    let totalAmount = subTotal + gstAmount;

    // Update inputs
    row.querySelector('input[name="gst_amount[]"]').value = gstAmount.toFixed(2);
    row.querySelector('input[name="total_amount[]"]').value = totalAmount.toFixed(2);
}

