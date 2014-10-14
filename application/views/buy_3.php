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
                            <td class="price" price="<?php echo $item['price']; ?>"></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <table id="price_and_shipping">
                        <tr>
                            <td width="82%">Shipping Cost</td>
                            <td width="18%"><?php echo number_format($shippingCost, 2, '.', ','); ?></td>
                        </tr>
                        <tr>
                            <td>Total Price</td>
                            <td><?php echo number_format($totalPrice, 2, '.', ','); ?></td>
                        </tr>
                        <tr><td>Billing Address</td></tr>
                        <tr><td><?php echo $shippingAddress['first'] . " " . $shippingAddress['last']; ?></td></tr>
                        <tr>
                            <td>
                                <?php echo $shippingAddress['address'] . ", " . $shippingAddress['city'] . " " . $shippingAddress['zip'] . ", " . $shippingAddress['country']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
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