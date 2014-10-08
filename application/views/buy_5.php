        <div id="bankwire" class="white_opacity">
            <div id="scroll">
                <div id="sub_scroll">
                    <label>Payment Method</label>
                    <table>
                        <tr><td>Bank Wire</td></tr>
                    </table>
                    <div>
                        <p class="upper">please send us a bank wire with:</p>
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
                            the account owner of <?php echo $detail[0]; ?><br>
                            with these details account number <?php echo $detail[1]; ?> saving account.<br>
                            to <?php echo $detail[2]; ?>, <?php echo $detail[3]; ?> branch
                        </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <ul id="menu">
                <li id="up" title="scroll up"></li>
                <li id="down" title="scroll down"></li>
            </ul>
            <div id="menu">
                <a href="/buy/4"><label class="back">back</label></a>
                <a href="/buy/bankwire/confirm"><label class="next">confirm</label></a>
            </div>