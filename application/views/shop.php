        <div id="shop">
            <div id="scroll" class="white_opacity">
                <?php for ($i = 0; $i < count($listProduct); $i++) { ?>
                <a href="/product/<?php echo $listProduct[$i]['product_no']; ?>">
                    <span class="<?php echo "col" . ($i % 5); ?>" style="background-image: url('<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $listProduct[$i]['image_url']; ?>');"></span>
                </a>
                <?php } ?>
            </div>
        </div>
        <ul id="menu" class="on-shop">
            <li id="up" title="scroll up"></li>
            <li id="down" title="scroll down"></li>
        </ul>