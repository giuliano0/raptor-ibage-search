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
			float:left;
		}

		div.ibages{
			width: 90%;
			margin: 0 auto;
		}

		div.divthumb{
			margin: 25px;
			float: left;
		}

		div.divfooter{
			float:left;
			width: 100%;
		}
</style>
</head>
<body>

 	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	
	<script type="text/javascript">
		
   function formChange(newOption) {

	   htmlStr = null;
		if (newOption !== 2){
			$("#s1tag").attr("checked", "checked");
			$("#search_form_images").hide();
			$("#search_form_tags").show();
		}
		else{
			$("#s2image").attr("checked", "checked");
			$("#search_form_tags").hide();
			$("#search_form_images").show();
		}
	    
   }
	</script>

<div id="container">
	<h1>Welcome to Raptor Ibage Search!</h1>

	<div id="body">
		
		<?php echo validation_errors(); ?>

		<?php echo anchor('', 'Busca');?>
		&nbsp;&nbsp;
		<?php echo anchor('upload', 'Inserir Imagem');?>
		
			<div id="search_form_tags" >
				<?php echo form_open('tag_search/index') ?>
				<p align="center">
				<label for="tags">Digite a(s) tag(s) que deseja buscar separadas por espaço:</label> <br/>
				<input type="text" name="tags" /><br />
				Busca por : &nbsp;&nbsp;
				<input id="s1tag" type="radio" name="type" value="tags" checked="checked" onchange="formChange(1)" /> Tags &nbsp;&nbsp;&nbsp;&nbsp;
				<input id="s1image" type="radio" name="type" value="image" onchange="formChange(2)"/> Imagem <br/>
				<input type="submit" name="submit" value="Buscar por Tag" />
				</p>
				</form>
			</div>
			<div id="search_form_images" style="display:none" >
				<?php echo form_open_multipart('image_search/index') ?>
				<p align="center">
				<label for="tags">Submeta a imagem pela qual deseja fazer uma busca por similaridade:</label> <br/>
				<input type="file" name="userfile" /><br />
				Busca por : &nbsp;&nbsp;
				<input id="s2tag" type="radio" name="type" value="tags" onchange="formChange(1)" /> Tags &nbsp;&nbsp;&nbsp;&nbsp;
				<input id="s2image" type="radio" name="type" value="image" checked="checked" onchange="formChange(2)"/> Imagem <br/>
				<input type="submit" name="submit" value="Buscar por Imagem" />
				</p>
				</form>
			</div>
<!-- 			<br/><br/><br/><br/> -->
<!-- 			<div id="upload_image" > -->
				<?php echo form_open_multipart('upload/do_upload') ?>
<!-- 				<p align="center"> -->
<!-- 				<label for="tags">Submeta uma imagem nova:</label> <br/> -->
<!-- 				<input type="file" name="userfile" /><br /> -->
<!-- 				Nome da Imagem: <input type="text" name="imageName" /><br /> -->
<!-- 				Descricao: <input type="text" name="description" /><br /> -->
<!-- 				Album URL: <input type="text" name="albumUrl" /><br /> -->
<!-- 				Image URL: <input type="text" name="imageUrl" /><br /> -->
<!-- 				<input type="submit" name="submit" value="Enviar" /> -->
<!-- 				</p> -->
<!-- 				</form> -->
<!-- 			</div> -->
	</div>

	<?php if (isset($images)) { ?>
		<div class="ibages">
		<?php foreach ($images as $images_item): ?>
		    <div class="divthumb">
		    	<a target="_blank" href='<?php echo base_url('assets/images/part1/part1/'.$images_item['name'].''); ?>'>
		    	<img class="thumb" src='<?php echo base_url('assets/images/part1/part1/'.$images_item['name'].''); ?>'  height="150"/>
		    	</a>
		    </div>    
		<?php endforeach ?>
		</div>
	<?php } ?>

	<div class="divfooter">
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div
</div>



</body>
</html>