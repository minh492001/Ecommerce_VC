<!DOCTYPE html>
<html>
<head>
    <title>Stripe Checkout</title>
</head>
<body>
    <script src="https://js.stripe.com/v3"></script>
    <script type="text/javascript">
        let session_id = '{{ $session_id }}'
        let stripe = Stripe('{{ $setPublicKey }}')
        stripe.redirectToCheckout({
            sessionId : session_id
        }).then(function (result) {

        })
    </script>
</body>
</html>
