        <div id="faq" class="white_opacity">
            <span>
                <label>faq</label>
            </span>
            <div id="scroll">
                <div id="sub_scroll">
                    <?php foreach ($faq as $item) { ?>
                    <div class="question"><?php echo $item['question']; ?></div>
                    <div class="answer"><?php echo $item['answer']; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>