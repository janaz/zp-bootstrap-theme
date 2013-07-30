<?php

if (!defined('WEBPATH')) die();

class BootstrapThemeFunctions {

    function getThemePath() {
        return join('/', array(WEBPATH, THEMEFOLDER, 'zp-bootstrap-theme'));
    }

    function getStylesPath() {
        return join('/', array($this->getThemePath(), 'assets', 'stylesheets'));
    }

    function getJSPath() {
        return join('/', array($this->getThemePath(), 'assets', 'js'));
    }

    function getJWPlayerPath() {
        return join('/', array($this->getThemePath(), 'assets', 'jwplayer'));
    }

    function getCorePath() {
        return join('/', array(WEBPATH, ZENFOLDER));
    }

    function getRootPath() {
        return WEBPATH;
    }

}

$bs_functions = new BootstrapThemeFunctions();