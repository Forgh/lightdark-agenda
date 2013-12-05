<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css" >
		<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				browser_spellcheck : true,
				language : 'fr_FR',
				height : 500,
				relative_urls: false,
				convert_urls: false,
			    remove_script_host: false,
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			});

		</script>
		
		
		<title> Agenda - Editer un compte-rendu</title>
	</head>
	
	<body>
		<?php include("include/header.php"); ?>
		<div id="bodycentered" >
			<h1>Editer un compte-rendu</h1>

			<form action="compte_rendu.php" method="post" enctype="multipart/form-data">
				<textarea name="compte_rendu">
					<?php include('controleurs/afficher_compte_rendu'); ?>
				</textarea>
					<input type="hidden" name="reunion" value="<?php echo $_POST['reunion']; ?>" >
				<p>
					<input type="submit" value="Valider" >
				</p>
	
			</form>
		</div>
		
	</body>
</html>

