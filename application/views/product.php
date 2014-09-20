        <div id="product" class="white_opacity">
            <div id="detail">
                <p id="product_name"><?php echo $product['product_name']; ?></p>
                <p id="product_no"><?php echo $product['product_no']; ?></p>
                <div class="product_detail"><?php echo $product['product_detail']; ?></div>
                <div class="product_detail"><?php echo $product['product_fabric']; ?></div>
                <div class="product_detail"><?php echo $product['product_fit']; ?></div>
                <div id="product_price">
                    <label id="stock_check">stock check</label>
                    <div>Price : <?php echo $product['product_price']; ?> B</div>
                </div>
                <p class="product_select color">Color : 
                    <?php foreach ($product_color as $color) { ?>
                    <?php if (!strpos($color['product_color'], '.')) { ?>
                    <span style="background-color: <?php echo $color['product_color'] ?>;" <?php if ($color['product_no'] == $product['product_no']) { ?>class="selected"<?php } ?>>
                    <?php } else { ?>
                    <span style="background-image: url(<?php echo base_url() . 'assets/image/color/' . $color['product_color'] ?>);" <?php if ($color['product_no'] == $product['product_no']) { ?>class="selected"<?php } ?>>
                    <?php } ?>
                    </span>
                    <?php } ?>
                </p>
                <p class="product_select">Quantity : <input type="number" value="1" min="1" max="<?php echo $product['product_stock']; ?>"></p>
                <p class="product_select">Size Avaliable : <select>
                    <?php foreach ($product_size as $size) { ?>
                    <option value="<?php echo $size['product_no']; ?>" <?php if ($size['product_no'] == $product['product_no']) { ?>selected="true"<?php } ?>>
                        <?php echo $size['product_size']; ?>
                    </option>
                    <?php } ?>
                </select></p>
            </div>
            <div class="image normal">
                <span style="background-image: url(<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[0]['image_url']; ?>);"></span>
            </div>
            <div class="image zoom">
                <span style="background-image: url(<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $product_image[0]['image_zoom']; ?>);"></span>
            </div>
        </div>
        <div id="relate" class="white_opacity">
            
        </div>
        <ul id="menu">
            <li id="up" title="scroll up"></li>
            <li id="down" title="scroll down"></li>
        </ul>