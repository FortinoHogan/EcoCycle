<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <button id="pay-button">Pay Now</button>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            fetch('/payment/snap-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    snap.pay(data.token);
                } else {
                    alert('Error: ' + data.error);
                }
            });
        });
    </script>
</body>
</html>
