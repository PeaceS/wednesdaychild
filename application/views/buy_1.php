        <div id="bag" class="white_opacity">
            <span id="bag_background"></span>
            <div id="scroll">
                <table>
                    <tr><td colspan="7">My Bags</td></tr>
                    <tr>
                        <td width="50px"></td>
                        <td width="380px">Item Name</td>
                        <td width="75px">Size</td>
                        <td width="50px">Color</td>
                        <td width="75px">Quantity</td>
                        <td width="100px">Price(s)</td>
                        <td width="20px"></td>
                    </tr>
                </table>
                <div id="sub_scroll">
                    <table>
                        <?php foreach ($bag as $item) { ?>
                        <?php if ($item['stock'] == 0) { ?>
                        <tr class="item preremove" product="<?php echo $item['product']; ?>">
                        <?php } elseif ($item['qty'] > $item['stock']) { ?>
                        <tr class="item change" product="<?php echo $item['product']; ?>">
                        <?php } else { ?>
                        <tr class="item" product="<?php echo $item['product']; ?>">
                        <?php } ?>
                            <td class="image"><span style="background-image: url('<?php echo $item['image']; ?>');"></span></td>
                            <td class="name"><?php echo $item['name']; ?></td>
                            <td class="size">
                                <select>
                                    <?php foreach ($item['size'] as $size) { ?>
                                    <option value="<?php echo $size['product_no']; ?>" <?php if ($size['product_no'] == $item['product']) { ?>selected="true"<?php } ?>>
                                        <?php echo $size['product_size']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="color">
                                <?php foreach ($item['color'] as $color) { ?>
                                <?php if (!strpos($color['product_color'], '.')) { ?>
                                <span product="<?php echo $color['product_no'] ?>;" style="background-color: <?php echo $color['product_color'] ?>;" class="color <?php if ($color['product_no'] == $item['product']) { echo "selected"; } ?>">
                                <?php } else { ?>
                                <span product="<?php echo $color['product_no'] ?>;" style="background-image: url(<?php echo base_url() . 'assets/image/color/' . $color['product_color'] ?>);" class="color <?php if ($color['product_no'] == $item['product']) { echo "selected"; } ?>">
                                <?php } ?>
                                </span>
                                <?php } ?>
                            </td>
                            <?php if ($item['stock'] > 0) { ?>
                            <td class="qty"><input type="number" value="<?php echo $item['qty'] > $item['stock'] ? $item['stock'] : $item['qty']; ?>" min="1" max="<?php echo $item['stock']; ?>" /></td>
                            <td class="price" price="<?php echo $item['price']; ?>"></td>
                            <td class="remove"><a href="javascript:remove(<?php echo $item['name']; ?>);">X</a></td>
                            <?php } else { ?>
                            <td colspan="3">OUT OF STOCK</td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div id="menu">
                <a href="javascript:update();"><label class="update">update</label></a>
                <a href="javascript:checkout();"><label class="next">checkout</label></a>
            </div>