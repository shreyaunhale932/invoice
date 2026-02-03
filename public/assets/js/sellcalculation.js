document.addEventListener('input', function (e) {
    if (!e.target.closest('#entryTable')) return;
    calculateRow(e.target.closest('tr'));
});

function calculateRow(row) {

    const metalRate       = parseFloat(row.querySelector('[name="metal_rate[]"]').value) || 0;
    const finalFnWeight   = parseFloat(row.querySelector('[name="final_fn_weight[]"]').value) || 0;
    const wastagePercent  = parseFloat(row.querySelector('[name="wastage_percent[]"]').value) || 0;
    const makingPrice     = parseFloat(row.querySelector('[name="making_price[]"]').value) || 0;
    const gstPercent      = parseFloat(row.querySelector('[name="gst_percent[]"]').value) || 0;

    // ✅ Gold Amount (MAIN FORMULA)
    const goldAmount = finalFnWeight * metalRate;

    // Wastage
    const wastageAmount = (goldAmount * wastagePercent) / 100;

    // Subtotal (gold + wastage + making)
    const subTotal = goldAmount +  makingPrice;

    // GST
    const gstAmount = (subTotal * gstPercent) / 100;

    // Total gold amount (without diamond/stone)
    const totalAmount = subTotal;

    row.querySelector('[name="gst_amount[]"]').value = gstAmount.toFixed(2);
    row.querySelector('[name="total_amount[]"]').value = totalAmount.toFixed(2);

    updateGoldFinalPrice(row);
}



$(document).on('input', '.diamond-weight, .price-per-carat', function () {
    const row = $(this).closest('tr');

    const weight = parseFloat(row.find('.diamond-weight').val()) || 0;
    const rate   = parseFloat(row.find('.price-per-carat').val()) || 0;

    const total = weight * rate;
    row.find('.diamond-total').val(total.toFixed(2));

    updateGoldFinalPrice(row);
});


$(document).on('input', '.stone-weight, .stone-price', function () {
    const row = $(this).closest('tr');

    const weight = parseFloat(row.find('.stone-weight').val()) || 0;
    const rate = parseFloat(row.find('.stone-price').val()) || 0;

    const total = weight * rate;

    row.find('.stone-total').val(total.toFixed(2));

    updateGoldFinalPrice();
});


function updateGoldFinalPrice() {

    let diamondTotal = 0;
    let stoneTotal = 0;

    $('.diamond-total').each(function () {
        diamondTotal += parseFloat($(this).val()) || 0;
    });

    $('.stone-total').each(function () {
        stoneTotal += parseFloat($(this).val()) || 0;
    });

    const goldPrice = parseFloat($('input[name="total_amount[]"]').val()) || 0;

    const finalPrice = goldPrice + diamondTotal + stoneTotal;

    // alert('finalPrice=' + finalPrice);

    $('input[name="final_price[]"]').val(finalPrice.toFixed(2));
}




// ---------------------------------------------------------
// INVOICE CALCULATION ENGINE
// ---------------------------------------------------------
