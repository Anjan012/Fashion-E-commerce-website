<div class="axil-checkout-area axil-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="axil-checkout-billing">
                    <?php
                    $checs = 1;
                    echo '
                    <form action="fashionApp.php?act=check_out_update" method="POST" id="checkoutForm">
                        <h4 class="title mb--40">Order details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" id="first-name" value="'.$more_order[0]['fname'].'" placeholder="First Name" name="fname" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" id="last-name" value="'.$more_order[0]['lname'].'" placeholder="Last Name" name="lname" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address <span>*</span></label>
                            <input type="text" value="'.$more_order[0]['address'].'" id="country" name="address" required>
                        </div>
                        <div class="form-group">
                            <label>Phone <span>*</span></label>
                            <input type="tel" value="'.$more_order[0]['phone'].'" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address <span>*</span></label>
                            <input type="email" value="'.$more_order[0]['email'].'" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Other Notes (optional)</label>
                            <textarea name="notes" id="notes" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                        <input type="hidden" value="'.$iddh.'" name="iddh">
                    ';
                    ?>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="axil-order-summery order-checkout-summery">
                    <h5 class="title mb--20">Your Order</h5>
                    <div class="summery-table-wrap">
                        <table class="table summery-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th style="text-align:left;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($more_cart as $cart) {
                                    if($iddh == $cart['id_order']) {
                                        echo '
                                        <tr class="order-product">
                                            <td>'.$cart['name_pro'].' <span class="quantity">x'.$cart['quantity'].'</span></td>
                                            <td>'.$cart['size'].'</td>
                                            <td style="text-align:left;">Rs. '.number_format($cart['prices']).'</td>
                                        </tr>
                                        ';
                                    }
                                }
                                ?>
                                <?php
                                $total = 0;
                                foreach($more_order as $order) {
                                    if($iddh == $order['id']) {
                                        $total = $order['total_prices'];
                                    }
                                }
                                echo '
                                <tr class="order-subtotal">
                                    <td>Subtotal</td>
                                    <td>Rs. '.number_format($total).'</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="order-shipping">
                                            <div class="shipping-amount">
                                                <span class="title">Shipping Method</span>
                                                <span class="amount">Rs. 0.00</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input type="radio" id="radio1" name="shipping" checked>
                                            <label for="radio1">Free Shipping</label>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input type="radio" id="radio2" name="shipping">
                                            <label for="radio2">Local</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <td>Total</td>
                                    <td class="order-total-amount">Rs. '.number_format($total).'</td>
                                </tr>
                                ';
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Submit button INSIDE the form -->
                    <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Pay with esewa</button>
                    </form>
                    <!-- Form closes here -->
                    
                </div>
            </div>
        </div>
    </div>
</div>