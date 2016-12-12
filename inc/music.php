<?php

add_action('wp_enqueue_scripts', 'poi_scripts');
function poi_scripts() {
    wp_register_style('poi-player', POI_URL . '/build/css/poi.css', array(), POI_VERSION, 'all');
    wp_register_script('poi-libs', POI_URL . '/build/js/player-base.min.js',  array('jquery') , POI_VERSION ,true);
    wp_register_script('poi-player', POI_URL . '/build/js/poi.min.js', array('jquery') , POI_VERSION ,true);
    wp_enqueue_style('poi-player');
    wp_enqueue_script('poi-libs');
    wp_enqueue_script('poi-player');
}

function poi_demo(){
  //默认数据
  $demo = '{
      "album":"Poi Player",
      "CoverImg":"http://p4.music.126.net/mnDq8QSVGXMJ5xE1cPnRXA==/1398578796580197.jpg",
      "list":{
          "title":"Paganini Rocks",
          "artist":"Au Revoir Simone,Robortom",
          "cover":"http://p4.music.126.net/bjES9QPCI7v-huGP3KFqsw==/2532175279095094.jpg",
          "mp3":"http://p2.music.126.net/9a7uxkfw6cqyDlkWy3gUpA==/2087972581156596.mp3",
          "lrc":"'.POI_URL.'/inc/lrc.php?id=4274795"
      },
      "tags":[
          "欧美",
          "下午茶"
      ]
  },{
      "album":"Poi Player",
      "CoverImg":"http://p4.music.126.net/mnDq8QSVGXMJ5xE1cPnRXA==/1398578796580197.jpg",
      "list":{
          "title":"Ruby Feat. Aori (Alwone remix)",
          "artist":"Alwone,Kaivaan",
          "cover":"http://p4.music.126.net/mnDq8QSVGXMJ5xE1cPnRXA==/1398578796580197.jpg",
          "mp3":"http://p2.music.126.net/v7iz903w7dRs-t78GBrO4Q==/1405175866329111.mp3",
          "lrc":"'.POI_URL.'/inc/lrc.php?id=409646326"
      },
      "tags":[
          "欧美",
          "下午茶"
      ]
  },';

  return $demo;
}

add_action('wp_footer', 'PoiPlayer_bar');
function PoiPlayer_bar(){ 
  $poi = get_option('poi_options');
  if(wp_is_mobile()) {
    if($poi['mobilehide'] == '0') $dis = 'style="display: none;"';
    $autoplay = false;
  }else{
    $autoplay = $poi['autoplay'];
  }
  ?>
  <!-- POI PLAYER BAR -->
  <div id="poi-play-bar" class="poi-play-bar poi-c" <?php echo $dis; ?>>
    <div class="poi-control">
      <div class="rewind"><i class="poifont">&#xe60e;</i></div>
      <div class="poiplay playing loadMusic"><i class="poifont">&#xe60c;</i></div>
      <div class="fastforward"><i class="poifont">&#xe60f;</i></div>
      <div class="poi-progress">
        <div class="poi-sider">
          <div class="poi-loaded"></div>
          <div class="poi-pace"></div>
        </div>
        <span class="poi-tag poi-song-title">正在获取，请稍候...</span>
      </div>
      <div class="poi-timer">00:00/00:00</div>
      <div class="shuffle-play"><i class="poifont shuffle">&#xe604;</i></div>
      <div class="poi-volume"><i class="poifont mute">&#xe605;</i></div>
      <div class="poi-open-list"><i class="poifont">&#xe609;</i></div>
    </div>
    <div id="open-poi-player"><i class="poifont">&#xe608;</i></div><!-- Open Bar -->
  </div>
  <div id="poi-music-list" class="poi-music-list-c">
    <div class="poi-list-title">
      <span class="poi-album-tiele"></span>
      <span class="poi-album-tags"></span>
      <?php if($poi['searchide'] != '0') : ?>
      <form action="<?php //echo $_SERVER["REQUEST_URI"]; ?>" method="post">
        <label>
        <i class="poifont">&#xe600;</i>
        <input type="text" name="sname" id="sname" value="<?php echo isset($_POST['sname'])?$_POST['sname']:''; ?>"  placeholder="Search..." required />
        <input type="hidden" name="boxsearch_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        </label>
      </form>
      <?php  endif; ?>
      <span class="poi-list-close" style="<?php if($poi['searchide'] == '0') echo 'display: block' ?>"><i class="poifont">&#xe60b;</i></span>
    </div>
    <div id="poi-playlist"><ul></ul></div>
    <div id="poi-lrc" class="poi-lrc-c">
      <div id="lrcWrap" class="lrc-wrap lrc-wrap-open">
        <div id="lrcBox" class="lrc-box">
          <div id="lrc_2"></div>
        </div>
      </div>
      <div id="scripylrc"><p></p></div>
    </div>
    <div id="poi-song-cover">
      <img src="<?php echo POI_URL?>/build/images/cover.jpg">
    </div>
    <div class="czui czui-c"></div>
  </div>
  <?php if(empty($_POST['poisearch_to'])){ ?>
  <?php $json = $poi['poimusic'] ? $poi['poimusic'] : poi_demo(); ?>
  <div id="music-json" class="music-json" style="display: none;">
    <script type="text/javascript">
    <?php $sname = isset($_POST['sname'])?$_POST['sname']:''; if(empty($_POST['boxsearch_to'])){?>
    var playlist = [<?php echo $json; ?>],
    mautoplay = "<?php echo $autoplay;?>",
    mshuffle = "<?php echo $poi['shuffle'];?>",
    boxsearch = false;
    <?php }else{ ?>
    var playlist = [<?php echo get_search_jsons($sname); ?>],
    mautoplay = false,
    mshuffle = false,
    boxsearch = "ok";
    <?php } ?>
    </script>
  </div>
<?php 
  }
}

