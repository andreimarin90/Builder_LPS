jQuery(document).ready(function($) {
    var recurlyPublicApiKey = 'ewr1-zt3dc3P4KgI3lmRgmvquit',
        templateList = bbt_script_vars.templateList;

    recurly.configure(recurlyPublicApiKey);

    const elements = recurly.Elements();

    //const cardElement = elements.CardElement();
    const cardNumberElement = elements.CardNumberElement({
        style: {
            placeholder: {
                content: 'Card Number'
            }
        }
    });

    const cardMonthElement = elements.CardMonthElement({
        style: {
            placeholder: {
                content: 'Expiry Month'
            }
        }
    });

    const cardYearElement = elements.CardYearElement({
        style: {
            placeholder: {
                content: 'Expiry Year'
            }
        }
    });

    const cardCvvElement = elements.CardCvvElement({
        style: {
            placeholder: {
                content: 'CVV'
            }
        }
    });

    cardNumberElement.attach('#recurly-cardNumber');
    cardMonthElement.attach('#recurly-cardMonth');
    cardYearElement.attach('#recurly-cardYear');
    cardCvvElement.attach('#recurly-cardCvv');








    document.querySelector('#my-form').addEventListener('submit', function (event) {
        const form = this;
        event.preventDefault();
        recurly.token(elements, form, function (err, token) {console.log(err, token);
            if (err) {
                // handle error using err.code and err.fields
            } else {
                // recurly.js has filled in the 'token' field, so now we can submit the
                // form to your server
                form.submit();
            }
        });
    });





















});
