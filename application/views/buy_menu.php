            <div id="payment_menu">
                <a <?php if ($buy == 1) { ?>class="selected"<?php } ?> href="/buy/1">BAGS </a>/
                <?php if ($buy >= 2 || isset($bag)) { ?><a <?php if ($buy == 2) { ?>class="selected"<?php } ?> href="/buy/2"><?php } ?>
                    Shipping Address
                <?php if ($buy >= 2 || isset($bag)) { ?></a><?php } ?>/
                <?php if ($buy >= 3 || isset($shippingAddress)) { ?><a <?php if ($buy == 3) { ?>class="selected"<?php } ?> href="/buy/3"><?php } ?>
                    Summary
                <?php if ($buy >= 3 || isset($shippingAddress)) { ?></a><?php } ?>/
                <?php if ($buy >= 4 || isset($shippingAddress)) { ?><a <?php if ($buy == 4) { ?>class="selected"<?php } ?> href="/buy/4"><?php } ?>
                    Payment Method
                <?php if ($buy >= 4 || isset($shippingAddress)) { ?></a><?php } ?>/
            </div>
        </div>