
function redirectToCheckout(apiKey, sessionId) {
    var imported = document.createElement('script');
    imported.src = 'https://js.stripe.com/v3/';
    document.head.appendChild(imported);

    setTimeout(function () {

        var stripe = Stripe(apiKey);
        return stripe.redirectToCheckout({sessionId: sessionId});
    }, 500);
}

export const stripeservice = {
    redirectToCheckout,
}