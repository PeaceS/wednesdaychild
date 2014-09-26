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
                        </tr>
                        <?php foreach ($bag as $item) { ?>
                        <tr>
                            <td><span style="background-image: url('<?php echo $item['image']; ?>');"></span></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['size']; ?></td>
                            <td><?php echo $item['color']; ?></td>
                            <td><?php echo $item['qty']; ?></td>
                            <td><?php echo number_format($item['price'], 2, '.', ','); ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>