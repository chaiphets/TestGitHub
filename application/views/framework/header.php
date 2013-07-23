<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title><?=$title?></title>

<!-- Modernizr -->
<script src="<?=base_url('extlib/js/libs/modernizr-2.6.2.min.js')?>"></script>
<!-- jQuery -->
<script type="text/javascript" src="<?=base_url('extlib/js/libs/jquery-1.9.1.min.js')?>"></script>
<!-- framework css -->
<link type="text/css" rel="stylesheet" href="<?=base_url('extlib/css/groundwork.css')?>">
<!--[if IE]>
    <link type="text/css" rel="stylesheet" href="<?=base_url('extlib/css/groundwork-ie.css')?>"><![endif]-->
<!--[if lt IE 9]>
    <script type="text/javascript" src="<?=base_url('extlib/js/libs/html5shiv.min.js')?>"></script><![endif]-->
<script type="text/javascript">
      // extend Modernizr to have datauri test
      (function(){
        var datauri = new Image();
        datauri.onerror = function() {
          Modernizr.addTest('datauri', function () { return false; });
        };
        datauri.onload = function() {
          Modernizr.addTest('datauri', function () { return (datauri.width == 1 && datauri.height == 1); });
          Modernizr.load({
            test: Modernizr.datauri,
            nope: '<?=base_url('extlib/css/no-datauri.css')?>'
          });
        };
        datauri.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
      })();
      // SVG support?
      Modernizr.load({
        test: Modernizr.inlinesvg,
        yep: [
          '<?=base_url('extlib/css/social-icons-svg.css')?>'
        ],
        nope: [
          '<?=base_url('extlib/css/social-icons-png.css')?>'
        ]
      });
      // polyfill for HTML5 placeholders
      Modernizr.load({
        test: Modernizr.input.placeholder,
        nope: [
          '<?=base_url('extlib/css/placeholder_polyfill.min.css')?>',
          '<?=base_url('extlib/js/libs/placeholder_polyfill.jquery.js')?>'
        ]
      });
      
    </script>

<style type="text/css">
html {
	overflow-y: scroll;
}
.hide{
	display: none;
}
</style>
</head>
<body>
	<?php
		if (isset ( $hmsg )) {
			foreach ( $hmsg as $msg ) {
				echo '<p class="' . $msg ['type'] . ' message gapped headermsg" style="display: none;">' . $msg ['message'] . '</p>';
			}
			echo '<button class="small warning gap-left gap-top icon-exclamation-sign" id="btn_hmsg" style="display: none;"></button>';
		}
	?>