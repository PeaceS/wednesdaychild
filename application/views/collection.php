        <div id="collection">
            <?php for ($i = 0; $i < $itemAmount; $i++){ ?>
            <div class="<?php echo "item" . $i; ?>"></div>
            <?php } ?>
            <span class="tear" id="tear1" top="58"></span>
            <ul id="menu">
                <li id="up" title="scroll up"></li>
                <li id="down" title="scroll down"></li>
                <li id="mode" title="change mode"></li>
            </ul>
        </div>