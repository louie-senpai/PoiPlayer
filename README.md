# PoiPlayer
WordPress Plugins

又一款WordPress网易云外链音乐播放器插件<br>
集成了音乐搜索功能，支持随机播放，进度条拖拉，支持Pjax或ajax站点全站播放。

最新版本：2.0.4<br>
更新摘要：<br>
- 2017-06-10<br>
修复MP3链接失效问题。<br>
移除音乐搜索功能。<br>
鸣谢：https://github.com/metowolf/Meting <br>

- 2016-12-12<br>
支持SSL，不怕丢失小绿锁了。<br>
替换图标库，体积缩小90%。<br>
修复部分主题样式问题。<br>

- 2016-12-03<br>
增加支持自定义移动端隐藏/显示播放器。<br>
禁止移动端自动播放。<br>

- 2016-11-01<br>
去除歌词Debug弹窗。<br>
添加自定义歌曲搜索量。<br>
添加自定义显示/隐藏音乐搜索框。<br>
修复Pjax(Ajax)环境下搜索音乐刷新页面后跳回上一页的问题。 

## 使用方法

### 歌单

<code>歌单：http://music.163.com/#/playlist?id=469469926 （数字即为歌单ID）</code>

<code>专辑：http://music.163.com/#/album?id=2857009 （数字即为专辑ID）</code>

后台设置界面填写歌单或专辑<code>ID</code>获取数据，请保证歌单或专辑内歌曲不为空。

### 外链工具

新建页面添加短代码<code>[PoiMusic]</code>

### 注意事项

搜索功能需要主机开启fsockopen()函数，否则无法读取数据，另外可能存在主机IP被墙而无法播放歌曲的问题，大多出现在海外IP的站点。
