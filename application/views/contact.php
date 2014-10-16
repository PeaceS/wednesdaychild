        <div id="contact" class="white_opacity">
            <label>wednesdaychildheadquarter</label>
            <div id="detail">
                <p>address: <?php echo $contact[1]['value']; ?></p>
                <p>email: <a href="mailto:<?php echo $contact[2]['value']; ?>"><?php echo $contact[2]['value']; ?></a></p>
                <p>facebook: <a href="<?php echo $contact[3]['value']; ?>"><?php echo $contact[3]['value']; ?></a></p>
                <p>IG: <a href="http://instagram.com/<?php echo $contact[4]['value']; ?>"><?php echo $contact[4]['value']; ?></a></p>
                <br>
                <p>bank account</p>
                <?php
                    $detail = explode(",", $contact[0]['value']);
                    $detail[0] = ucwords($detail[0]);
                    $detail[1] = substr($detail[1], 0, 3) . "-" . substr($detail[1], 3, 1) . "-" . substr($detail[1], 4, 5) . "-" . substr($detail[1], -1, 1);
                    $detail[2] = ucwords($detail[2]);
                    $detail[3] = ucwords($detail[3]);
                ?>
                <p><?php echo $detail[0]; ?></p>
                <p><?php echo $detail[1]; ?></p>
                <p><?php echo $detail[2]; ?> (<?php echo $detail[3]; ?>)</p>
            </div>
            <div id="message">
                <label>leavemessage</label>
                <?php echo form_open('contact/send'); ?>
                    <input type="text" name="name" />
                    <input type="text" name="email" />
                    <textarea name="message"></textarea>
                </form>
            </div>
        </div>