<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css" >
		<link rel="stylesheet" href="css/css-drag.css" >
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
		<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>

		<script>
		$(document).ready(function()
		{
			$("#zone_indispo").sortable(
				{
					connectWith: '.connectedList',
				    receive: function (event, ui) {
								var element = ui.item.find('input');
								element.attr('value','');
								//change name on element here
							} 
				});
					
					
				}
				$("#AM").sortable(
				{
					connectWith: '.connectedList',
					forcePlaceholderSize:true,
				    receive: function (event, ui) {
								var number = ui.id;
								var element = ui.item.find('input');
								element.attr('value',number);
								//change name on element here
							} 
				});
				
				$("#PM").sortable(
				{
					connectWith: '.connectedList',
					forcePlaceholderSize:true,
				    receive: function (event, ui) {
								var number = ui.id;
								var element = ui.item.find('input');
								element.attr('value',number);
								//change name on element here
							} 
				});
				/*$('#zone_indispo').droppable(
				{
					activeClass: "ui-state-hover",
					hoverClass: "ui-state-active",
						drop: function (event, ui) {
							$(this).addClass("ui-state-highlight" );
							var element = ui.item.find('input');
							element.attr('name','');
							//Vide le name au drop
						} 
				});*/
			});
		});
		</script>
		
			</head>

	<body>
  
		<?php include("include/header.php"); ?>
		
		
		<div id="bodycentered">
		
		<div >
				<ul id="zone_indispo">
					<?php
						for($i=0; $i < 14; $i++){
					?>
					
						<li>
							<input name="indispo[]" type="hidden" value=""><img src="css/design/blackbox.jpg" alt="indisponibilité"/>  
						</li>
					<?php
						}
					?>
				</ul>
		</div>	
				<ul id="AM" class="connectecList">
				<?php 
					$i = 0;
					
					while($i < 13) {
				?>
						<li id="<?php echo $i; ?>">
							
						</li>
				<?php		
						$i+=2;
					}
				?>
				</ul>
				<ul id="PM" class="connectecList">
				<?php
					$i=1;
					while($i < 14) {
				?>		
						<li id="<?php echo $i; ?>">
							
						</li>
				<?php
						$i+=2;
					}
				?>	
				</ul>
			</table>
		</div>
	</body>
</html>	