<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#allmap{width:100%;height:500px;}
		p{margin-left:5px; font-size:14px;}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=D9eeee9766ab40088b1f88caccc0770c"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js"></script>
	<title>点聚合</title>
</head>
<body>
	<div id="allmap"></div>
	<p>缩放地图，查看点聚合效果</p>
</body>
</html>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");
//	map.centerAndZoom(new BMap.Point(116.404, 39.915), 4);
	map.centerAndZoom(new BMap.Point(112.142918,32.046162), 14);
	map.enableScrollWheelZoom();

	var MAX = 10;
	var markers = [];

	var pt = null;
/*
	var i = 0;
	for (; i < MAX; i++) {
	   pt = new BMap.Point(Math.random() * 40 + 85, Math.random() * 30 + 21);
	   markers.push(new BMap.Marker(pt));
	}
	//最简单的用法，生成一个marker数组，然后调用markerClusterer类即可。
*/
	pt = new BMap.Point(112.152918,32.056162);
    markers.push(new BMap.Marker(pt));

	pt = new BMap.Point(112.142928,32.046262);
    markers.push(new BMap.Marker(pt));

	pt = new BMap.Point(112.142818,32.046462);
    markers.push(new BMap.Marker(pt));

	pt = new BMap.Point(112.142718,32.047362);
    markers.push(new BMap.Marker(pt));

	var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers});


	var markers1 = [];
	pt = new BMap.Point(112.142718,32.037362);
    markers1.push(new BMap.Marker(pt));

	var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers1});

</script>