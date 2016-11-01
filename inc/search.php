<?php

//外链搜索工具
add_shortcode('PoiMusic', 'Poi_music_link_shortcode');
function Poi_music_link_shortcode( $atts, $content = null ) {
	if(is_page()){
		return search_music();
	}
    return '[PoiMusic]';
}

function Poi_music_search($input) { ?>
	<div id="music-json" class="music-search-json" style="display: none;">
      <script type="text/javascript">
      var playlist = [<?php echo get_search_jsons($input); ?>],
      mautoplay = false,
      mshuffle = false,
      boxsearch = false;
      </script>
    </div>
<?php 
}

function search_music(){ ?>
	<div class="poi-search-box">
		<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
		    <input type="text" name="mid" id="mid" value="<?php echo isset($_POST['mid'])?$_POST['mid']:''; ?>"  placeholder="歌曲 / 歌手 / 专辑" required />
		    <input class="button" id="button" name="submit" type="submit" value="开始">
	    	<input type="hidden" name="poisearch_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
	    </form>
	</div>
	<div class="poi-search-help">
		<p>如需下载请将外链地址粘贴到迅雷等下载工具。</p>
	</div>
	<div id="poi-search-music-list" class="poi-search-music-list"></div>
	<?php 
	if(!empty($_POST['poisearch_to'])){
		$input = isset($_POST['mid'])?$_POST['mid']:'';
		echo Poi_music_search($input);
	}
}
