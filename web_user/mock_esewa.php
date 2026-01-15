<?php
session_start();

// Get payment data
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : 0;

// Simulate payment processing
$payment_success = true; // Change to false to test failure

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment Gateway</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .payment-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .left-section {
            background: white;
            padding: 40px;
            border-right: 1px solid #e5e5e5;
        }
        .right-section {
            background: #fafafa;
            padding: 40px;
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            background: #60bb46;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }
        .logo-text {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }
        .esewa-green {
            color: #60bb46;
        }
        .merchant-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }
        .merchant-icon {
            width: 50px;
            height: 50px;
            background: #60bb46;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .merchant-info h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 4px;
        }
        .merchant-info p {
            font-size: 13px;
            color: #888;
        }
        .amount-section {
            margin-bottom: 30px;
        }
        .amount-label {
            font-size: 14px;
            color: #888;
            margin-bottom: 8px;
        }
        .amount-display {
            font-size: 36px;
            font-weight: 700;
            color: #333;
        }
        .currency {
            font-size: 20px;
            color: #60bb46;
            font-weight: 600;
        }
        .amount-detail {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .amount-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 14px;
        }
        .amount-row.total {
            font-weight: 600;
            font-size: 16px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            margin-top: 10px;
        }
        .signin-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            outline: none;
            border-color: #60bb46;
        }
        .password-wrapper {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .captcha-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background: #60bb46;
            color: white;
            margin-bottom: 10px;
        }
        .btn-primary:hover {
            background: #4fa837;
        }
        .btn-secondary {
            background: white;
            color: #666;
            border: 1px solid #ddd;
        }
        .btn-secondary:hover {
            background: #f8f9fa;
        }
        .forgot-password {
            text-align: center;
            margin: 15px 0;
        }
        .forgot-password a {
            color: #60bb46;
            text-decoration: none;
            font-size: 14px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .register-link a {
            color: #60bb46;
            text-decoration: none;
            font-weight: 600;
        }
        .cancel-payment {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
        }
        .cancel-payment a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
        }
        .success-container {
            text-align: center;
            padding: 40px 20px;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #60bb46;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 40px;
            color: white;
        }
        .success-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .success-message {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }
        .order-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: left;
        }
        .order-details-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 14px;
        }
        .order-details-row strong {
            color: #333;
        }
        @media (max-width: 768px) {
            .payment-wrapper {
                grid-template-columns: 1fr;
            }
            .left-section {
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
            }
        }
    </style>
</head>
<body>
    <?php if (!isset($_POST['confirm'])): ?>
        <!-- Payment Form -->
        <div class="payment-wrapper">
            <!-- Left Section: Payment Details -->
            <div class="left-section">
                <div class="logo-container">
                    <div class="logo-icon">e</div>
                    <div class="logo-text"><span class="esewa-green">e</span>Sewa</div>
                </div>

                <div class="merchant-section">
                    <div class="merchant-icon">E</div>
                    <div class="merchant-info">
                        <h3>EPAYTEST</h3>
                        <p>Fashion Store</p>
                    </div>
                </div>

                <div class="amount-section">
                    <div class="amount-label">Total Amount</div>
                    <div class="amount-display">
                        <span class="currency">NPR.</span> <?php echo number_format($amount, 2); ?>
                    </div>
                </div>

                <div class="amount-detail">
                    <div class="amount-row">
                        <span>Order ID:</span>
                        <strong><?php echo htmlspecialchars($order_id); ?></strong>
                    </div>
                    <div class="amount-row">
                        <span>Total Amount</span>
                        <span><?php echo number_format($amount, 2); ?></span>
                    </div>
                    <div class="amount-row total">
                        <span>Amount to Pay</span>
                        <strong>NPR. <?php echo number_format($amount, 2); ?></strong>
                    </div>
                </div>
            </div>

            <!-- Right Section: Sign In Form -->
            <div class="right-section">
                <h2 class="signin-title">Sign in to your account</h2>
                
                <form method="POST" action="mock_esewa.php">
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                    <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                    <input type="hidden" name="confirm" value="1">

                    <div class="form-group">
                        <label for="esewa_id">eSewa ID</label>
                        <input type="text" id="esewa_id" class="form-input" placeholder="Enter your eSewa ID" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password/MPIN</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" class="form-input" placeholder="Enter your password" required>
                            <span class="password-toggle" onclick="togglePassword()">👁</span>
                        </div>
                    </div>

                    <div class="captcha-box">
                        ☑ I'm not a robot (reCAPTCHA simulation)
                    </div>

                    <button type="submit" class="btn btn-primary">LOGIN</button>

                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <div class="register-link">
                        Don't have an account? <a href="#">Register</a>
                    </div>
                </form>

                <div class="cancel-payment">
                    <a href="fashionApp.php?act=home">CANCEL PAYMENT</a>
                </div>
            </div>
        </div>

        <script>
            function togglePassword() {
                const passwordField = document.getElementById('password');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }
            }
        </script>

    <?php else: ?>
        <!-- Payment Success -->
        <div class="payment-wrapper" style="grid-template-columns: 1fr;">
            <div class="success-container">
                <div class="success-icon">✓</div>
                <h1 class="success-title">Payment Successful!</h1>
                <p class="success-message">Your order has been placed successfully.</p>
                
                <div class="order-details">
                    <div class="order-details-row">
                        <span>Order ID:</span>
                        <strong><?php echo htmlspecialchars($order_id); ?></strong>
                    </div>
                    <div class="order-details-row">
                        <span>Amount Paid:</span>
                        <strong>NPR. <?php echo number_format($amount, 2); ?></strong>
                    </div>
                    <div class="order-details-row">
                        <span>Payment Method:</span>
                        <strong>eSewa</strong>
                    </div>
                    <div class="order-details-row">
                        <span>Transaction Date:</span>
                        <strong><?php echo date('Y-m-d H:i:s'); ?></strong>
                    </div>
                </div>

                <a href="fashionApp.php?act=print_invoice&iddh=<?php echo htmlspecialchars($order_id); ?>" class="btn btn-primary">View Invoice</a>
                <a href="fashionApp.php?act=home" class="btn btn-secondary">Continue Shopping</a>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>