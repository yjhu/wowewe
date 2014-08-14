<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fixed Toolbars - jQuery Mobile Framework</title>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
$(document).on("mobileinit", function() {
	//alert(1);
	//$.mobile.popup.prototype.options.overlayTheme = "b";
	//$.mobile.page.prototype.options.keepNative = 'button';
});
</script>


<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>

<script>
$(document).on('pagecreate', '#page2', function(event) {
     alert('1');
});
</script>

</head>
<body>
	<div data-role="page" id="page2" class="jqm-demos" data-quicklinks="true">

	    <div data-role="header" data-position="fixed">
			<a href="../toolbar/" data-rel="back" class="ui-btn ui-btn-left ui-alt-icon ui-nodisc-icon ui-corner-all ui-btn-icon-notext ui-icon-carat-l">Back</a>

	        <h1>Staff score</h1>
			<a data-rel="back" href="#">返回</a>
	    </div>

	    <div role="main" class="ui-content">

	    	<h1>You score is:</h1>
			<p>In browsers that support CSS <code>position: fixed</code> (most desktop browsers, iOS5+, Android 2.2+, and others), toolbars that use the "fixedtoolbar" plugin will be fixed to the top or bottom of the viewport, while the page content scrolls freely in between. In browsers that don't support fixed positioning, the toolbars will remain positioned in flow, at the top or bottom of the page. </p>

			<form>

			<div class="ui-field-contain">
				<input data-clear-btn="true" name="textinput-1" id="textinput-1" placeholder="Mobile number" value="" type="text">
			</div>

			<div class="ui-field-contain">
				<select name="select-native-1" id="select-native-1" data-native-menu="false">
					<option>Choose office...</option>
					<option value="1">The 1st Option</option>
					<option value="2">The 2nd Option</option>
					<option value="3">The 3rd Option</option>
					<option value="4">The 4th Option</option>
				</select>
			</div>

			<div class="ui-field-contain">
				<button type="submit" id="submit-1" class="ui-shadow ui-btn ui-corner-all">Save</button>
			</div>

			</form>

	    </div>

	    <div data-role="footer" data-position="fixed">
	    	<h1>Fixed footer</h1>
	    </div>

	</div>

</body>
</html>




<!--
	<link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.3.min.css">
	<link rel="stylesheet" href="../_assets/css/jqm-demos.css">
	<script src="../js/jquery.js"></script>
	<script src="../_assets/js/index.js"></script>
	<script src="../js/jquery.mobile-1.4.3.min.js"></script>
	<script src="http://libs.baidu.com/jquery/2.0.3/jquery.min.js"></script>


	<label for="textinput-1" class="ui-hidden-accessible">Text Input:</label>
	<label for="select-native-1" class="ui-hidden-accessible">Basic:</label>
	<label for="submit-1" class="ui-hidden-accessible">Save</label>

-->

