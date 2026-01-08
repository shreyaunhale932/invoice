
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


     updateGoldFinalPrice(row);
}


$(document).on('input', '.diamond-weight, .price-per-carat', function () {
    const row = $(this).closest('tr');

    const weight = parseFloat(row.find('.diamond-weight').val()) || 0;
    const rate   = parseFloat(row.find('.price-per-carat').val()) || 0;

    const total = weight * rate;

    row.find('.diamond-total').val(total.toFixed(2));

    updateGoldFinalPrice();
});

$(document).on('input', '.stone-weight, .stone-price', function () {
    const row = $(this).closest('tr');

    const weight = parseFloat(row.find('.stone-weight').val()) || 0;
    const rate   = parseFloat(row.find('.stone-price').val()) || 0;

    const total = weight * rate;

    row.find('.stone-total').val(total.toFixed(2));

    updateGoldFinalPrice();
});


function updateGoldFinalPrice() {

    let diamondTotal = 0;
    let stoneTotal   = 0;

    $('.diamond-total').each(function () {
        diamondTotal += parseFloat($(this).val()) || 0;
    });

    $('.stone-total').each(function () {
        stoneTotal += parseFloat($(this).val()) || 0;
    });

    const goldPrice = parseFloat($('input[name="total_amount[]"]').val()) || 0;

    const finalPrice = goldPrice + diamondTotal + stoneTotal;

    $('input[name="final_price[]"]').val(finalPrice.toFixed(2));
}



