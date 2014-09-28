        <div id="bag" class="white_opacity">
            <span id="bag_background"></span>
            <div id="scroll">
                My Bags
                <div id="sub_scroll">
                    <table>
                        <tr>
                            <td width="12%">Item Pics</td>
                            <td width="42%">Item Name</td>
                            <td width="6%">Size</td>
                            <td width="7%">Color</td>
                            <td width="12%">Quantity</td>
                            <td width="14%">Price(s)</td>
                            <td width="7%">Remove</td>
                        </tr>
                        <?php foreach ($bag as $item) { ?>
                        <tr class="item" product="<?php echo $item['product']; ?>">
                            <td><span id="item_image" style="background-image: url('<?php echo $item['image']; ?>');"></span></td>
                            <td><?php echo $item['name']; ?></td>
                            <td>
                                <select>
                                    <?php foreach ($item['size'] as $size) { ?>
                                    <option value="<?php echo $size['product_no']; ?>" <?php if ($size['product_no'] == $item['product']) { ?>selected="true"<?php } ?>>
                                        <?php echo $size['product_size']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <?php foreach ($item['color'] as $color) { ?>
                                <?php if (!strpos($color['product_color'], '.')) { ?>
                                <span product="<?php echo $color['product_no'] ?>;" style="background-color: <?php echo $color['product_color'] ?>;" class="color <?php if ($color['product_no'] == $item['product']) { echo "selected"; } ?>">
                                <?php } else { ?>
                                <span product="<?php echo $color['product_no'] ?>;" style="background-image: url(<?php echo base_url() . 'assets/image/color/' . $color['product_color'] ?>);" class="color <?php if ($color['product_no'] == $item['product']) { echo "selected"; } ?>">
                                <?php } ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td><input id="select_qty" type="number" value="<?php echo $item['qty']; ?>" min="1" max="<?php echo $item['stock']; ?>" /></td>
                            <td id="price" price="<?php echo $item['price']; ?>"><?php echo number_format($item['price'], 2, '.', ','); ?></td>
                            <td class="remove">X</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>