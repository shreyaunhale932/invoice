function calculatePrice() {

    let grossWeight = parseFloat($('input[name="gross_weight"]').val()) || 0;
    let metalRate = parseFloat($('#metal_rate option:selected').data('price')) || 0;
    let wastagePerc = parseFloat($('input[name="wastage_percent"]').val()) || 0;
    let makingPrice = parseFloat($('input[name="making_price"]').val()) || 0;
    let gstPerc = parseFloat($('input[name="gst_percent"]').val()) || 0;

    let totalDiamondGram = 0;
    document.querySelectorAll('input[name="diamond[diamond_weight][]"]').forEach(el => {
        let carat = parseFloat(el.value) || 0;
        totalDiamondGram += (carat * 0.2); // 1 carat = 0.2 gram
    });


    let totalStoneGram = 0;
    document.querySelectorAll('input[name="stone[stone_weight][]"]').forEach(el => {
         let carat = parseFloat(el.value) || 0;
        totalStoneGram += (carat * 0.2); // 1 carat = 0.2 gram
    });


    let netWeight = grossWeight - totalDiamondGram - totalStoneGram;
    if (netWeight < 0) netWeight = 0;

    let wastageWeight = (netWeight * wastagePerc) / 100;
    let finalNetWeight = netWeight + wastageWeight;

    $('input[name="net_weight"]').val(finalNetWeight.toFixed(3));


    let goldPrice = metalRate * finalNetWeight;

    let gstAmount = ((goldPrice + makingPrice) * gstPerc) / 100;


    let finalPrice = goldPrice + makingPrice + gstAmount;

    $('input[name="gold_price"]').val(finalPrice.toFixed(2));
    $('input[name="gst_amount"]').val(gstAmount.toFixed(2));
}



$(document).on('keyup change input', `
    input[name="gross_weight"],
    #metal_rate,
    input[name="wastage_percent"],
    input[name="making_price"],
    input[name="gst_percent"],
    input[name="diamond[diamond_weight][]"],
    input[name="stone[stone_weight][]"]
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

