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

<!--
<ul class="breadcrumb">
  <li><a href="<?= html_encode(getGalleryIndexURL()) ?>">Home</a></li>
  <? foreach (getParentBreadcrumb() as $el) { ?>
      <li><a href="<?= html_encode($el['link'])?>"><?= html_encode($el['text']) ?></a></li>
  <? } ?>
  <li class="active"><? printAlbumTitle(); ?></li>
</ul>
-->

<p>	<?php printAlbumDesc(); ?> </p>

<div class="row">
	<? while (next_album()) { ?>
        <div class="gal-thumb col-lg-4">
            <div class="row">
                <div class="col-lg-4">
                    <a href="<?php echo html_encode(getAlbumLinkURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumThumbImage(getAnnotatedAlbumTitle(), 'img-rounded'); ?></a>
                </div>
                <div class="col-lg-8">
                    <h4><a href="<?php echo html_encode(getAlbumLinkURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a></h4>
                    <p><?php printAlbumDate(""); ?></p>
                    <p><?php printAlbumDesc(); ?></p>
                </div>
            </div>
        </div>
	<? } ?>
</div>


<div class="container" style="width: auto;">
    <? while (next_image()) { ?>
        <div class="img-thumb">
            <a href="<?php echo html_encode(getImageLinkURL()); ?>" title="<?php printBareImageTitle(); ?>">
                <?php printImageThumb(getAnnotatedImageTitle(), 'img-rounded'); ?>
            </a>
        </div>
    <? } ?>
</div>

<?
$nav = getPageNavList (false, 9, true, getCurrentPage(), max(1, getTotalPages(false) ) );
if (count($nav) > 3) { ?>
    <ul class="pagination">
    <? foreach($nav as $k=>$v) {
          $label = $k;
          if ($k == 'prev') {
            $label = '&laquo;';
          }else if ($k == 'next') {
            $label = '&raquo;';
          }
          $c = '';
          if (empty($v)) {
            $c = 'class="disabled"';
          } else if ($k == getCurrentPage()) {
            $c = 'class="active"';
          }
          ?>

          <li <?= $c ?> ><a href="<?=html_encode($v)?>"><?= $label ?></a></li>
          <?
    } ?>
    </ul>
<?
}
?>
<!--

<div class="container">
    <div>
        <div class="btn-group">
            <button type="button" class="btn btn-default">Prev</button>
        </div>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default">Next</button>
        </div>
    </div>
    <p class="text-center">
    <img src="/assets/img/p.jpg" width="90%">
    </p>
</div>



<div class="container" style="text-align: center;">
<div id="myVideo" width="90%"><p>Loading the player....</p></div>
</div>
<script type="text/javascript" src="/assets/jwplayer/jwplayer.js"></script>
    <script type="text/javascript">
        jwplayer("myVideo").setup({
            file: "/uploads/vid.mp4",
            image: "/uploads/vid.jpg",
            title: "A title",
            aspectratio: "16:9",
            skin: "/assets/jwplayer/six.xml",
            autostart: false,
            stretching: "uniform",
            width: "90%",
            controls: true
        });
    </script>
-->


<hr/>

<footer>
    <p>© Tomasz Janowski <a href="https://twitter.com/janowskit">@janowskit</a></p>
</footer>


</div>

<script src="<?= $bs_functions->getJSPath() . '/jquery-1.10.2.min.js'?>"></script>
<script src="<?= $bs_functions->getJSPath() . '/bootstrap.min.js'?>"></script>
</body>
</html>
