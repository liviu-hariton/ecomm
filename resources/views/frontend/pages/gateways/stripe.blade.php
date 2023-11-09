<form method="post" action="{{ route('user.stripe.payment') }}" id="stripe-form">
    @csrf
    <input type="hidden" name="strike_token" id="stripe-token-id">
    <div id="card-element" class="form-control mb-3 p-3"></div>
    <button type="button" class="common_btn" id="stripe-pay-btn" onclick="createToken()">Pay with Stripe&reg;</button>
</form>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ $stripe_settings->client_id }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        function createToken() {
            document.getElementById('stripe-pay-btn').disabled = true;

            stripe.createToken(cardElement).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    document.getElementById('stripe-pay-btn').disabled = false;

                    Swal.fire(
                        'Ups!',
                        result.error.message,
                        'danger'
                    );

                } else {
                    // Send the token to your server.
                    document.getElementById('stripe-token-id').value = result.token.id;
                    document.getElementById('stripe-pay-btn').disabled = false;
                    document.getElementById('stripe-form').submit();
                }
            });
        }
    </script>
@endpush
