<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css" >
		<script type="text/javascript" src="../scripts/jquery.js"></script>
		<link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
		<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>

		<script>
		$(document).ready(function()
		{
			    $(".source .item").draggable({ 
					revert: "invalid", 
					appendTo: 'body', 
					helper: "clone",
					start: function(ev, ui){ 
						ui.helper.width($(this).width()); 
					}                    // ensure helper width
				});

				$(".target .empty").droppable({ 
					tolerance: 'pointer', 
					hoverClass: 'highlight',
					drop: function(ev, ui){
						var item = ui.draggable;
						item.find('input').attr('name', this.id );
						var jour = $(this).find('input').val();
						item.find('input').attr('value', jour);
						if (!ui.draggable.closest('.empty').length) item = item.clone().draggable();// if item was dragged from the source list - clone it
						this.innerHTML = '';                                                        // clean the placeholder
						item.css({ top: 0, left: 0 }).appendTo(this);                                // append item to placeholder
						
					}
					
				});
				
		});
		</script>
				<title> Organiser ses indisponibilités </title>

	</head>	
	
	<body>
		<?php include("../include/header.php"); ?>
		
		<div id="bodycentered">
				<div class="source">
				
					
						<div class="item">
							<input type="hidden" name="" value="false">
							<img src="../css/design/blackbox.jpg" alt="indisponibilité" >  
						</div>
				
				</div>
				
			<form action="post_indispo.php" method="post" enctype="multipart/form-data">
			<?php 
			
			$date = strtotime($_POST['date']);//  ici ta date
			
				?>

				<div class="target">
					<?php 
						$i = 0;
						
						while($i < 7) {
					?>
							<div id="AM[<?php echo $i;?>]" class="empty">
								<input type="hidden" value="<?php echo $date; ?>"> 
							</div>
					<?php		
							$i++;
							$date = strtotime('+1 day', $date);
						}
					?>
				</div>
				
				<div class="target">
					<?php
						$date = strtotime($_POST['date']);//  ici ta date

						$i=0;
						while($i < 7) {
					?>		
							<div id="PM[<?php echo $i;?>]" class="empty">
								<input type="hidden" value="<?php echo $date; ?>"> 
							</div>
					<?php
							$i++;
							$date = strtotime('+1 day', $date);
						}
					?>	
				</div>
				<input type="submit" value="Valider">
			</form>
		</div>
		
	</body>
</html>	