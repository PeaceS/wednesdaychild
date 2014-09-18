<head>
	<title>Wednesday Child</title>

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/overall.css" />

        <?php if (isset($home)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/home.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/banner/banner_<?php echo $home; ?>.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_menu.css" />
        <?php } else { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/main.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_collection.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_menu.css" />
        <?php } ?>
        <?php if (isset($collection)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection/collection_<?php echo $collection; ?>.css" />
        <?php } ?>
        <?php if (isset($shop)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/shop.css" />
        <?php } ?>
        <?php if (isset($product)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/product.css" />
        <?php } ?>
        <?php if (isset($shop) || isset($product)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/side_menu.css" />
        <?php } ?>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/lib/jquery-1.11.1.min.js"></script>

        <?php if (isset($home)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/home.js"></script>
        <?php } ?>
        <?php if (isset($collection)) { ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/collection.js"></script>
        <?php } ?>
</head>