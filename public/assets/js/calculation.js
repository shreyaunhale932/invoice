function calculatePrice() {

    let grossWeight = parseFloat($('input[name="gross_weight"]').val()) || 0;
    let metalRate = parseFloat($('#metal_rate option:selected').data('price')) || 0;
    let wastagePerc = parseFloat($('input[name="wastage_percent"]').val()) || 0;
    let makingInput = parseFloat($('input[name="making_price"]').val()) || 0;
    let makingType = $('select[name="making_type"]').val();
    // alert('makingType');
    let gstPerc = parseFloat($('input[name="gst_percent"]').val()) || 0;
    let quantity = parseFloat($('input[name="quantity"]').val()) || 1;

    let totalDiamondGram = 0;
    document.querySelectorAll('input[name="diamond[diamond_weight][]"]').forEach(el => {
        totalDiamondGram += (parseFloat(el.value) || 0) * 0.2;
    });

    let totalStoneGram = 0;
    document.querySelectorAll('input[name="stone[stone_weight][]"]').forEach(el => {
        totalStoneGram += (parseFloat(el.value) || 0) * 0.2;
    });

    let totalPacketGram = 0;
    document.querySelectorAll('input[name="packet[wt_in_gram][]"]').forEach(el => {
        totalPacketGram += parseFloat(el.value) || 0;
    });

    let netWeight = grossWeight - totalDiamondGram - totalStoneGram - totalPacketGram;
    if (netWeight < 0) netWeight = 0;

    let wastageWeight = (netWeight * wastagePerc) / 100;
    let fineWeight = netWeight + wastageWeight;

    $('input[name="net_weight"]').val(netWeight.toFixed(3));
    $('input[name="final_fn_weight"]').val(fineWeight.toFixed(3));

    /* ===== GOLD VALUE ===== */
    let goldValue = metalRate * fineWeight;

    /* ===== MAKING CALCULATION ===== */
    let makingFinal = 0;

    switch (makingType) {

        case "val":
            makingFinal = makingInput;
            break;

        case "per_gld_val":
            makingFinal = (goldValue * makingInput) / 100;
            break;

        case "per_pcs":
            makingFinal = makingInput * quantity;
            break;

        case "per_gm_nw":
            makingFinal = makingInput * netWeight;
            break;

        case "per_gm_gw":
            makingFinal = makingInput * grossWeight;
            break;

        case "per_gm_fine_wt":
            makingFinal = makingInput * fineWeight;
            break;
    }

    $('input[name="making_final_amount"]').val(makingFinal.toFixed(2));

    /* ===== GST ===== */
    let gstAmount = ((goldValue + makingFinal) * gstPerc) / 100;

    /* ===== FINAL GOLD PRICE ===== */
    let goldFinalPrice = goldValue + makingFinal ;

    $('input[name="gold_price"]').val(goldFinalPrice.toFixed(2));

    let diamondTotal = 0;
    document.querySelectorAll('input[name="diamond[diamond_final_price][]"]').forEach(el => {
        diamondTotal += parseFloat(el.value) || 0;
    });

    let stoneTotal = 0;
    document.querySelectorAll('input[name="stone[stone_final_price][]"]').forEach(el => {
        stoneTotal += parseFloat(el.value) || 0;
    });

    let packetTotal = 0;
    document.querySelectorAll('input[name="packet[amount][]"]').forEach(el => {
        packetTotal += parseFloat(el.value) || 0;
    });

    let subTotal = goldValue + makingFinal + diamondTotal + stoneTotal + packetTotal;
    let gstAmountFinal = (subTotal * gstPerc) / 100;
    let finalPrice = subTotal ;

    $('input[name="gst_amount"]').val(gstAmountFinal.toFixed(2));
    $('input[name="final_price"]').val(finalPrice.toFixed(2));


    // add diamond + stone + packet same as before
}


$(document).on('change', 'select[name="making_type"]', function () {
    console.log("Making type changed");
    calculatePrice();
});


$(document).on('keyup change',
    'input[name="making_price"], input[name="quantity"]',
    function () {
        calculatePrice();
    });




$(document).on('keyup change input', `
    input[name="gross_weight"],
    #metal_rate,
    input[name="wastage_percent"],
    input[name="making_price"],
    input[name="gst_percent"],

    input[name="diamond[diamond_weight][]"],
    input[name="diamond[diamond_final_price][]"],

    input[name="stone[stone_weight][]"],
    input[name="stone[stone_final_price][]"],

    input[name="packet[wt_in_gram][]"],
    input[name="packet[amount][]"],
    input[name="packet[rate][]"],
    input[name="packet[pcs][]"]
`, function () {
    calculatePrice();
});



///----------------------diamond calculation-----------------------------///

function calculateDiamondPrice(diamondCard) {
    let weight = parseFloat(
        diamondCard.querySelector('input[name="diamond[diamond_weight][]"]').value
    ) || 0;

    let pricePerCarat = parseFloat(
        diamondCard.querySelector('input[name="diamond[price_per_carat][]"]').value
    ) || 0;

    let finalPrice = weight * pricePerCarat;

    diamondCard.querySelector('input[name="diamond[diamond_final_price][]"]')
        .value = finalPrice.toFixed(2);

    calculatePrice(); // update net weight
}


// Listen for input on diamond weight & price per carat
document.addEventListener('input', function (e) {

    if (
        e.target.name === 'diamond[diamond_weight][]' ||
        e.target.name === 'diamond[price_per_carat][]'
    ) {
        let diamondCard = e.target.closest('.diamond-item');
        calculateDiamondPrice(diamondCard);
    }
});

// Recalculate all diamonds on page load (edit mode)
document.querySelectorAll('.diamond-item').forEach(function (card) {
    calculateDiamondPrice(card);
});

//--------------------------------stone calculation-------------------------//
function calculateStonePrice(stoneCard) {
    let weight = parseFloat(
        stoneCard.querySelector('input[name="stone[stone_weight][]"]').value
    ) || 0;

    let price = parseFloat(
        stoneCard.querySelector('input[name="stone[stone_price][]"]').value
    ) || 0;

    let finalPrice = weight * price;

    stoneCard.querySelector('input[name="stone[stone_final_price][]"]')
        .value = finalPrice.toFixed(2);

    calculatePrice(); // update net weight
}


// Listen for input on stone weight & stone price
document.addEventListener('input', function (e) {

    if (
        e.target.name === 'stone[stone_weight][]' ||
        e.target.name === 'stone[stone_price][]'
    ) {
        let stoneCard = e.target.closest('.stone-item');
        calculateStonePrice(stoneCard);
    }
});

// Recalculate stones on page load (edit mode)
document.querySelectorAll('.stone-item').forEach(function (card) {
    calculateStonePrice(card);
});

