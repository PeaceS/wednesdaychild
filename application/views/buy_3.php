        <div id="summary" class="white_opacity">
            <div id="scroll">
                <div id="sub_scroll">
                    Purchased List
                    <table>
                        <tr>
                            <td width="40%">Item Name</td>
                            <td width="12%">Size</td>
                            <td width="13%">Color</td>
                            <td width="17%">Quantity</td>
                            <td width="18%">Price(s)</td>
                        </tr>
                        <?php foreach ($bag as $item) { ?>
                        <tr class="item" product="<?php echo $item['product']; ?>">
                            <td class="name"><?php echo $item['name']; ?></td>
                            <td class="size">
                                <?php foreach ($item['size'] as $size) { ?>
                                <?php if ($size['product_no'] == $item['product']) { echo $size['product_size']; } ?>
                                <?php } ?>
                            </td>
                            <td class="color">
                                <?php foreach ($item['color'] as $color) { ?>
                                <?php if ($color['product_no'] == $item['product']) { ?>
                                <?php if (!strpos($color['product_color'], '.')) { ?>
                                <span style="background-color: <?php echo $color['product_color'] ?>;">
                                <?php } else { ?>
                                <span style="background-image: url(<?php echo base_url() . 'assets/image/color/' . $color['product_color'] ?>);">
                                <?php } ?>
                                </span>
                                <?php } ?>
                                <?php } ?>
                            </td>
                            <td class="qty"><?php echo $item['qty']; ?></td>
                            <td class="price"><?php echo number_format($item['price'], 2, '.', ','); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">Shipping Cost</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3">Total Price</td>
                            <td></td>
                        </tr>
                        <tr><td colspan="4">Billing Address</td></tr>
                        <tr><td colspan="4"><?php echo $shippingAddress['first'] . " " . $shippingAddress['last']; ?></td></tr>
                        <tr>
                            <td colspan="4">
                                <?php echo $shippingAddress['address'] . ", " . $shippingAddress['city'] . " " . $shippingAddress['zip'] . ", " . $shippingAddress['country']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <?php echo $shippingAddress['phone'] . " | " . $shippingAddress['email']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <ul id="menu">
                <li id="up" title="scroll up"></li>
                <li id="down" title="scroll down"></li>
            </ul>
            <div id="menu">
                <a href="/buy/2"><label class="back">back</label></a>
                <a href="/buy/4"><label class="next">confirm</label></a>
            </div>