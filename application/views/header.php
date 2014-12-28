<head>
	<title>Wednesday Child</title>
        <meta charset="UTF-8">
        
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/overall.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_menu.css" />

        <?php if (isset($home)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/home.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/banner/banner_<?php echo $home; ?>.css" />
        <?php } else { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/main.css" />
        <?php } ?>
        <?php if (isset($collection)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection/collection_<?php echo $collection; ?>.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_collection.css" />
        <?php } ?>
        <?php if (isset($shop)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/shop.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/side_menu.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_collection.css" />
        <?php } ?>
        <?php if (isset($product)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/product.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/side_menu.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_collection.css" />
        <?php } ?>
        <?php if (isset($policy)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/policy.css" />
        <?php } ?>
        <?php if (isset($faq)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/faq.css" />
        <?php } ?>
        <?php if (isset($buy)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/buy_<?php echo $buy; ?>.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/buy_menu.css" />
        <?php } ?>
        <?php if (isset($contact)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/contact.css" />
        <?php } ?>
        <?php if (isset($confirm)) { ?>
            <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/confirm.css" />
        <?php } ?>
        <?php if (isset($popup)) { ?>
            <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/popup.css" />
        <?php } ?>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/lib/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/overall.js"></script>

        <?php if (isset($home)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/home.js"></script>
        <?php } ?>
        <?php if (isset($collection)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/collection.js"></script>
        <?php } ?>
        <?php if (isset($shop)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/shop.js"></script>
        <?php } ?>
        <?php if (isset($product)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/product.js"></script>
        <?php } ?>
        <?php if (isset($buy) && $buy != 4) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/payment_<?php echo $buy; ?>.js"></script>
        <?php } ?>
        <?php if (isset($paypal)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/paypal.js"></script>
        <?php } ?>
        <?php if (isset($contact)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/contact.js"></script>
        <?php } ?>
        <?php if (isset($confirm)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/confirm.js"></script>
        <?php } ?>
    <?php if (isset($popup)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/popup.js"></script>
    <?php } ?>
</head>
