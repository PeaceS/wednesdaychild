        <div id="bag" class="white_opacity">
            <span id="bag_background"></span>
            <div id="scroll">
                My Bags
                <div id="sub_scroll">
                    <table>
                        <tr>
                            <td>Item Pics</td>
                            <td>Item Name</td>
                            <td>Size</td>
                            <td>Color</td>
                            <td>Quantity</td>
                            <td>Price(s)</td>
                            <td>Remove</td>
                        </tr>
                        <?php foreach ($bag as $item) { ?>
                        <tr>
                            <td><span id="item_image" style="background-image: url('<?php echo $item['image']; ?>');"></span></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['size']; ?></td>
                            <td>
                                <?php if (!strpos($item['color'], '.')) { ?>
                                <span id="item_color" style="background-color: <?php echo $item['color'] ?>;">
                                <?php } else { ?>
                                <span id="item_color" style="background-image: url(<?php echo base_url() . 'assets/image/color/' . $item['color'] ?>);">
                                <?php } ?>
                                </span>
                            </td>
                            <td><?php echo $item['qty']; ?></td>
                            <td><?php echo number_format($item['price'], 2, '.', ','); ?></td>
                            <td>X</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>