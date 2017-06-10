function lcz(){
var _this = this;
this.geci_object, this.geci_lines, this.upkp, this.classV1, this.classV2, this.initTop, this.center, this.empty, this.isDropgeci, this.width, this.height, this.align, this.oneline, this.luminous, this.change, this.staue = !0, this.tag = {}, this.mould = '<ul style="height: 300px;list-style: none;position: relative;line-height: 28px;padding: 0 15px;overflow-y: hidden;display:none;"></ul>', this.getgeci = "Value";
var errmsg = "程序发生异常，无法继续了！";
this.toTimer = function(e) {
	var t, n;
	return t = Math.floor(e / 60), t = isNaN(t) ? "--" : t >= 10 ? t : "0" + t, n = Math.floor(e % 60), n = isNaN(n) ? "--" : n >= 10 ? n : "0" + n, t + ":" + n
}, this.addgeci = function(e, t, n) {
	var r = document.createElement("li");
	r.innerHTML = t ? t : "", r.className = e ? e : "", r.lang = n ? n : "", this.geci_object.appendChild(r), this.geci_lines.push(r)
}, this.getgeciByValue = function(e) {
	le = this.geci_lines.length, e = "^" + e + ".*";
	for (var t = 0; t < le; t++) {
		if (this.geci_lines[t].lang.search(e) == 0) {
			return this.geci_lines[t]
		}
	}
	return null
}, this.getgeciByValueInd = function(e) {
	le = this.geci_lines.length - 1;
	for (var t = le; t >= 0; t--) {
		p = this.geci_lines[t].lang;
		if (p && p < e) {
			return this.geci_lines[t]
		}
	}
	return null
}, this.setClassName = function(e, t) {
	e && (e.className = t)
}, this.upTop = function(e) {
	var t = e.offsetTop,
		n = this.geci_object.scrollTop,
		r = t - this.center;
	this.myf(this.geci_object, n, r)
}, this.remove = function() {
	if (this.geci_lines != null) {
		for (var e = 0; e < this.geci_lines.length; e++) {
			this.geci_object.removeChild(this.geci_lines[e])
		}
	}
	this.geci_lines = new Array, !this.empty && this.empty != 0 && alert("empty 属性有误! 该值必须>=零")
}, this.load = function(json, fun) {
	gecis = json.gecis, end = json[this.tag.end];
	with(this) {
		remove(), _addgeci(json[this.tag.sname]), _addgeci(json[this.tag.cname]), _addgeci(json[this.tag.qname]), _addgeci(json[this.tag.bname]), _addgeci(json[this.tag.sgname]), _addgeci(json[this.tag.special]), _addgeci(json[this.tag.kname])
	}
	if (gecis) {
		for (var index in gecis) {
			this.addgeci(this.classV1, gecis[index].name, gecis[index].time)
		}
	}
	end && (end.time ? this.addgeci(this.classV1, end.end, end.time) : this.addgeci(this.classV1, end)), typeof fun == "function" && fun.call(null, null)
}, this._addgeci = function(e) {
	e && (e.time ? this.addgeci(this.classV1, e.name, e.time) : this.addgeci(this.classV1, e))
}, this.Read = function(e, t) {
	if (t != null && typeof t == "function") {
		return t.call(this, e)
	}
	var n = {};
	n.gecis = new Array;
	var r = e.split("["),
		i = r.length;
	for (var s = 0; s < i; s++) {
		var o = r[s],
			u = o.split("]");
		if (u.length == 2) {
			if (u[0].search("^[0-9]{2}:[0-9]{2}.[0-9]{1,3}$") < 0) {
				title = u[0].split(":"), n = tagswitch(title, n)
			} else {
				var a = {
					time: u[0],
					name: u[1]
				};
				n.gecis.push(a)
			}
		}
	}
	return n
}, this.vls1 = function(e) {
	var n = {};
	n.gecis = new Array;
	var r = e.length,
		i = 0,
		s = 0,
		o = new Array;
	for (var u = 0; u < r; u++) {
		e[u] == "[" && u > 8 && (e.slice(u - 9, u - 1) + "").search("^[0-9]{2}:[0-9]{2}.[0-9]{1,3}$") < 0 && (o.push(e.substring(i, u)), i = u)
	}
	o.push(e.substring(i, r));
	var a = {},
		f = [];
	for (var u = 0; u < o.length; u++) {
		var l = o[u],
			c = l.split("]");
		if (c.length === 2) {
			(c[0] + "").search("^\\[[0-9]{2}:[0-9]{2}.[0-9]{1,3}$") < 0 ? (c[0] = c[0].slice(1), title = c[0].split(":"), n = tagswitch(title, n)) : (h = c[0].slice(1) + "", a[h] = c[1], f.push(h))
		} else {
			if (c.length > 2) {
				var h, e;
				e = c[c.length - 1];
				for (var p in c) {
					c[p].search("^\\[[0-9]{2}:[0-9]{2}.[0-9]{1,3}$") == 0 && (h = c[p].slice(1) + "", a[h] = e, f.push(h))
				}
			}
		}
	}
	f = f.sort();
	for (var p in f) {
		t = f[p];
		var d = {
			time: t,
			name: a[t]
		};
		n.gecis.push(d)
	}
	return n
};
var tagswitch = function(e, t) {
		e.length === 2 && (tp = e[1]), tag = _this.tag;
		switch (e[0]) {
		case tag.sname:
			t[tag.sname] = tp;
			break;
		case tag.cname:
			t[tag.cname] = tp;
			break;
		case tag.qname:
			t[tag.qname] = tp;
			break;
		case tag.bname:
			t[tag.bname] = tp;
			break;
		case tag.sgname:
			t[tag.sgname] = tp;
			break;
		case tag.special:
			t[tag.special] = tp;
			break;
		case tag.kname:
			t[tag.kname] = tp;
			break;
		case tag.end:
			t[tag.end] = tp
		}
		return t
	};
this.myf_Init = function() {
	this.geci_object.innerHTML = this.mould, asc = this.geci_object = this.geci_object.firstChild, asc.style.width = this.width, asc.style.height = this.height, asc.style.textAlign = this.align, this.oneline ? (this.empty = 0, this.center = 5) : (this.empty = 5, this.center = this.geci_object.style.height / 2 | 80), this.isDropgeci && this.logon(!1)
}, this.setoccupy = function(e, t) {
	e.style.display = "block", this.setClassName(e, this.classV2), this.upTop(e), this.upkp && this.unoccupy(this.upkp), this.upkp = e, t && t(e)
}, this.unoccupy = function(e, t) {
	this.setClassName(e, this.classV1), this.oneline && (e.style.display = "none"), t && t(e)
}, this.torun = function(time) {
	if (!this.staue) {
		return !1
	}
	var time = this.toTimer(Math.round((time | event.srcElement.currentTime) * 100) / 100),
		line = eval("this.getgeciBy" + this.getgeci + "(time)");
	line && this.upkp != line && this.setoccupy(line)
}, this.logon = function(e) {
	if (window.FileReader) {
		var t = this.geci_object;
		e && (t = document.getElementById(e));

		function n(e) {
			e.stopPropagation(), e.preventDefault();
			var t = e.dataTransfer.files;
			for (var n = 0, r; r = t[n]; n++) {
				var i = new FileReader;
				i.onloadend = function(e) {
					return function(e) {
						img = e.target.result, img && _this.load(_this.Read(img))
					}
				}(r), i.readAsText(r)
			}
		}
		function r(e) {}
		function i(e) {}
		function s(e) {
			e.stopPropagation(), e.preventDefault()
		}
		t.addEventListener("dragenter", r, !1), t.addEventListener("dragover", s, !1), t.addEventListener("drop", n, !1), t.addEventListener("dragleave", i, !1), t.addEventListener("ondragend", i, !1)
	} else {
		alert("你的浏览器不支持啊，同学")
	}
};
var timer = null;
this.myf = function(e, t, n) {
	timer != null && clearTimeout(timer), this.isUpOrDown(e, t, n)
}, getUpValue = function(e, t) {
	return t - e > 100 ? e += 30 : t - e > 50 ? e += 10 : t - e > 20 ? e += 5 : t - e > 1 && e++, e
}, getDowmValue = function(e, t) {
	return e - t > 100 ? e -= 30 : e - t > 50 ? e -= 10 : e - t > 20 ? e -= 5 : e - t > 1 && e--, e
}, this.isUpOrDown = function(e, t, n) {
	t < n ? this.toUp(e, t, n) : this.toDown(e, t, n)
}, this.toUp = function(e, t, n) {
	timer = setInterval(function() {
		t >= n && (clearTimeout(timer), timer = null, e.scrollTop = n), e.scrollTop = t, t = getUpValue(t, n)
	}, 10)
}, this.toDown = function(e, t, n) {
	timer = setInterval(function() {
		t <= n && (clearTimeout(timer), timer = null, e.scrollTop = n), e.scrollTop = t, t = getDowmValue(t, n)
	}, 30)
}, this.destory = function() {}
}
geci = {
	msg: {
		ms1: "元素位置没有给出！ error : 103",
		ms2: "请给出歌词的链接地址，或文本内容！ error : 105"
	},
	tag: {
		sname: "ti",
		cname: "cl",
		qname: "cs",
		bname: "ps",
		sgname: "ar",
		special: "al",
		kname: "by",
		end: "end"
	},
	build: function(b, a) {
		var c = new lcz;
		return c.tag = geci.tag, b.object ? c.geci_object = document.getElementById(b.object) : alert(geci.msg.ms1), c.initTop = b["initTop"] != null ? b.initTop : 0, c.center = b["center"] != null ? b.center : 0, c.empty = b["empty"] != null ? b.empty : 0, c.isDropgeci = b["isDropgeci"] != null ? b.isDropgeci : !0, c.getgeci = b["seekMark"] != null ? b.seekMark : "Value", a && (c.classV1 = a["notoccupy"] != null ? a.notoccupy : "geci_moonlight", c.classV2 = a["occupy"] != null ? a.occupy : "geci_attention", c.width = a["width"] != null ? a.width : "550px", c.height = a["height"] != null ? a.height : "200px", c.align = a["align"] != null ? a.align : "center", c.oneline = a["oneline"] != null ? a.oneline : !1), c.myf_Init(), geci.readgeci(c, b.readType, {
			url: b.geciUrl ? b.geciUrl : null,
			text: b.geciText ? b.geciText : null
		}, function() {
			c.geci_object.scrollTop = c.initTop, c.oneline && (c.geci_object.className += " geci_hide"), b.syntony && b.syntony(c)
		}) && b.open && geci.open(c), b.media && (mp = document.getElementById(b.media), window.attachEvent ? mp.attachEvent("ontimeupdate", function() {
			c.torun()
		}) : mp.addEventListener("timeupdate", function() {
			c.torun()
		}, !1)), c
	},
	readgeci: function(d, b, f, c) {
		var a = "";
		if (f.text) {
			a = f.text
		} else {
			if (!f.url) {
				return alert(geci.msg.ms2), !1
			}
			xmlhttp = null, window.XMLHttpRequest ? xmlhttp = new XMLHttpRequest : window.ActiveXObject && (xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")), xmlhttp != null && (xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						return a = xmlhttp.responseText, a = a.replace(/<\/?.+?>/g, "").replace(/[\r\n]/g, ""), d.load(d.Read(a, b), c), !0
					}
					//alert("在获取url 歌词的时候发生了错误:" + xmlhttp.statusText)
					$('#lrc_2 ul').append('<li style="color: #69d2e7;">暂无歌词</li>');
				}
			}, xmlhttp.open("GET", f.url, !0), xmlhttp.send(null))
		}
		return d.load(d.Read(a, b), c), !0
	},
	open: function(a) {
		a.geci_object && (a.geci_object.style.display = "block"), a.staue = !0
	},
	close: function(a) {
		a.geci_object && (a.geci_object.style.display = "none"), a.staue = !1
	},
	suspend: function(a) {
		a.geci_object && (a.staue = !1)
	},
	destroy: function(a) {
		geci.close(a), a.remove(a.geci_object)
	},
	setProgress: function(b, a) {
		b.torun(a)
	}
};

(function($){
	if($('.music-search-json').length > 0){
		for (var i=0; i<playlist.length; i++){
			var items = playlist[i],
			item = items.list,
			c = i;c++;
			$('#poi-search-music-list').append('<div id="list-music-song"><div class="try-listen"><a href="javascript:;" id="try-listen-play"><i class="poifont goplay">&#xe60c;</i></a></div><div class="list-song-cover"><div class="list-music-cover"><span class="song-cd-cover" style="background-image:url('+ item.cover +');"></span><span class="song-cd-pan" style="background-image:url('+ item.cd +');"></span></div></div><ul class="list-song-info"><li class="list-song-info-title"><i class="poifont">&#xe600;</i> '+ item.title +' - '+ item.artist +'</li><li class="list-song-info-link"><i class="poifont">&#xe601;</i> '+ item.mp3 +'</li><li class="list-song-info-down"><i class="poifont">&#xe601;</i> '+ item.download +'</li><li class="list-song-info-mv"><i class="poifont">&#xe603;</i> MV功能正在施工...</li></ul></div>');
			$('#poi-playlist ul').append('<li>'+c+'.&nbsp;&nbsp;'+item.artist+' - '+item.title+'</li>');
		}
		$('#try-listen-play i').each(function(i){
			$(this).on('click', function(){
				switchTrack(i);
				if($(this).hasClass('goplay')){
					play();
					$('#try-listen-play i').html('&#xe60c;').eq(i).html('&#xe611;');
					$(this).html('&#xe611;').removeClass('goplay');
				}else{
					pause();
					$(this).html('&#xe60c;').addClass('goplay');
				}
			});
		});
	}else{
		//if($('.music-json').length > 0){
		for (var i=0; i<playlist.length; i++){
			var items = playlist[i],
			item = items.list,
			c = i;c++;
			$('#poi-playlist ul').append('<li>'+c+'.&nbsp;&nbsp;'+item.artist+' - '+item.title+'</li>');
		}
		//}
		var openbar = function(){
			var ok = (boxsearch) ? true : false;
			if(ok){
				if($("#poi-play-bar").hasClass('poi-c')){
					$("#poi-play-bar").removeClass('poi-c').addClass('poi-o').css({'width':'100%'});
					$("#open-poi-player i").html('&#xe607;');
				}
				if($("#poi-music-list").hasClass('poi-music-list-c')){
					$("#poi-music-list").removeClass('poi-music-list-c').addClass('poi-music-list-o');
				}		
			}
		}
		openbar();
	}

	$('body').append('<audio id="mp3" type="audio/mpeg">');
	
	var splay = (mshuffle) ? 'true' : 'false';
	var repeat = localStorage.repeat || 0,
		shuffle = localStorage.shuffle = splay,
		continous = true,
		autoplay = true;

	var time = new Date(),
		currentTrack = shuffle === 'true' ? time.getTime() % playlist.length : 0,
		trigger = false,
		audio=$('#mp3')[0], timeout, isPlaying, playCounts;

	var play = function(){
		audio.play();
		$('#poi-play-bar .poiplay i').html('&#xe60d;').addClass('inplay');
		$('.czui').removeClass('czui-c').addClass('czui-o');
		$('#poi-song-cover img').addClass('degs');
		timeout = setInterval(updateProgress, 500);
		isPlaying = true;
	}

	var pause = function(){
		audio.pause();
		$('#poi-play-bar .poiplay i').html('&#xe60c;').removeClass('inplay');
		$('.czui').removeClass('czui-o').addClass('czui-c');
		$('#poi-song-cover img').removeClass('degs');
		clearInterval(updateProgress);
		isPlaying = false;
	}

	// Progress
	var setProgress = function(value){
		var currentSec = parseInt(value%60) < 10 ? "0" + parseInt(value%60) : parseInt(value%60),
		ratio = value / audio.duration * 100;
		var alltime = audio.duration;
		var switchTime;
		if(!alltime){
			switchTime = '加载中...';
		}else{
			var minute = parseInt(alltime / 60);
			var second = parseInt(alltime % 60);
			minute = minute >= 10 ? minute : "0" + minute;
			second = second >= 10 ? second : "0" + second;
			switchTime = '0' + parseInt(value/60) + ':' + currentSec + '/' + minute + ':' + second;
		}
		$('#poi-play-bar .poi-progress .poi-pace').css('width', ratio + '%');
		//$('#poi-play-bar .poi-progress .poi-sider a').css('left', ratio + '%');
		$('#poi-play-bar .poi-timer').html(switchTime);
	}

	var beforeLoad = function(){
		var endVal = this.seekable && this.seekable.length ? this.seekable.end(0) : 0;
		$('#poi-play-bar .poi-progress .poi-loaded').css('width', (100 / (this.duration || 1) * endVal) +'%');
	}

	var updateProgress = function(){
		setProgress(audio.currentTime);
	}

	$('#poi-play-bar .poi-progress .poi-sider').slider({step: 0.1, slide: function(event, ui){
		$(this).addClass('enable');
		setProgress(audio.duration * ui.value / 100);
		clearInterval(timeout);
	}, stop: function(event, ui){
		audio.currentTime = audio.duration * ui.value / 100;
		$(this).removeClass('enable');
		timeout = setInterval(updateProgress, 500);
	}});

	// Volume
	var setVolume = function(value){
		audio.volume = localStorage.volume = value;
		$('#poi-play-bar .volume .pace').css('width', value * 100 + '%');
		$('#poi-play-bar .volume .slider a').css('left', value * 100 + '%');
	}

	var volume = localStorage.volume || 0.5;
	$('#poi-play-bar .volume .slider').slider({max: 1, min: 0, step: 0.01, value: volume, slide: function(event, ui){
		setVolume(ui.value);
		$(this).addClass('enable');
		$('#poi-play-bar .mute').removeClass('enable');
	}, stop: function(){
		$(this).removeClass('enable');
	}}).children('#poi-play-bar .pace').css('width', volume * 100 + '%');

	$('#poi-play-bar .mute').click(function(){
		if ($(this).hasClass('enable')){
			setVolume($(this).data('volume'));
			$(this).removeClass('enable');
			$(this).addClass('fa-volume-up').removeClass('fa-volume-off');
		} else {
			$(this).data('volume', audio.volume).addClass('enable');
			$(this).removeClass('fa-volume-up').addClass('fa-volume-off');;
			setVolume(0);
		}
	});

	// Cut song
	var switchTrack = function(i){
		if (i < 0){
			track = currentTrack = playlist.length - 1;
		} else if (i >= playlist.length){
			track = currentTrack = 0;
		} else {
			track = i;
		}

		//$('audio').remove();
		loadMusic(track);
		//play();
	}

	// Shuffle
	var shufflePlay = function(){
		var time = new Date(),
		lastTrack = currentTrack;
		currentTrack = time.getTime() % playlist.length;
		if (lastTrack == currentTrack) ++currentTrack;
		switchTrack(currentTrack);
	}

	// Ended
	var ended = function(){
		pause();
		audio.currentTime = 0;
		playCounts++;
		if (continous == true) isPlaying = true;
		// repeat： 1 单曲循环，2 列表循环，3 列表播放
		if (repeat == 1){
			play();
		} else {
			if (shuffle === 'true'){
				shufflePlay();
			} else {
				if (repeat == 2){
					switchTrack(++currentTrack);
				} else {
					if (currentTrack < playlist.length) switchTrack(++currentTrack);
				}
			}
		}
	}

	// Auto Play
	var afterLoad = function(){
		var ok = (mautoplay) ? true : false;
		if (autoplay == ok) {
			play();
		}
	}

	

	// Load Music
	var loadMusic = function(i){
		var items = playlist[i],
		item = items.list,
		newtags = (items.tags != undefined) ? ' ~ '+items.tags : '',
		newalbum = (items.album != undefined) ? items.album : '关于 “ '+items.search+' ” 共找到'+playlist.length+'首单曲';
		//newaudio = $('<audio id="mp3" src="'+item.mp3+'" type="audio/mpeg">').html('').appendTo('body');
		$('#poi-play-bar .poi-song-title').html('<span>'+item.title+'</span><span> - </span><span class="artist">'+item.artist+'</span>');
		$('#scripylrc p').html('<script>geci.build({object:"lrc_2",media:"mp3",geciUrl:"'+item.lrc+'",readType:"vls1",open:true},{oneline:false,height:"229px",width:"100%"});</script>');
		$('.poi-album-tiele').html(newalbum);
		$('.poi-album-tags').html(newtags);
		$('#poi-song-cover').html('<img src="'+item.cover+'">');
		$('#poi-music-list li').removeClass('playing').eq(i).addClass('playing');
		//$('#try-listen-play i').removeClass('fa-stop-circle').addClass('fa-play-circle').eq(i).addClass('fa-stop-circle'); //搜索试听
		$.getJSON(geturl+'get.php?id='+item.id, function(arr) {
			//console.log(arr.url);
			$('#mp3').attr('src',arr.url);
			if (isPlaying == true) play();
			audio.volume = $('#poi-play-bar .mute').hasClass('enable') ? 0 : 1;
			audio.addEventListener('progress', beforeLoad, false);
			audio.addEventListener('durationchange', beforeLoad, false);
			audio.addEventListener('canplay', afterLoad, false);
			audio.addEventListener('ended', ended, false);
		});
	}

	if($('.music-json').length > 0) loadMusic(currentTrack);

	$('#poi-play-bar .poiplay').on('click', function(){
		if ($('#poi-play-bar .poiplay i').hasClass('inplay')){
			pause();
		} else {
			play();
		}
	});
	$('#poi-play-bar .rewind').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(--currentTrack);
		}
	});
	$('#poi-play-bar .fastforward').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(++currentTrack);
		}
	});
	$('#poi-music-list li').each(function(i){
		var _i = i;
		$(this).on('click', function(){
			switchTrack(_i);
			play();
		});
	});

	if (shuffle === 'true') $('#poi-play-bar .shuffle').addClass('enable');
	
	if (repeat == 1){
		$('#poi-play-bar .repeat').addClass('once');
	} else if (repeat == 2){
		$('#poi-play-bar .repeat').addClass('all');
	}

	$('#poi-play-bar .repeat').on('click', function(){
		if ($(this).hasClass('once')){
			repeat = localStorage.repeat = 2;
			$(this).removeClass('once').addClass('all');
		} else if ($(this).hasClass('all')){
			repeat = localStorage.repeat = 0;
			$(this).removeClass('all');
		} else {
			repeat = localStorage.repeat = 1;
			$(this).addClass('once');
		}
	});
	$('#poi-play-bar .shuffle').on('click', function(){
		if ($(this).hasClass('enable')){
			shuffle = localStorage.shuffle = 'false';
			$(this).removeClass('enable');
		} else {
			shuffle = localStorage.shuffle = 'true';
			$(this).addClass('enable');
		}
	});
	$("#poi-play-bar .poi-open-list,.poi-list-close").on('click',function(){ // Play List
		if($("#poi-music-list").hasClass('poi-music-list-c')){
			$("#poi-music-list").removeClass('poi-music-list-c').addClass('poi-music-list-o');
		}else{
			$("#poi-music-list").removeClass('poi-music-list-o').addClass('poi-music-list-c');
		}
	});
	$("#open-poi-player").on('click',function(){ //Player Bar
		if($("#poi-music-list").hasClass('poi-music-list-o')){
			$("#poi-music-list").removeClass('poi-music-list-o').addClass('poi-music-list-c');
		}
		if($("#poi-play-bar").hasClass('poi-c')){
			$("#poi-play-bar").removeClass('poi-c').addClass('poi-o').css({'width':'100%'});
			$("#open-poi-player i").html('&#xe607;');
		}else{
			$("#poi-play-bar").removeClass('poi-o').addClass('poi-c').css({'width':'30px'});
			$("#open-poi-player i").html('&#xe608;');
		}	
	});

})(jQuery);