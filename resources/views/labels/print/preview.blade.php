<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Preview - {{ $template->name }}</title>
    
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

    @php
        $width = $template->canvas_width ?? 50;
        $height = $template->canvas_height ?? 25;
        
        $mT = 0;
        $mB = 0;
        $mL = 0;
        $mR = 0;
    @endphp

    <style>
        body, html {
            margin: 0;
            padding: 0;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .print-btn-container {
            position: fixed;
            top: 20px;
            right: 20px;
        }

        .btn-print {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .label-container {
            width: {{ $width }}mm;
            height: {{ $height }}mm;
            background-color: #fff;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
            box-sizing: border-box;
            /* 1mm = 3.7795px roughly, let's keep absolute mm or just scale properly */
        }

        .element {
            position: absolute;
            box-sizing: border-box;
        }
        
        .element-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .element-content svg, .element-content img {
            max-width: 100%;
            max-height: 100%;
        }

        @media print {
            body, html {
                background-color: #fff;
                display: block;
                min-height: auto;
            }
            .print-btn-container {
                display: none;
            }
            .label-container {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }
            @page {
                size: {{ $width }}mm {{ $height }}mm;
                margin: {{ $mT }}mm {{ $mR }}mm {{ $mB }}mm {{ $mL }}mm;
            }
        }
    </style>
</head>
<body>

    <div class="print-btn-container">
        <button class="btn-print" onclick="window.print()">Print Label</button>
    </div>

    <div class="label-container" id="labelContainer">
        @php
            $placeholders = [
                'product_name' => $product->product_name ?? '',
                'pre_code' => $product->pre_code ?? '',
                'post_code' => $product->post_code ?? '',
                'product_code' => ($product->pre_code ?? '') . ($product->post_code ? '-' . $product->post_code : ''),
                'barcode' => $product->barcode ?? '',
                'gross_weight' => $product->gross_weight ?? '',
                'net_weight' => $product->net_weight ?? '',
                'final_fn_weight' => $product->final_fn_weight ?? '',
                'purity' => isset($product->purity) ? (is_object($product->purity) ? (($product->purity->purity_value ?? '') . ($product->purity->purity_type ?? '')) : $product->purity) : '',
                'gold_color' => $product->gold_color ?? '',
                'size' => $product->size ?? '',
                'quantity' => $product->quantity ?? '',
                'sale_price' => isset($product->sale_price) && $product->sale_price > 0 ? number_format($product->sale_price, 2) : '',
                'making_price' => isset($product->making_price) && $product->making_price > 0 ? number_format($product->making_price, 2) : '',
                'making_type' => $product->making_type ?? '',
                'making_final_amount' => isset($product->making_final_amount) && $product->making_final_amount > 0 ? number_format($product->making_final_amount, 2) : '',
                'wastage_percent' => $product->wastage_percent ?? '',
                'wastage_amount' => isset($product->wastage_amount) && $product->wastage_amount > 0 ? number_format($product->wastage_amount, 2) : '',
                'gst_percent' => $product->gst_percent ?? '',
                'gst_amount' => isset($product->gst_amount) && $product->gst_amount > 0 ? number_format($product->gst_amount, 2) : '',
                'gold_price' => isset($product->gold_price) && $product->gold_price > 0 ? number_format($product->gold_price, 2) : '',
                'mrp_price' => isset($product->mrp_price) && $product->mrp_price > 0 ? number_format($product->mrp_price, 2) : '',
                'final_price' => isset($product->final_price) && $product->final_price > 0 ? number_format($product->final_price, 2) : '',
                'hsn_code' => $product->hsn_code ?? '',
                'category' => isset($product->category) ? ($product->category->category_name ?? '') : '',
                'subcategory' => isset($product->subcategory) ? ($product->subcategory->subcategory_name ?? '') : '',
                'hallmarking' => $product->hallmarking ?? '',
                'diamond_weight' => $product->diamond_weight ?? '',
                'stone_weight' => $product->stone_weight ?? '',
            ];

            $packets = $product->packets ?? collect();
            if (is_array($packets)) {
                $packets = collect($packets);
            }
            $placeholders['packet_no'] = $packets->pluck('packet_no')->filter()->implode(', ');
            $placeholders['packet_pcs'] = $packets->sum('pcs') ?: '';
            $placeholders['packet_weight'] = $packets->sum('weight') ?: '';
            $placeholders['packet_wt_in_gram'] = $packets->sum('wt_in_gram') ?: '';
            $placeholders['packet_amount'] = $packets->sum('amount') ? number_format($packets->sum('amount'), 2) : '';
            $placeholders['packet_certificate_no'] = $packets->pluck('certificate_no')->filter()->implode(', ');
            
            $placeholders['packet_stones'] = $packets->map(function($p) { return isset($p->stone) ? ($p->stone->name ?? '') : ($p->stone_name ?? ''); })->filter()->unique()->implode(', ');
            $placeholders['packet_clarities'] = $packets->map(function($p) { return isset($p->clarity) ? ($p->clarity->name ?? '') : ''; })->filter()->unique()->implode(', ');
            $placeholders['packet_colors'] = $packets->map(function($p) { return isset($p->color) ? ($p->color->name ?? '') : ''; })->filter()->unique()->implode(', ');
            $placeholders['packet_cuts'] = $packets->map(function($p) { return isset($p->cut) ? ($p->cut->name ?? '') : ''; })->filter()->unique()->implode(', ');
            $placeholders['packet_shapes'] = $packets->map(function($p) { return isset($p->shape) ? ($p->shape->name ?? '') : ''; })->filter()->unique()->implode(', ');
        @endphp

        @foreach($template->elements as $el)
            @php
                $val = $el->value;
                if($el->type === 'barcode' || $el->type === 'qrcode') {
                    if (empty($val) || $val === '123456' || $val === 'http://jindo.dev.naver.com/collie') {
                        $val = '{{ barcode }}';
                    }
                }

                if(str_contains($val, '{{')) {
                    foreach($placeholders as $key => $replVal) {
                        $val = str_replace('{{ ' . $key . ' }}', $replVal ?? '', $val);
                        $val = str_replace('{{' . $key . '}}', $replVal ?? '', $val);
                    }
                }

                $fs = $el->styles['fontSize'] ?? 12;
                $fw = $el->styles['fontWeight'] ?? 'normal';
                $ta = $el->styles['textAlign'] ?? 'left';
            @endphp
            
            <div class="element" style="left: {{ $el->pos_x }}mm; top: {{ $el->pos_y }}mm; width: {{ $el->width }}mm; height: {{ $el->height }}mm;">
                <div class="element-content" style="font-size: {{ $fs }}px; font-weight: {{ $fw }}; text-align: {{ $ta }}; justify-content: {{ $ta === 'center' ? 'center' : ($ta === 'right' ? 'flex-end' : 'flex-start') }};">
                    
                    @if($el->type === 'text')
                        {{ ($el->settings['prefix'] ?? '') . $val . ($el->settings['postfix'] ?? '') }}
                    @elseif($el->type === 'barcode')
                        <svg id="bc_{{ $el->id }}"></svg>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                try {
                                    JsBarcode("#bc_{{ $el->id }}", "{{ $val }}", {
                                        format: "{{ $el->settings['barcodeFormat'] ?? 'CODE128' }}",
                                        displayValue: false,
                                        margin: 0,
                                        width: 1.5,
                                        height: {{ max(10, ($el->height * 3.7) - 15) }},
                                        fontSize: 10
                                    });
                                } catch (e) {
                                    console.error(e);
                                }
                            });
                        </script>
                    @elseif($el->type === 'qrcode')
                        <div id="qr_{{ $el->id }}"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                new QRCode(document.getElementById("qr_{{ $el->id }}"), {
                                    text: "{{ $val }}",
                                    width: {{ $el->width * 3.7 }},
                                    height: {{ $el->height * 3.7 }},
                                    colorDark : "#000000",
                                    colorLight : "#ffffff",
                                    correctLevel : QRCode.CorrectLevel.L
                                });
                            });
                        </script>
                    @endif
                    
                </div>
            </div>
        @endforeach
    </div>

    <script>
        // Auto print after a short delay so barcodes can render
        if (window.location.search.includes('autoprint=1')) {
            setTimeout(() => {
                window.print();
                setTimeout(() => window.close(), 500);
            }, 1000);
        }
    </script>
</body>
</html>
