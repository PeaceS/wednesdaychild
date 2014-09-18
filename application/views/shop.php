        <div id="shop">
            <div id="scroll">
                <?php for ($i = 0; $i < count($listProduct); $i++) { ?>
                <a href="/product/<?php echo $listProduct[$i]['product_no']; ?>">
                    <img class="<?php echo "col" . ($i % 5); ?>" src="<?php echo base_url() . 'assets/image/product/' . $collection . '/' . $listProduct[$i]['image_url']; ?>" />
                </a>
                <?php } ?>
            </div>
        </div>
        <ul id="menu">
            <li id="up" title="scroll up"></li>
            <li id="down" title="scroll down"></li>
        </ul>