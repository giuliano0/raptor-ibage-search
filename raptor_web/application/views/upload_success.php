<html>
<head>
<title>Upload Form</title>
</head>
<body>

	<h3>Your file was successfully uploaded!</h3>

	<ul>
		<?php foreach ($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?>
		</li>
		<?php endforeach; ?>
	</ul>

	<ul>
	
		<pre> 
		<?php //TODO: remove and redirect to start page instead of this
			print_r($resultado);?>
		</pre>
		
	</ul>
	
	
	<p>
		<?php echo anchor('', 'Back to Home Page!'); ?>
	</p>

</body>
</html>
