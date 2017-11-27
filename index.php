<?php
/*
Plugin Name: Poi Player
Plugin URI: https://www.cssplus.org
Description: 2.0.7 修复获取歌单异常的问题，网易是不是又在改API了？？？？？
Author: 蜜汁路易(louie)
Version: 2.0.7
Author URI: https://www.cssplus.org
*/

define('POI_VERSION', '2.0.7');
define('POI_URL', plugins_url('', __FILE__));
define('POI_PATH', dirname(__FILE__));

//require POI_PATH . '/inc/api/Meting.php';
require POI_PATH . '/inc/api/json.php';
//require POI_PATH . '/inc/api/get.php';
require POI_PATH . '/inc/search.php';
require POI_PATH . '/inc/music.php';
require POI_PATH . '/inc/setting.php';

?>