<?php

function poiplayer_setting() {  
    wp_register_style( 'poiplayer-setting', POI_URL . '/build/css/setting.css', array(), POI_VERSION, 'all' );  
    wp_enqueue_style( 'poiplayer-setting' );  
}  
add_action( 'admin_enqueue_scripts', 'poiplayer_setting' );

//添加设置页面
add_action('admin_menu', 'poi_player_options');
function poi_player_options() {
    add_menu_page('PoiPlayer', 'PoiPlayer', 'manage_options', __FILE__, 'poi_player_options_code');
}
//注册设置
add_action('admin_init','poi_setting');
function poi_setting(){
  register_setting('poi_setting_group','poi_options');
}

function poi_player_options_code(){ ?>
  <div id="poi-player-body">
    <div class="poi-player-center">
      <h2>Poi Player Setting</h2>
      <div class="poi-search-box">
        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
          <select id="music-type" name="select">
              <option value="0">选择类型</option>
              <option value="1">歌单</option>
              <option value="2">专辑</option>
          </select> 
          <input type="text" name="mid" id="mid" value="<?php echo isset($_POST['mid'])?$_POST['mid']:''; ?>"  placeholder="歌单或专辑ID" required />
          <input class="button" id="button" name="submit" type="submit" value="获取">
          <input type="hidden" name="getjson_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        </form>
      </div>
      <form method="post" action="options.php">
      	<?php 
        settings_fields('poi_setting_group');
        $poi = get_option('poi_options');
        $input = isset($_POST['mid'])?$_POST['mid']:''; 
        $type = isset($_POST['select'])?$_POST['select']:''; 
      	?>
	   	  <textarea class="music-json" rows="8" cols="100" name="poi_options[poimusic]"><?php
	      $json = empty($_POST['getjson_to']) ? $poi['poimusic'] : get_jsons($input,$type);
	      echo $json;
	      ?></textarea>
	      <div class="poi-other">
	        <input type="checkbox" name="poi_options[autoplay]" class="autoplay" value="0" <?php checked('0',$poi['autoplay']); ?> /><span>自动播放</span>
          <input type="checkbox" name="poi_options[shuffle]" class="shuffle" value="0" <?php checked('0',$poi['shuffle']); ?> /><span>随机播放</span>
	      </div>
        <input type="submit" name="save" class="button" value="保存设置" />
      </form>
      <?php if ( isset($_REQUEST['settings-updated']) ){
        echo '<div id="message" class="updated"><p>保存成功了Poi~</p></div>';
      }?>
      <hr/>
      <div class="poi-ps">
      <p>关于音乐搜索功能： 需要主机开启fsockopen()函数，否则无法获取数据，另外可能存在主机IP被墙而无法播放歌曲的问题，大多出现在海外IP的站点。使用该功能在新建页面添加短代码 [PoiMusic] 即可。</p>
      <p>与Poi Player(RC-1)版本冲突，不要同时启用（应该没人会这么做吧？）。</p>
      <p>Poi Player 版本2.0.0 最后更新于2016.10.27 @Louie</p>
      </div>
    </div>
  </div>
<?php
}