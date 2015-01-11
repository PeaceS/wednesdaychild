        <div id="collection">
            <?php for ($i = 0; $i < $itemAmount; $i++) { ?>
            <div class="<?php echo "item" . $i; ?>"></div>
            <?php } ?>
        </div>
        <ul id="menu" class="on-collection">
            <li id="up" title="scroll up"></li>
            <li id="down" title="scroll down"></li>
            <li id="mode" title="change mode"></li>
        </ul>