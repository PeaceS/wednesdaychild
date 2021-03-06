        <div id="product" class="white_opacity" no="<?php echo $product_no; ?>">
            <div id="detail">
                <p id="product_name"><?php echo $product['product_name']; ?></p>
                <div class="product_detail"><?php echo $product['product_detail']; ?></div>
                <div class="product_detail"><?php echo $product['product_fabric']; ?></div>
                <div class="product_detail"><?php echo $product['product_fit']; ?></div>
                <div class="product_detail"><?php echo $product['product_measurement']; ?></div>
            </div>
            <div id="buy_product">
                ^ Click to Buy
            </div>
            <div id="select">
                <?php if (isset($outOfStock)) { ?>
                <span id="product_outOfStock">out of stock</span>
                <?php } ?>
                <div id="product_price">
                    <div><?php echo $product['product_price']; ?> B</div>
                </div>
                <?php if (!isset($outOfStock)) { ?>
                <p class="product_select qty">Quantity <input type="number" value="1" min="1" max="<?php echo $product['product_stock']; ?>"></p>
                <p class="product_select">Size <select>
                    <?php foreach ($product_size as $size) { ?>
                    <option value="<?php echo $size['product_no']; ?>" <?php if ($size['product_no'] == $product['product_no']) { ?>selected="true"<?php } ?>>
                        <?php echo $size['product_size']; ?>
                    </option>
                    <?php } ?>
                </select></p>
                <?php } ?>
                <table class="product_action">
                    <tr>
                        <td>
                            <?php if (!isset($outOfStock)) { ?>
                            <a href="javascript:buy(<?php echo $product['product_name']; ?>);"><label>add to bag</label></a>
                            <?php } ?>
                        </td>
                        <td id="product_image">
                            <?php for($i = count($product_image) - 1; $i > 0; $i--) { ?>
                            <div title="image <?php echo $i + 1; ?>" style="background-image: url('<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[$i]['image_url']; ?>');" zoom="url('<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[$i]['image_zoom']; ?>')">&nbsp;</div>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="image normal">
                <span title="image 1" style="background-image: url('<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[0]['image_url']; ?>');"></span>
            </div>
            <div class="image zoom">
                <span style="background-image: url('<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[0]['image_zoom']; ?>');"></span>
            </div>
        </div>
        <div id="relate" class="white_opacity">
            <label>Related-Item</label>
            <div id="scroll">
                <div>
                    <?php foreach ($product_related as $related) { ?>
                    <a href="/product/<?php echo $related['related_no']; ?>">
                        <span style="background-image: url('<?php echo base_url() . 'assets/image/product/' . substr($related['related_no'], 0, 3) . '/' . $related['image_url']; ?>');"></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <ul id="menu" class="on-shop">
            <li id="up" title="scroll up"></li>
            <li id="down" title="scroll down"></li>
        </ul>