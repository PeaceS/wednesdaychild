<head>
	<title>Wednesday Child</title>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/overall.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/script/lib/jquery-1.11.1.min.js"></script>
        
        <?php if (isset($home)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/home.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/banner/banner_<?php echo $home; ?>.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_menu.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/home.js"></script>
        <?php } ?>
        
        <?php if (isset($collection)) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/main.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/collection/collection_<?php echo $collection; ?>.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_collection.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/list_menu.css" />
        <?php } ?>
</head>