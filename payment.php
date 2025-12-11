<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/paymentstyle.css">
    <script src="JS/navbar.js" defer></script>
    <script src="JS/payment.js" defer></script>
    <title>Payment</title>
</head>

<body>
    <?php include "navbar.php"; ?>

    <main>
        <header>
            <p>Payment Page</p>
        </header>
        <div class="containner-white">
            <div class="containner-black">
                <div class="containner-black-group">
                    <p class="textcontainnerblack">Total Payment</p>
                    <p class="textcontainnerblack2">XXXX.XX BAHT</p>
                </div>
                <p class="text-term-black">Read our Privacy Policy and Terms of Service</p>
            </div>

            <div class="whitetextcontainner">
                <div class="groupheader">
                    <p>Select Payment Method</p>
                    <div class="containner-pic">
                        <img src="IMAGES\MasterCard.png" alt="Master Card">
                        <img src="IMAGES\promptpay.png" alt="promptpay">
                        <img src="IMAGES\visa.png" alt="visa" class="visa">
                    </div>
                </div>
                <div class="payment-option">
                    <label class="ration-option">
                        <input type="radio" name="payment" value="truemoney">
                        <span>Truemoney</span>
                    </label>
                    <label class="ration-option">
                        <input type="radio" name="payment" value="promptpay">
                        <span>Promptpay</span>
                    </label>
                    <label class="ration-option">
                        <input type="radio" name="payment" value="credit-card">
                        <span>Credit Card</span>
                    </label>
                </div>

                <div id="truemoney-form" class="hidden">
                    <h1 class="small-text">Phone Number: <input type="text" name="tel-number" id="tel-number"
                            placeholder="Enter phone number"></h1>
                    <input type="checkbox" id="checkterm">I agree to the terms and conditions of ONE BY ONE’s movie
                    rental payment agreement.
                    <br>
                    <div class="button-group">
                        <button class="edit" onclick="window.location.href='inventory.php'">Edit Order</button>

                        <button class="summit">Summit</button>
                    </div>

                </div>

                <div id="promptpay-form" class="hidden">
                    <img src="IMAGES\promptpayQR.png" alt="promptpayQR" class="imgqr"><br>
                    <input type="checkbox" id="checkterm2">I agree to the terms and conditions of ONE BY ONE’s movie
                    rental payment agreement.
                    <br>
                    <div class="button-group">
                        <button class="edit" onclick="window.location.href='inventory.php'">Edit Order</button>

                        <button class="summit">Summit</button>
                    </div>
                </div>

                <div id="credit-card-form" class="hidden">
                    <div class="group1">
                        <h1 class="small-text2">Credit Card Number <input type="text" name="credit-card-number"
                                id="tel-number2"></h1>
                        <h2 class="very-small-text2">Enter the 16-digit card number on your card</h2>
                    </div>

                    <div class="group1">
                        <h1 class="small-text2">Cardholder Name <input type="text" name="cardholder" id="tel-number3">
                        </h1>
                        <h2 class="very-small-text2">Enter the cardholder name as shown on the card</h2>
                    </div>
                    <div class="biggroup-row">
                        <div class="group1">
                            <h1 class="small-text2">Expiration&nbsp;Date
                                <div class="exp-group">
                                    <input type="text" name="expiration-month" id="tel-number4">
                                    <span class="slash">/</span>
                                    <input type="text" name="expiration-year" id="tel-number5">
                                </div>

                            </h1>
                            <h2 class="very-small-text2">Enter the month/year the card expires</h2>
                        </div>
                        <div class="group1">
                            <h1 class="small-text2">Security Code (CVV) <input type="text" name="CVV" id="tel-number6">
                            </h1>
                            <h2 class="very-small-text2">3-digit code on the back of the card</h2>
                        </div>
                    </div>
                    <input type="checkbox" id="checkterm3">I agree to the terms and conditions of ONE BY ONE’s movie
                    rental payment agreement.
                    <br>
                    <div class="button-group">
                        <button class="edit" onclick="window.location.href='inventory.php'">Edit Order</button>
                        <button class="summit">Summit</button>
                    </div>
                </div>


            </div>
        </div>
    </main>
    <footer>
        <div class="footerbox"></div>
    </footer>
</body>

</html>