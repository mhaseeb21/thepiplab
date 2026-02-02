<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bot Quote</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f8f9fb; padding:20px;">

    <div style="max-width:600px; background:#ffffff; padding:20px; margin:auto; border-radius:8px;">
        
        <h2 style="color:#091E3E; margin-bottom:10px;">
            Custom Bot Quote
        </h2>

        <p>Hello {{ $botRequest->user->name }},</p>

        <p>
            Thank you for submitting your custom bot request.  
            Based on your requirements, here is your quote:
        </p>

        <hr>

        <p><strong>Bot Type:</strong> {{ $botRequest->bot_type }}</p>
        <p><strong>Platform:</strong> {{ $botRequest->platform }}</p>
        <p><strong>Market:</strong> {{ $botRequest->market }}</p>
        <p><strong>Risk Profile:</strong> {{ $botRequest->risk_profile }}</p>

        <hr>

        <p style="font-size:18px;">
            <strong>Quoted Amount:</strong> 
            <span style="color:#06a3da;">
                ${{ number_format($botRequest->quoted_amount, 2) }}
            </span>
        </p>

        <p><strong>Details:</strong></p>
        <p>{!! nl2br(e($botRequest->quote_message)) !!}</p>

        <hr>

        <p>
            Please log in to your PipLab dashboard to accept the quote  
            and submit your payment proof.
        </p>

        <p style="margin-top:30px;">
            Regards,<br>
            <strong>PipLab Team</strong>
        </p>
    </div>

</body>
</html>
