<h1>New Quotation Prepared</h1>
<p>Your prescription quotation is ready.</p>
<table border="1">
    <tr>
        <th>Drug</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    @foreach ($quotation->drugs as $drug)
        <tr>
            <td>{{ $drug['name'] }}</td>
            <td>{{ $drug['quantity'] }}</td>
            <td>{{ $drug['price'] }}</td>
        </tr>
    @endforeach
</table>
<p>Total: {{ $quotation->total }}</p>
