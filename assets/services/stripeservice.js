
function redirectToCheckout(apiKey, sessionId) {
    console.log(sessionId)

    var imported = document.createElement('script');
    imported.src = 'https://js.stripe.com/v3/';
    document.head.appendChild(imported);

    var stripe = Stripe(apiKey);
    return stripe.redirectToCheckout({sessionId: sessionId});
}

export const stripeservice = {
    redirectToCheckout,
}