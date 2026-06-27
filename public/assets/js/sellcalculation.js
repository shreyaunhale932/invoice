document.addEventListener('input', function (e) {
    if (!e.target.closest('#entryTable')) return;
    calculateRow(e.target.closest('tr'));
});
// For making_price input
document.addEventListener('input', function (e) {
    if (e.target.matches('[name="making_price[]"]')) {
        const row = e.target.closest('tr');
        calculateRow(row);
    }
});

// For making_type select
document.addEventListener('change', function (e) {
    if (e.target.matches('[name="making_type[]"]')) {
        const row = e.target.closest('tr');
        calculateRow(row);
    }
});function calculateRow(row) {
    if (!row) return;
    if (row.jquery) {
        row = row[0];
    }

    const getVal = (sel) => {
        const el = row.querySelector(sel);
        return el ? (parseFloat(el.value) || 0) : 0;
    };

    const metalRate = getVal('[name="metal_rate[]"]');
    const finalFnWeight = getVal('[name="final_fn_weight[]"]');
    const grossWeight = getVal('[name="gross_weight[]"]');
    const netWeight = getVal('[name="net_weight[]"]');
    const wastagePercent = getVal('[name="wastage_percent[]"]');
    const makingPrice = getVal('[name="making_price[]"]');
    const gstPercent = getVal('[name="gst_percent[]"]');
    
    const makingTypeEl = row.querySelector('[name="making_type[]"]');
    const makingType = makingTypeEl ? makingTypeEl.value : 'val';

    // ✅ GOLD AMOUNT (on Net Weight)
    const goldAmount = netWeight * metalRate;

    // ✅ WASTAGE AMOUNT (on Net Weight)
    const wastageAmount = (netWeight * wastagePercent / 100) * metalRate;

    // Set wastage amount input in row
    const wastageInput = row.querySelector('[name="wastage_amount[]"]');
    if (wastageInput) {
        wastageInput.value = wastageAmount.toFixed(2);
    }

    // ✅ MAKING CALCULATION BASED ON TYPE
    let makingFinalAmount = 0;

    switch (makingType) {
        case 'val': // Direct Value
            makingFinalAmount = makingPrice;
            break;
        case 'per_gld_val': // % of Gold Value
            makingFinalAmount = (goldAmount * makingPrice) / 100;
            break;
        case 'per_pcs': // per piece
            const qty = getVal('[name="quantity[]"]') || 1;
            makingFinalAmount = makingPrice * qty;
            break;
        case 'per_gm_nw': // net weight
            makingFinalAmount = makingPrice * netWeight;
            break;
        case 'per_gm_gw': // gross weight
            makingFinalAmount = makingPrice * grossWeight;
            break;
        case 'per_gm_fine_wt': // fine weight
            makingFinalAmount = makingPrice * finalFnWeight;
            break;
        default:
            makingFinalAmount = makingPrice;
    }

    // Set making final amount
    const makingFinalAmountInput = row.querySelector('[name="making_final_amount[]"]');
    if (makingFinalAmountInput) {
        makingFinalAmountInput.value = makingFinalAmount.toFixed(2);
    }

    // ✅ GOLD TOTAL (add goldAmount + wastageAmount + making)
    const subTotal = goldAmount + wastageAmount + makingFinalAmount;

    // GST
    const gstAmount = (subTotal * gstPercent) / 100;

    const gstAmountInput = row.querySelector('[name="gst_amount[]"]');
    if (gstAmountInput) {
        gstAmountInput.value = gstAmount.toFixed(2);
    }

    const totalAmountInput = row.querySelector('[name="total_amount[]"]');
    if (totalAmountInput) {
        totalAmountInput.value = subTotal.toFixed(2);
    }

    updateGoldFinalPrice(row);
}
$(document).on('input', '.diamond-weight, .price-per-carat', function () {
    const row = $(this).closest('tr');

    const weight = parseFloat(row.find('.diamond-weight').val()) || 0;
    const rate = parseFloat(row.find('.price-per-carat').val()) || 0;

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

    updateGoldFinalPrice(row);
});


function updateGoldFinalPrice(row) {
    if (!row) {
        row = $('#entryTable tbody tr')[0];
    }
    if (!row) return;
    if (row.jquery) {
        row = row[0];
    }

    let diamondTotal = 0;
    let stoneTotal = 0;
    let packetTotal = 0;

    // Diamond total
    $(row).closest('#productInfoSection').find('.diamond-total').each(function () {
        diamondTotal += parseFloat($(this).val()) || 0;
    });

    // Stone total
    $(row).closest('#productInfoSection').find('.stone-total').each(function () {
        stoneTotal += parseFloat($(this).val()) || 0;
    });

    // Packet total
    $(row).closest('#productInfoSection').find('.packet-amount').each(function () {
        packetTotal += parseFloat($(this).val()) || 0;
    });

    const totalAmountEl = row.querySelector('[name="total_amount[]"]');
    const goldPrice = totalAmountEl ? (parseFloat(totalAmountEl.value) || 0) : 0;

    const finalPrice = goldPrice + diamondTotal + stoneTotal + packetTotal;

    const finalPriceEl = row.querySelector('[name="final_price[]"]');
    if (finalPriceEl) {
        finalPriceEl.value = finalPrice.toFixed(2);
    }
}$(document).on('input', '.packet-rate, [name*="[pcs]"]', function () {

    const row = $(this).closest('tr');

    const pcs = parseFloat(row.find('[name*="[pcs]"]').val()) || 0;
    const rate = parseFloat(row.find('.packet-rate').val()) || 0;

    const total = pcs * rate;

    row.find('.packet-amount').val(total.toFixed(2));

    // update final price
    const mainRow = $('#entryTable tbody tr').first();
    updateGoldFinalPrice(mainRow[0]);
});
// ---------------------------------------------------------
// INVOICE CALCULATION ENGINE
// ---------------------------------------------------------
// -----------------------------------------
// PACKET CALCULATION ENGINE
// -----------------------------------------

$(document).on('input change',
    '.packet-rate, [name*="[pcs]"], [name*="[weight]"], [name*="[wt_in_gram]"], [name*="[uom]"]',
    function () {

        const row = $(this).closest('tr');

        const uom = row.find('[name*="[uom]"]').val();
        let pcs = parseFloat(row.find('[name*="[pcs]"]').val()) || 0;
        let ct = parseFloat(row.find('[name*="[weight]"]').val()) || 0;
        let gm = parseFloat(row.find('[name*="[wt_in_gram]"]').val()) || 0;
        const rate = parseFloat(row.find('.packet-rate').val()) || 0;

        let amount = 0;

        // ==============================
        // UOM LOGIC
        // ==============================

        if (uom === 'CT') {

            // Convert CT → GM
            gm = ct / 5;
            row.find('[name*="[wt_in_gram]"]').val(gm.toFixed(3));

            amount = ct * rate;
        }

        else if (uom === 'WT') {

            // Convert GM → CT
            ct = gm * 5;
            row.find('[name*="[weight]"]').val(ct.toFixed(3));

            amount = gm * rate;
        }

        else if (uom === 'PCS') {

            amount = pcs * rate;
        }

        // Set amount
        row.find('.packet-amount').val(amount.toFixed(2));

        // Update Final Price
        const mainRow = $('#entryTable tbody tr').first();
        updateGoldFinalPrice(mainRow[0]);
    }
);
