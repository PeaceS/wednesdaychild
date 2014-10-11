<body>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="item_name" value="SundayDog Purchased" />
        <input type="hidden" name="currency_code" value="THB" />
        <input type="hidden" name="button_subtype" value="services" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="business" value="<?php echo $paypal_account; ?>" />
        <input type="hidden" name="invoice" value="<?php echo $refNo; ?>" />
        <input type="hidden" name="item_number" value="<?php echo $refNo; ?>" />
        <input type="hidden" name="amount" value="<?php echo ($totalCost + $shippingCost); ?>" />
        <input type="hidden" name="email" value="<?php echo $buyer_mail; ?>" />
        <input type="hidden" name="first_name" value="<?php echo $_REQUEST['first_name']; ?>" />
        <input type="hidden" name="last_name" value="<?php echo $_REQUEST['last_name']; ?>" />
        <input type="hidden" name="address1" value="<?php echo $_REQUEST['address1']; ?>" />
        <input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" />
        <input type="hidden" name="state" value="<?php echo $_REQUEST['state']; ?>" />
        <input type="hidden" name="zip" value="<?php echo $_REQUEST['zip']; ?>" />
        <input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" />
        <input type="hidden" name="night_phone_b" value="<?php echo $_REQUEST['night_phone_b']; ?>" />
    </form>
</body>