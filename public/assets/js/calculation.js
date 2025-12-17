    function calculatePrice() {
        let grossWeight = parseFloat($('input[name="gross_weight"]').val()) || 0;
        let netWeight   = parseFloat($('input[name="net_weight"]').val()) || 0;
        let metalRate   = parseFloat($('#metal_rate option:selected').data('price')) || 0;
        let wastagePerc = parseFloat($('input[name="wastage_percent"]').val()) || 0;
        let makingPrice = parseFloat($('input[name="making_price"]').val()) || 0;
        let gstPerc     = parseFloat($('input[name="gst_percent"]').val()) || 0;

        // 1️⃣ Gross → Net weight (same value)
        if (grossWeight > 0) {
            $('input[name="net_weight"]').val(grossWeight);
            netWeight = grossWeight;
        }

        // 2️⃣ Base Gold Price
        let goldPrice = metalRate * netWeight;

        // 3️⃣ Wastage Amount
        let wastageAmount = (goldPrice * wastagePerc) / 100;

        // 4️⃣ Total before GST
        let totalBeforeGST = goldPrice + wastageAmount + makingPrice;

        // 5️⃣ GST Amount
        let gstAmount = (totalBeforeGST * gstPerc) / 100;

        // 6️⃣ Final Price
        let finalPrice = totalBeforeGST + gstAmount;

        // Set values
        $('input[name="gold_price"]').val(finalPrice.toFixed(2));
        $('input[name="gst_amount"]').val(gstAmount.toFixed(2));
        // $('input[name="sale_price"]').val(finalPrice.toFixed(2));
        // $('input[name="mrp_price"]').val(finalPrice.toFixed(2));
    }

    // Trigger calculations
    $(document).on('keyup change', `
        input[name="gross_weight"],
        #metal_rate,
        input[name="wastage_percent"],
        input[name="making_price"],
        input[name="gst_percent"]
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

