<?php
// Get order info from session
$order_id = isset($_SESSION['pay_order_id']) ? $_SESSION['pay_order_id'] : '';
$amount = isset($_SESSION['pay_amount']) ? $_SESSION['pay_amount'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Processing Payment...</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <main class="main-wrapper">
        <div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
            <div style="background-image: url('../assets/images/logo/process.gif'); background-size: cover; background-position: center; transform: scale(0.5); height: 915px; width: 1400px;"></div>
        </div>
    </main>

    <!-- Auto-submit form to mock_esewa.php -->
    <form id="paymentForm" action="mock_esewa.php" method="POST" style="display:none;">
        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
    </form>

    <script>
        // Auto-submit after 2.7 seconds
        setTimeout(function() {
            document.getElementById('paymentForm').submit();
        }, 2700);
    </script>
</body>
</html>

<?php
exit;
?>