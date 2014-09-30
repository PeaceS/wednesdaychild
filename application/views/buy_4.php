        <div id="summary" class="white_opacity">
            <div id="scroll">
                Purchased List
                <table>
                    <tr>
                        <td width="50%">Item Name</td>
                        <td width="15%">Size</td>
                        <td width="15%">Color</td>
                        <td width="20%">Price(s)</td>
                    </tr>
                </table>
                <div id="sub_scroll">
                    <table>
                        <?php foreach ($bag as $item) { ?>
                        <tr class="item" product="<?php echo $item['product']; ?>">
                            <td width="50%" class="name"><?php echo $item['name']; ?></td>
                            <td width="15%" class="size">
                                <?php foreach ($item['size'] as $size) { ?>
                                <?php if ($size['product_no'] == $item['product']) { echo $size['product_size']; } ?>
                                <?php } ?>
                            </td>
                            <td width="15%" class="color">
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
                            <td width="20%" class="price"><?php echo number_format($item['price'], 2, '.', ','); ?></td>
                        </tr>
                        <?php } ?>
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