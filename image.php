<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php printBareGalleryTitle(); ?> | <?php printBareAlbumTitle(); if ($_zp_page > 1) echo "[$_zp_page]"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tomasz Janowski">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Le styles -->
    <link href="<?= $bs_functions->getStylesPath() . '/custom.css?ts=201307171656'?>" rel="stylesheet">
    <link href="<?= $bs_functions->getStylesPath() . '/bootstrap.min.css?ts=201307171656'?>" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?= $bs_functions->getJSPath() . '/html5shiv.js?ts=201307171656'?>"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.ico">
</head>

<body>

<div class="container">
    <div class="navbar navbar-inverse navbar-static-top">
    <div class="container" style="width: auto;">
        <a class="navbar-brand" href="<?= html_encode(getGalleryIndexURL()) ?>"><? printGalleryTitle() ?></a>
        <!--
        <ul class="nav navbar-nav">
          <? foreach (getParentBreadcrumb() as $el) { ?>
              <li><a class="nav navbar-nav" href="<?= html_encode($el['link'])?>"><?= html_encode($el['text']) ?></a><li>
          <? } ?>
          <li><a class="nav navbar-nav inactive"><? printAlbumTitle(); ?></a></li>
        </ul>
        -->
        <form class="navbar-form pull-right">
            <input type="text" class="form-control" style="width: 200px;">
            <button type="submit" class="btn btn-default"><?= gettext('search') ?></button>
        </form>
        <? if (zp_loggedin()) { ?>
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Toolbox <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><? printLink($bs_functions->getCorePath() . '/admin.php', gettext("Overview"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-edit.php', gettext("Albums"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-tags.php', gettext("Tags"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-comments.php', gettext("Comments"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-users.php', gettext("Users"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-options.php?tab=general', gettext("Options"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-themes.php', gettext("Themes"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-plugins.php', gettext("Plugins"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-logs.php', gettext("Logs"), NULL, NULL, NULL);?></li>
                        <li><? printLink($bs_functions->getCorePath() . '/admin-edit.php?page=edit', gettext("Sort Gallery"), NULL, NULL, NULL);?></li>
                        <li class="divider"></li>
                        <li><? printLink($bs_functions->getRootPath() . '/index.php?logout=0', gettext("Logout"), NULL, NULL, NULL);?></li>
                    </ul>
                </li>
            </ul>
        <? } ?>
    </div>
</div>

<div class="row">
<div class="col-lg-10">
<ul class="breadcrumb">
  <li><a href="<?= html_encode(getGalleryIndexURL()) ?>">Home</a></li>
  <? foreach (getParentBreadcrumb() as $el) { ?>
      <li><a href="<?= html_encode($el['link'])?>"><?= html_encode($el['text']) ?></a></li>
  <? }
  $ab = getAlbumBreadcrumb();
  ?>
  <li><a href="<?= html_encode($ab['link'])?>"><?= html_encode($ab['title']) ?></a></li>
  <li class="active"><? printImageTitle(); ?></li>

</ul>
</div>
<div class="col-lg-2">
        <div class="btn-group pull-right">
            <a type="button" class="btn btn-default" <?= hasPrevImage() ? '':'disabled="disabled"'?> href="<?=html_encode(getPrevImageURL())?>">Prev</a>
            <a type="button" class="btn btn-default" <?= hasNextImage() ? '':'disabled="disabled"'?> href="<?=html_encode(getNextImageURL())?>">Next</a>
        </div>
                      </div>
</div>
<? if (strpos($_zp_current_image->imagetype, 'image') !== false) { ?>
<div class="container">
    <p class="text-center">
    <img src="<?=html_encode(getCustomSizedImageMaxSpace(960, 640))?>" width="80%">
    </p>
</div>
<? }else if (strpos($_zp_current_image->imagetype, 'video') !== false) { ?>
<?
$preview_url = WEBPATH.ALBUM_FOLDER_EMPTY . $_zp_current_image->albumname .'/'. $_zp_current_image->objectsThumb;
$video_url = $_zp_current_image->webpath;
?>
<div class="container" style="text-align: center;">
<div id="myVideo" width="80%"><p>Loading the player....</p></div>
</div>
<script type="text/javascript" src="<?= $bs_functions->getJWPlayerPath() . '/jwplayer.js' ?>"></script>
    <script type="text/javascript">
        jwplayer("myVideo").setup({
            file: "<?=html_encode($video_url)?>",
            image: "<?=html_encode($preview_url)?>",
            title: "<?printBareImageTitle()?>",
            aspectratio: "16:9",
            skin: "<?= $bs_functions->getJWPlayerPath() . '/six.xml' ?>",
            autostart: false,
            stretching: "exactfit",
            width: "80%",
            controls: true
        });
    </script>
<? } ?>
<p><?php printImageDesc(); ?></p>


<hr/>

<footer>
    <p>Theme created by <a href="https://twitter.com/janowskit">@janowskit</a></p>
</footer>


</div>

<script src="<?= $bs_functions->getJSPath() . '/jquery-1.10.2.min.js'?>"></script>
<script src="<?= $bs_functions->getJSPath() . '/bootstrap.min.js'?>"></script>
</body>
</html>
