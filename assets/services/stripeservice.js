
function redirectToCheckout(apiKey, sessionId) {
    addJs();
    setTimeout(function () {

        var stripe = Stripe(apiKey);
        return stripe.redirectToCheckout({sessionId: sessionId});
    }, 500);
}

function getCardToken(apiKey, client_secret, card) {
    addJs();
    setTimeout(function () {
        var stripe = Stripe(apiKey);
        var elements = stripe.elements({
            clientSecret: apiKey,
        });

        var cardElement = elements.create('card');

        cardElement.name(card.name);
        cardElement.number(card.number);
        cardElement.exp_year(card.exp_year);
        cardElement.exp_month(card.exp_month);
        cardElement.cvc(card.cvc);

        return stripe.createToken(cardElement);
    }, 500);

}

function addJs() {

    var imported = document.createElement('script');
    imported.src = 'https://js.stripe.com/v3/';
    document.head.appendChild(imported);
}

export const stripeservice = {
    redirectToCheckout,
    getCardToken,
}
