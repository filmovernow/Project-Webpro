document.addEventListener("DOMContentLoaded", () => 
{
    const radios = document.querySelectorAll('input[name="paymentmethod"]'); 
    const truemoneyForm = document.querySelector(".truemoneyform");
    const promptpayForm = document.querySelector(".promptpayform");
    const creditCardForm = document.querySelector(".creditcardform");

    if (!truemoneyForm || !promptpayForm || !creditCardForm) {
        console.error("Payment form elements not found.");
        return;
    }

    function hideAllForms() {
        document.querySelectorAll(".paymentform").forEach(form => {
            form.classList.add("hidden");
        });
    }

    function showSelectedForm(selectedValue) {
        hideAllForms();

        switch (selectedValue) {
            case "truemoney":
                truemoneyForm.classList.remove("hidden");
                break;
            case "promptpay":
                promptpayForm.classList.remove("hidden");
                break;
            case "credit card":
                creditCardForm.classList.remove("hidden");
                break;
            default:
                creditCardForm.classList.remove("hidden"); 
                break;
        }
    }

    radios.forEach(radio => {
        radio.addEventListener("change", (event) => {
            showSelectedForm(event.target.value);
        });
    });

    const selectedRadio = document.querySelector('input[name="paymentmethod"]:checked');
    if (selectedRadio) {
        showSelectedForm(selectedRadio.value);
    } 
    else 
    {
        showSelectedForm("credit card");
    }

});