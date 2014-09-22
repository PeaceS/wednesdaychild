        <div id="faq" class="white_opacity">
            <span>
                <label>faq</label>
            </span>
            <div id="scroll">
                <?php foreach ($faq as $question) { ?>
                <div><?php echo $question['text']; ?></div>
                <?php } ?>
            </div>
        </div>