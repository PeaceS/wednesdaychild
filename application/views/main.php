<body>
    <section id="blur">
        <div></div>
        <section>
            <span class="<?php if (isset($popup)) { echo $confirm ? "confirm" : "error"; } ?>"></span>
        </section>
    </section>
    <div id="main">
        <label id="logo"></label>
        <div id="top_menu">
            <p>
                <a href="/confirm"><span id="menu_purchaseConfirm">purchase confirm</span></a>
            </p>
            <p>
                <a href="/faq"><span id="menu_faq">faq</span></a>
                <a href="/policy"><span id="menu_policy">policy</span></a>
                <a href="/buy/1"><span id="menu_mybag">mybag(<amount><?php echo $itemCountInBag; ?></amount>)</span></a>
            </p>
        </div>
        <ul id="social">
            <li><a href="https://www.instagram.com/wednesday_child" target="_blank">
                    <img src="<?php echo base_url(); ?>assets/image/icon_instagram.svg" title="instagram" />
                </a></li>
            <li><a href="https://www.facebook.com/wednesdaychildshop" target="_blank">
                    <img src="<?php echo base_url(); ?>assets/image/icon_facebook.svg" title="facebook" />
                </a></li>
        </ul>