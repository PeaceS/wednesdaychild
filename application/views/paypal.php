<body>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="business" value="<?php echo $business; ?>" />
        <input type="hidden" name="currency_code" value="THB" />
        <input type="hidden" name="item_name_1" value="566889" />
        <input type="hidden" name="amount_1" value="10000" />
        <input type="hidden" name="item_name_2" value="123445" />
        <input type="hidden" name="amount_2" value="5000" />
        <input type="hidden" name="quantity_2" value="2" />
        <input type="hidden" name="shipping_2" value="1000" />
    </form>
</body>