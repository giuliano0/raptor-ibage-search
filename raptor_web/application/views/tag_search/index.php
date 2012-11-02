<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Raptor Ibage Search!</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	html{
		width: 90%;
		margin: 0 auto;
	}

	body {
		background-color: #fff;
		margin: 40px auto;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		width: 100%;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px auto;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
		width: 100%;
	}

	div.ibages{
		width: 90%;
		margin: 0 auto;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to Raptor Ibage Search!</h1>

	<div id="body">
		<?php echo validation_errors(); ?>

		<?php echo form_open('tag_search/index') ?>

			<p align="center">
			<label for="tags">Digite a(s) tag(s) que deseja buscar separadas por espaço:</label> <br/>
			<input type="input" name="tags" /><br />

			<input type="submit" name="submit" value="Buscar" /> 
			</p>

		</form>
	</div>

	<?php if (isset($images)) { ?>
		<div class="ibages">
		<?php foreach ($images as $images_item): ?>
		    <!--<div class="main">-->
		    	<img class="thumb" src='<?php echo base_url('assets/images/part1/part1/'.$images_item['name'].''); ?>'  height="200"/>
		    <!--</div>-->	    
		<?php endforeach ?>
		<div>
	<?php } ?>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>



</body>
</html>