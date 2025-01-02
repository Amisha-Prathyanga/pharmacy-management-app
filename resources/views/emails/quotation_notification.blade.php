<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Notification</title>
</head>
<body>
    <h2>New Quotation Created</h2>
    <p>Dear {{ $quotation->prescription->user->name }},</p>
    <p>Your quotation has been created. Please find the details below:</p>

    <h3>Quotation Details</h3>
    <ul>
        <li><strong>Total:</strong> {{ $quotation->total }}</li>
        <li><strong>Status:</strong> {{ ucfirst($quotation->status) }}</li>
    </ul>

    @if($quotation->prescription->images)
        <h3>Prescription Images</h3>
        @foreach ($quotation->prescription->images as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Prescription Image" width="300">
        @endforeach
    @endif

    <p>Thank you for using our service!</p>
</body>
</html>
