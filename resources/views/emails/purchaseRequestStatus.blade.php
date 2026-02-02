<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request Status Update</title>
</head>
<body>
    <h1>Purchase Request Status Update</h1>
    <p>Dear {{ $purchaseRequest->user->name }},</p>
    <p>Your purchase request for the product "{{ ucfirst($purchaseRequest->product_type) }}" has been <strong>{{ $status }}</strong>.</p>
    <p>Transaction ID: {{ $purchaseRequest->transaction_id }}</p>
    <p>Thank you for your patience!</p>
    <p>Best regards,<br>Your Company Team</p>
</body>
</html>
