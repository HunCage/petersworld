function barcodeGen() {
    var data = document.querySelector('.input').value;

    JsBarcode('#barcode', data, {
        format: 'CODE39',
        background: '#fff',
        color: '#000',
        height: 100,
        displayValue: true,
        text: '',
    });
}