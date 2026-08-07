// Label Designer Engine
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('designerCanvas');
    const PIXELS_PER_MM = 3.7795275591; // 96 DPI
    let elements = [];
    let selectedElementId = null;
    let elementCounter = 0;

    // Initialize Canvas
    function initCanvas() {
        updateCanvasSize();
        
        if (window.SavedTemplate && window.SavedTemplate.elements) {
            elements = window.SavedTemplate.elements.map((el, index) => {
                return {
                    ...el,
                    id: 'el_' + (index + 1),
                    pos_x: parseFloat(el.pos_x) || 0,
                    pos_y: parseFloat(el.pos_y) || 0,
                    width: parseFloat(el.width) || 0,
                    height: parseFloat(el.height) || 0
                };
            });
            elementCounter = elements.length;
            elements.forEach(el => renderElement(el));
        }
    }

    function updateCanvasSize() {
        const w = parseFloat(document.getElementById('canvasW').value) || 50;
        const h = parseFloat(document.getElementById('canvasH').value) || 25;
        canvas.style.width = (w * PIXELS_PER_MM) + 'px';
        canvas.style.height = (h * PIXELS_PER_MM) + 'px';
    }

    document.getElementById('canvasW').addEventListener('change', updateCanvasSize);
    document.getElementById('canvasH').addEventListener('change', updateCanvasSize);

    // Add Element
    function addElement(type, text = '') {
        elementCounter++;
        const el = {
            id: 'el_' + elementCounter,
            type: type,
            value: text || (type === 'text' ? 'New Text' : (type === 'barcode' || type === 'qrcode' ? '{{ barcode }}' : '')),
            pos_x: 5,
            pos_y: 5,
            width: type === 'barcode' ? 30 : 20,
            height: type === 'barcode' ? 10 : 5,
            styles: {
                fontSize: 12,
                fontWeight: 'normal',
                textAlign: 'center'
            },
            settings: {
                barcodeFormat: 'CODE128',
                barcodeText: false,
                prefix: '',
                postfix: ''
            }
        };
        elements.push(el);
        renderElement(el);
        selectElement(el.id);
    }

    // Render single element
    function renderElement(el) {
        let node = document.getElementById(el.id);
        if (!node) {
            node = document.createElement('div');
            node.id = el.id;
            node.className = 'canvas-element';
            
            const content = document.createElement('div');
            content.className = 'element-content';
            node.appendChild(content);

            const handle = document.createElement('div');
            handle.className = 'resize-handle';
            node.appendChild(handle);

            canvas.appendChild(node);

            // Setup interact.js for this element
            interact(node)
                .draggable({
                    modifiers: [
                        interact.modifiers.restrictRect({
                            restriction: 'parent',
                            endOnly: false
                        })
                    ],
                    listeners: {
                        move(event) {
                            const target = event.target;
                            const elData = elements.find(e => e.id === target.id);
                            
                            elData.pos_x += (event.dx / PIXELS_PER_MM);
                            elData.pos_y += (event.dy / PIXELS_PER_MM);
                            
                            applyElementStyles(target, elData);
                            if (selectedElementId === target.id) updatePropertiesPanel(elData);
                        }
                    }
                })
                .resizable({
                    edges: { left: false, right: '.resize-handle', bottom: '.resize-handle', top: false },
                    modifiers: [
                        interact.modifiers.restrictEdges({
                            outer: 'parent'
                        }),
                        interact.modifiers.restrictSize({
                            min: { width: 10, height: 10 }
                        })
                    ],
                    listeners: {
                        move: function (event) {
                            const target = event.target;
                            const elData = elements.find(e => e.id === target.id);
                            
                            elData.width = event.rect.width / PIXELS_PER_MM;
                            elData.height = event.rect.height / PIXELS_PER_MM;
                            
                            applyElementStyles(target, elData);
                            updateElementContent(target, elData);
                        }
                    }
                });

            node.addEventListener('mousedown', (e) => {
                selectElement(el.id);
            });
        }

        applyElementStyles(node, el);
        updateElementContent(node, el);
    }

    function applyElementStyles(node, el) {
        node.style.left = (el.pos_x * PIXELS_PER_MM) + 'px';
        node.style.top = (el.pos_y * PIXELS_PER_MM) + 'px';
        node.style.width = (el.width * PIXELS_PER_MM) + 'px';
        node.style.height = (el.height * PIXELS_PER_MM) + 'px';
        
        const content = node.querySelector('.element-content');
        if (el.type === 'text') {
            content.style.fontSize = ((el.styles || {}).fontSize || 12) + 'px';
            content.style.fontWeight = (el.styles || {}).fontWeight || 'normal';
            content.style.textAlign = (el.styles || {}).textAlign || 'center';
            content.style.fontFamily = 'Arial, sans-serif';
            content.style.display = 'flex';
            content.style.alignItems = 'center';
            content.style.justifyContent = 'flex-start';
            content.style.whiteSpace = 'pre-wrap';
        }
    }

    function updateElementContent(node, el) {
        const content = node.querySelector('.element-content');
        
        if (el.type === 'text') {
            const prefix = (el.settings && el.settings.prefix) ? el.settings.prefix : '';
            const postfix = (el.settings && el.settings.postfix) ? el.settings.postfix : '';
            content.innerText = prefix + (el.value || 'Text') + postfix;
        } 
        else if (el.type === 'barcode') {
            content.innerHTML = '<svg id="bc_' + el.id + '"></svg>';
            try {
                let bcVal = el.value || '123456';
                if (bcVal.includes('{{')) bcVal = '123456'; // Mock for designer canvas
                JsBarcode("#bc_" + el.id, bcVal, {
                    format: (el.settings || {}).barcodeFormat || "CODE128",
                    displayValue: ((el.settings || {}).barcodeText === true || (el.settings || {}).barcodeText === "true"),
                    margin: 0,
                    width: 2,
                    height: (el.height * PIXELS_PER_MM) - 15, // leave room for text
                    fontSize: 12
                });
            } catch (e) {
                content.innerText = 'Invalid Barcode';
            }
        }
        else if (el.type === 'qrcode') {
            content.innerHTML = '';
            let qrVal = el.value || '123456';
            if (qrVal.includes('{{')) qrVal = '123456'; // Mock for designer canvas
            new QRCode(content, {
                text: qrVal,
                width: el.width * PIXELS_PER_MM,
                height: el.height * PIXELS_PER_MM,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        }
    }

    // Selection
    function selectElement(id) {
        document.querySelectorAll('.canvas-element').forEach(n => n.classList.remove('selected'));
        selectedElementId = id;
        
        if (id) {
            const node = document.getElementById(id);
            if (node) node.classList.add('selected');
            const elData = elements.find(e => e.id === id);
            
            document.getElementById('noElementSelected').style.display = 'none';
            document.getElementById('elementProperties').style.display = 'block';
            updatePropertiesPanel(elData);
        } else {
            document.getElementById('noElementSelected').style.display = 'block';
            document.getElementById('elementProperties').style.display = 'none';
        }
    }

    canvas.addEventListener('mousedown', (e) => {
        if (e.target === canvas) {
            selectElement(null);
        }
    });

    // Properties Panel Updates
    function updatePropertiesPanel(el) {
        if (!el) return;
        document.getElementById('propX').value = el.pos_x.toFixed(2);
        document.getElementById('propY').value = el.pos_y.toFixed(2);

        document.querySelector('.props-text').style.display = 'none';
        document.querySelector('.props-barcode').style.display = 'none';
        document.querySelector('.props-qrcode').style.display = 'none';

        if (el.type === 'text') {
            document.querySelector('.props-text').style.display = 'block';
            document.getElementById('propTextValue').value = el.value || '';
            document.getElementById('propPrefix').value = (el.settings || {}).prefix || '';
            document.getElementById('propPostfix').value = (el.settings || {}).postfix || '';
            document.getElementById('propFontSize').value = (el.styles || {}).fontSize || 12;
            document.getElementById('propFontWeight').value = (el.styles || {}).fontWeight || 'normal';
        } else if (el.type === 'barcode') {
            document.querySelector('.props-barcode').style.display = 'block';
            document.getElementById('propBarcodeValue').value = el.value || '';
            document.getElementById('propBarcodeFormat').value = (el.settings || {}).barcodeFormat || 'CODE128';
            document.getElementById('propBarcodeText').value = ((el.settings || {}).barcodeText === true || (el.settings || {}).barcodeText === "true") ? "true" : "false";
            document.getElementById('propBarcodeHeight').value = el.height * PIXELS_PER_MM;
        } else if (el.type === 'qrcode') {
            document.querySelector('.props-qrcode').style.display = 'block';
            document.getElementById('propQrcodeValue').value = el.value || '';
        }
    }

    // Property inputs listener
    document.querySelectorAll('.prop-input').forEach(input => {
        input.addEventListener('input', function() {
            if (!selectedElementId) return;
            const el = elements.find(e => e.id === selectedElementId);
            if (!el) return;

            const val = this.value;

            if (this.id === 'propX') el.pos_x = parseFloat(val) || 0;
            if (this.id === 'propY') el.pos_y = parseFloat(val) || 0;
            
            if (el.type === 'text') {
                if (!el.styles) el.styles = {};
                if (!el.settings) el.settings = {};
                if (this.id === 'propTextValue') el.value = val;
                if (this.id === 'propPrefix') el.settings.prefix = val;
                if (this.id === 'propPostfix') el.settings.postfix = val;
                if (this.id === 'propFontSize') el.styles.fontSize = parseInt(val) || 12;
                if (this.id === 'propFontWeight') el.styles.fontWeight = val;
            }
            if (el.type === 'barcode') {
                if (!el.settings) el.settings = {};
                if (this.id === 'propBarcodeValue') el.value = val;
                if (this.id === 'propBarcodeFormat') el.settings.barcodeFormat = val;
                if (this.id === 'propBarcodeText') el.settings.barcodeText = val === 'true';
                if (this.id === 'propBarcodeHeight') el.height = (parseFloat(val) || 30) / PIXELS_PER_MM;
            }
            if (el.type === 'qrcode') {
                if (this.id === 'propQrcodeValue') el.value = val;
            }

            renderElement(el);
        });
    });

    // Bind UI buttons
    document.querySelectorAll('.btn-element').forEach(btn => {
        btn.addEventListener('click', function() {
            addElement(this.getAttribute('data-type'));
        });
    });

    document.querySelectorAll('.btn-field').forEach(btn => {
        btn.addEventListener('click', function() {
            addElement('text', this.getAttribute('data-field'));
        });
    });

    function deleteSelected() {
        if (!selectedElementId) return;
        const node = document.getElementById(selectedElementId);
        if (node) node.remove();
        elements = elements.filter(e => e.id !== selectedElementId);
        selectElement(null);
    }

    document.getElementById('btnDeleteElement').addEventListener('click', deleteSelected);
    document.getElementById('btnDeleteSelected').addEventListener('click', deleteSelected);

    // Save Template
    document.getElementById('btnSaveTemplate').addEventListener('click', function() {
        const payload = {
            _token: window.CsrfToken,
            name: document.getElementById('templateName').value || 'New Template',
            is_default: document.getElementById('isDefault').checked ? 1 : 0,
            canvas_width: document.getElementById('canvasW').value,
            canvas_height: document.getElementById('canvasH').value,
            elements: elements.map(e => ({
                type: e.type,
                value: e.value,
                pos_x: e.pos_x,
                pos_y: e.pos_y,
                width: e.width,
                height: e.height,
                styles: e.styles,
                settings: e.settings,
                z_index: 1
            }))
        };

        if (window.IsUpdate) {
            payload._method = 'PUT';
        }

        fetch(window.SaveTemplateUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert('Template saved successfully!');
                if (!window.IsUpdate) {
                    window.location.href = window.location.href.split('?')[0].replace('labels/designer', 'labels/designer/' + data.template_id + '/edit');
                }
            } else {
                alert('Error saving template.');
            }
        })
        .catch(e => {
            console.error(e);
            alert('Error saving template.');
        });
    });

    // Preview
    document.getElementById('btnPreview').addEventListener('click', function() {
        if (!window.IsUpdate) {
            alert('Please save the template first before previewing.');
            return;
        }
        window.open('/labels/print/preview/' + window.SavedTemplate.id + '/0', '_blank', 'width=800,height=600');
    });

    // Keyboard nudge support
    document.addEventListener('keydown', function(e) {
        if (!selectedElementId) return;

        // Ignore arrow keys when typing in input/textarea fields
        const activeTag = document.activeElement ? document.activeElement.tagName : '';
        if (activeTag === 'INPUT' || activeTag === 'TEXTAREA' || (document.activeElement && document.activeElement.isContentEditable)) {
            return;
        }

        const keys = ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'];
        if (!keys.includes(e.key)) return;

        // Prevent default scrolling behavior
        e.preventDefault();

        const elData = elements.find(el => el.id === selectedElementId);
        if (!elData) return;

        const node = document.getElementById(selectedElementId);
        if (!node) return;

        const step = e.shiftKey ? 2.0 : 0.5;

        if (e.key === 'ArrowUp') {
            elData.pos_y = Math.max(0, elData.pos_y - step);
        } else if (e.key === 'ArrowDown') {
            const maxH = parseFloat(document.getElementById('canvasH').value) || 25;
            elData.pos_y = Math.min(maxH - elData.height, elData.pos_y + step);
        } else if (e.key === 'ArrowLeft') {
            elData.pos_x = Math.max(0, elData.pos_x - step);
        } else if (e.key === 'ArrowRight') {
            const maxW = parseFloat(document.getElementById('canvasW').value) || 50;
            elData.pos_x = Math.min(maxW - elData.width, elData.pos_x + step);
        }

        applyElementStyles(node, elData);
        updatePropertiesPanel(elData);
    });

    initCanvas();
});
