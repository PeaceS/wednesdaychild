        <div id="contact" class="white_opacity">
            <label>wednesdaychildheadquarter</label>
            <div id="detail">
                <p>address: <?php echo $contact[1]['value']; ?></p>
                <p>email: <a href="mailto:<?php echo $contact[2]['value']; ?>"><?php echo $contact[2]['value']; ?></a></p>
                <p>facebook: <a href="https://www.facebook.com/<?php echo $contact[3]['value']; ?>" target="_blank"><?php echo $contact[3]['value']; ?></a></p>
                <p>IG: <a href="http://instagram.com/<?php echo $contact[4]['value']; ?>" target="_blank"><?php echo $contact[4]['value']; ?></a></p>
            </div>
            <div id="message">
                <label>leavemessage</label>
                <input type="text" id="name" placeholder="name" />
                <input type="text" id="email" placeholder="email" />
                <textarea id="body" placeholder="message"></textarea>
                <a href="javascript:send();"><label>send</label></a>
            </div>
        </div>