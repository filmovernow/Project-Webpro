<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navstyle.css">
    <link rel="stylesheet" href="CSS/paymentstyle.css">
    <script src="JS/navbar.js" defer></script>
    <script src="JS/payment.js" defer></script> <title>Payment</title>
</head>

<body>
    <?php 
        include "navbar.php"; 
        require('connect.php');

        $customerID = isset($_SESSION['customerID']) ? (int)$_SESSION['customerID'] : 0;
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $totalPrice = isset($_SESSION['totalPrice']) ? (float)$_SESSION['totalPrice'] : 0.00;

        if ($customerID === 0 || empty($cartItems) || $totalPrice <= 0) {
            header("Location: basket.php?error=" . urlencode("ตะกร้าว่างหรือข้อมูลไม่ครบ โปรดเลือกสินค้าก่อนชำระเงิน"));
            die();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $error = '';
            if (!isset($_POST['paymentmethod'])) {
                $error = "กรุณาเลือกช่องทางการชำระเงิน";
            }
            
            $paymentMethod = isset($_POST['paymentmethod']) ? mysqli_real_escape_string($connect, $_POST['paymentmethod']) : '';
            $checkTerm = isset($_POST['checkterm']);

            if (!$error && !$checkTerm) {
                $error = "กรุณายอมรับเงื่อนไขการเช่าก่อนดำเนินการต่อ";
            }

            if (!$error) {
                switch ($paymentMethod) {
                    case 'truemoney':
                        $telNumber = isset($_POST['telnumber']) ? trim($_POST['telnumber']) : '';
                        
                        if (!preg_match('/^\d{10}$/', $telNumber)) {
                            $error = "กรุณากรอกเบอร์โทร 10 หลัก (TrueMoney)";
                        }
                        break;
                    
                    case 'promptpay':
                        break;
                        
                    case 'credit card':
                        $cardNumber = isset($_POST['cardnumber']) ? trim(str_replace(' ', '', $_POST['cardnumber'])) : '';
                        $cardholderName = isset($_POST['cardholdername']) ? trim($_POST['cardholdername']) : '';
                        $expirationMonth = isset($_POST['expirationmonth']) ? trim($_POST['expirationmonth']) : '';
                        $expirationYear = isset($_POST['expirationyear']) ? trim($_POST['expirationyear']) : '';
                        $cvv = isset($_POST['cvv']) ? trim($_POST['cvv']) : '';
                        
                        if (!preg_match('/^\d{16}$/', $cardNumber)) {
                            $error = "เลขบัตรต้องเป็น 16 หลัก";
                        } else if (empty($cardholderName)) {
                            $error = "กรุณากรอกชื่อผู้ถือบัตร";
                        } else if (!preg_match('/^(0[1-9]|1[0-2])$/', $expirationMonth)) {
                            $error = "เดือนหมดอายุไม่ถูกต้อง (MM)";
                        } else if (!preg_match('/^\d{2}$/', $expirationYear)) {
                            $error = "ปีหมดอายุไม่ถูกต้อง (YY)";
                        } else if (!preg_match('/^\d{3}$/', $cvv)) {
                            $error = "CVV ต้องเป็น 3 หลัก";
                        }
                        break;
                }
            }

            if ($error) {
                header("Location: payment.php?error=" . urlencode($error));
                exit;
            }

            //Transaction
            $rentalDate = date('Y-m-d');
            $expireDate = date('Y-m-d', strtotime('+7 days'));

            mysqli_begin_transaction($connect);

            try {
                $sqlRental = "
                    INSERT INTO rental (customerID, rentalDate, expireDate)
                    VALUES ({$customerID}, '{$rentalDate}', '{$expireDate}')
                ";
                
                if (!mysqli_query($connect, $sqlRental)) {
                    throw new Exception("Error inserting into rental: " . mysqli_error($connect));
                }

                $rentalID = mysqli_insert_id($connect);
                
                foreach ($cartItems as $item) {
                    $movieID = (int)$item['movieID']; 
                    $sqlRentalMovie = "
                        INSERT INTO rental_movie (rentalID, movieID)
                        VALUES ({$rentalID}, {$movieID})";
                    
                    if (!mysqli_query($connect, $sqlRentalMovie)) {
                        throw new Exception("Error inserting rental_movie for movieID {$movieID}: " . mysqli_error($connect));
                    }
                }

                $sqlPayment = "
                    INSERT INTO payment (rentalID, paymentMethod, amount, paymentDate)
                    VALUES ({$rentalID}, '{$paymentMethod}', {$totalPrice}, CURDATE())";
                
                if (!mysqli_query($connect, $sqlPayment)) {
                    throw new Exception("Error inserting into payment: " . mysqli_error($connect));
                }
                
                mysqli_commit($connect);

                $_SESSION['cart'] = [];
                $_SESSION['totalPrice'] = 0;

                header("Location: inventory.php?success=" . urlencode("ชำระเงินสำเร็จ! ภาพยนตร์อยู่ในคลังของคุณแล้ว"));
                exit;

            } 
            catch (Exception $e) 
            {
                mysqli_rollback($connect);
                error_log("Payment Transaction Failed: " . $e->getMessage());
                header("Location: payment.php?error=" . urlencode("เกิดข้อผิดพลาดในการชำระเงิน: โปรดลองใหม่อีกครั้ง"));
                exit;
            }
        }
    ?>

    <main>
        <div class="paymentwrapper">
            <h2 class="paymenttitle">หน้าชำระเงิน</h2>
        </div>

        <?php if(isset($_GET['error'])): ?>
            <div class="errorbox">
                <?= htmlspecialchars(urldecode($_GET['error'])) ?>
            </div>
        <?php endif; ?>
        
        <div class="containerwhite">
            <div class="containerblack">
                <div class="containerblackgroup">
                    <p class="textcontainerblack">Total Payment</p>
                    <p class="textcontainerblack2"><?php echo number_format($totalPrice, 2); ?> BAHT</p>
                </div>
            </div>

            <div class="whitetextcontainer">
                <div class="groupheader">
                    <p>Select Payment Method</p>
                    <div class="containerpic">
                        <img src="IMAGES/MasterCard.png" alt="Master Card">
                        <img src="IMAGES/promptpay.png" alt="promptpay">
                        <img src="IMAGES/visa.png" alt="visa" class="visa">
                    </div>
                </div>
                <form action="payment.php" method="post">

                    <div class="paymentoption">
                        <label class="radiooption">
                            <input type="radio" name="paymentmethod" value="truemoney" required checked>
                            <span>Truemoney</span>
                        </label>
                        <label class="radiooption">
                            <input type="radio" name="paymentmethod" value="promptpay" required>
                            <span>Promptpay</span>
                        </label>
                        <label class="radiooption">
                            <input type="radio" name="paymentmethod" value="credit card" required> 
                            <span>Credit Card</span>
                        </label>
                    </div>

                    <div style="margin-top: 15px;">
                        <input type="checkbox" name="checkterm" class="checkterm" id="checkterm"<?= isset($_POST['checkterm']) ? 'checked' : '' ?>>
                        <label for="checkterm" style="display: inline;">I agree to the terms and conditions of ONE BY ONE’s movie rental payment agreement.</label>
                    </div>

                    <div class="truemoneyform hidden paymentform">
                        <div class="inputgroup">
                            <label for="telnumber" class="smalltext">Phone Number:</label>
                            <input type="number" name="telnumber" class="telnumber" id="telnumber"
                                placeholder="Enter phone number" value="<?= isset($_POST['telnumber']) ? htmlspecialchars($_POST['telnumber']) : '' ?>">
                        </div>
                    </div>
                    
                    <div class="promptpayform hidden paymentform">
                        <img src="IMAGES/promptpayQR.png" alt="promptpayQR" class="imgqr"><br>
                    </div>

                    <div class="creditcardform hidden paymentform">
                        <div class="group1">
                            <label for="cardnumber" class="smalltext2">Credit Card Number</label>
                            <input type="text" name="cardnumber" class="cardnumber" id="cardnumber" value="<?= isset($_POST['cardnumber']) ? htmlspecialchars($_POST['cardnumber']) : '' ?>">
                            <p class="verysmalltext2">Enter the 16-digit card number on your card</p>
                        </div>

                        <div class="group1">
                            <label for="cardholdername" class="smalltext2">Cardholder Name</label>
                            <input type="text" name="cardholdername" class="cardholdername" id="cardholdername" value="<?= isset($_POST['cardholdername']) ? htmlspecialchars($_POST['cardholdername']) : '' ?>">
                            <p class="verysmalltext2">Enter the cardholder name as shown on the card</p>
                        </div>
                        
                        <div class="biggrouprow">
                            <div class="group1">
                                <label for="expirationmonth" class="smalltext2">Expiration Date</label>
                                <div class="expgroup">
                                    <input type="text" name="expirationmonth" class="expirationmonth" id="expirationmonth" placeholder="MM" value="<?= isset($_POST['expirationmonth']) ? htmlspecialchars($_POST['expirationmonth']) : '' ?>">
                                    <span class="slash">/</span>
                                    <input type="text" name="expirationyear" class="expirationyear" id="expirationyear" placeholder="YY" value="<?= isset($_POST['expirationyear']) ? htmlspecialchars($_POST['expirationyear']) : '' ?>">
                                </div>
                                <p class="verysmalltext2">Enter the month/year the card expires</p>
                            </div>
                            
                            <div class="group1">
                                <label for="cvv" class="smalltext2">Security Code (CVV)</label>
                                <input type="text" name="cvv" class="cvv" id="cvv" value="<?= isset($_POST['cvv']) ? htmlspecialchars($_POST['cvv']) : '' ?>">
                                <p class="verysmalltext2">3-digit code on the back of the card</p>
                            </div>
                        </div>
                    </div>

                    <div class="buttongroup">
                            <button type="button" class="editbutton" onclick="window.location.href='basket.php'">Edit Order</button>
                            <button type="submit" name="submit-payment" class="submitbutton">Summit</button>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>

</html>