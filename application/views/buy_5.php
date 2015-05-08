        <div id="bankwire" class="payment white_opacity">
            <label>Payment Method</label>
            <table class="payment_select">
                <tr><td>Bank Wire</td></tr>
            </table>
            <div id="scroll">
                <div id="sub_scroll">
                    <p>please send us a bank wire with:</p>
                    <p>- An amount of <?php echo $totalAmount; ?> THB</p>
                    <p>- To one of these accounts:</p>
                    <?php foreach ($bankDetail as $account) {
                        $detail = explode(",", $account['value']);
                        $detail[0] = ucwords($detail[0]);
                        $detail[1] = substr($detail[1], 0, 3) . "-" . substr($detail[1], 3, 1) . "-" . substr($detail[1], 4, 5) . "-" . substr($detail[1], -1, 1);
                        $detail[2] = ucwords($detail[2]);
                        $detail[3] = ucwords($detail[3]);
                    ?>
                    <p>
                        the account owner of <b><?php echo $detail[0]; ?></b> with these details: account number <b><?php echo $detail[1]; ?></b> saving account.<br>
                        to <b><?php echo $detail[2]; ?>, <?php echo $detail[3]; ?></b> branch
                    </p>
                    <?php } ?>
                </div>
            </div>
            <ul id="menu">
                <li id="up" title="scroll up"></li>
                <li id="down" title="scroll down"></li>
            </ul>
            <div id="menu">
                <a href="/buy/4"><label class="back">back</label></a>
                <a href="javascript:confirm();"><label class="next">confirm</label></a>
            </div>