        <ul id="list">
            <?php foreach ($listCollection as $row) { ?>
            <?php if ($row['collection_code'] == $collection) { ?>
            <li class="selected">
            <?php }else { ?>
            <li>
            <?php } ?>
                <a href="/collection/<?php echo $row['collection_code']; ?>">collection <?php echo $row['collection_name']; ?></a>
            </li>
            <?php } ?>
        </ul>