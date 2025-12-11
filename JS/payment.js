const radios = document.querySelectorAll('input[name="payment"]');

radios.forEach(r => {
    r.addEventListener("change", () => {
        document.getElementById("truemoney-form").style.display = "none";
        document.getElementById("promptpay-form").style.display = "none";
        document.getElementById("credit-card-form").style.display = "none";

        if (r.value === "truemoney") document.getElementById("truemoney-form").style.display = "block";
        if (r.value === "promptpay") document.getElementById("promptpay-form").style.display = "block";
        if (r.value === "credit-card") document.getElementById("credit-card-form").style.display = "block";
    });
});

document.querySelector("#truemoney-form .summit").addEventListener("click", () => {
    const phone = document.getElementById("tel-number").value.trim();
    const agree = document.getElementById("checkterm").checked;

    if (phone.length !== 10 || isNaN(phone)) {
        alert("Please enter a valid phone number (10 digits).");
        return;
    }
    if (!agree) {
        alert("Please accept the terms and conditions before proceeding.");
        return;
    }
    alert("Truemoney payment submitted successfully.")
});

document.querySelector("#promptpay-form .summit").addEventListener("click", () => {
    const agree = document.getElementById("checkterm2").checked;

    if (!agree) {
        alert("Please accept the terms and conditions before proceeding.");
        return;
    }
    alert("Promptpay payment submitted successfully.")
});

document.querySelector("#credit-card-form .summit").addEventListener("click", () => {
    const card = document.getElementById("tel-number2").value.trim();
    const name = document.getElementById("tel-number3").value.trim();
    const month = document.getElementById("tel-number4").value.trim();
    const year = document.getElementById("tel-number5").value.trim();
    const cvv = document.getElementById("tel-number6").value.trim();
    const agree = document.getElementById("checkterm3").checked;

    if (card.length !== 16 || isNaN(card)) {
        alert("Please enter a valid 16-digit card number.");
        return;
    }

    if (name === "") {
        alert("Please enter the cardholder name.");
        return;
    }

    if (month.length !== 2 || isNaN(month) || +month < 1 || + month > 12) {
        alert("Please enter a valid expiration month (01–12).");
        return;
    }

    if (year.length !== 2 || isNaN(year)) {
        alert("Please enter a valid expiration year (e.g., 28).");
        return;
    }

    if (cvv.length !== 3 || isNaN(cvv)) {
        alert("Please enter a valid 3-digit CVV.");
        return;
    }

    if (!agree) {
        alert("Please accept the terms and conditions before proceeding.");
        return;
    }
    alert("Credit card payment submitted successfully.")
});