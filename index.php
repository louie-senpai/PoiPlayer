<?php
/*
Plugin Name: Poi Player
Plugin URI: http://i94.me/
Description: 又一款网易云外链播放器，集成了音乐搜索，支持ajax全站播放
Author: Louie
Version: 2.0.3
Author URI: http://i94.me/
*/

define('POI_VERSION', '2.0.3');
define('POI_URL', plugins_url('', __FILE__));
define('POI_PATH', dirname(__FILE__));

require POI_PATH . '/inc/api/json.php';
require POI_PATH . '/inc/api/get.php';
require POI_PATH . '/inc/search.php';
require POI_PATH . '/inc/music.php';
require POI_PATH . '/inc/setting.php';

?>