<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/style.css" >
		<script type="text/javascript" src="../scripts/jquery.js"></script>
		<link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
		<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>
		<title>Votre Agenda</title>
	</head>
	
	<body>
	<?php include("../include/header.php"); ?>
		<div id="bodycentered">
		<h2>Votre agenda des 7 prochains jours</h2>
			<table id="agenda">
				<tr id="jours">
					<td></td>
					<?php 
						foreach($jours as $value){
								echo '<td>'.$value.'</td>';
						}
					?>
				</tr>
				<tr id="matinees">
				<td><p>Matin</p></td>
				<?php
					foreach($matin as $value){
						?>
							<td><?php if(!empty($value)){?>
										<p>
											<?php echo $value->getSujet(); ?>
										</p>
										<p>
											Salle : <?php echo $value->getSalle(); ?>
										</p>
										<p>
											Chef : <?php echo $value->getChefReunion(); ?>
										</p>
										<?php
										}
										?>
							</td>
						<?php
					}
				?>
				</tr>
				<tr id="apresmidi">
				<td><p>Après-midi</p></td>
					<?php
						foreach($apresmidi as $value){
							?>
								<td><?php if(!empty($value)){?>
									<p>
										<?php echo $value->getSujet(); ?>
									</p>
									<p>
										Salle : <?php echo $value->getSalle(); ?>
									</p>
									<p>
										Chef de réunion : <?php echo $value->getChefReunion(); ?>
									</p>
										<?php
										}
										?>
								</td>
							<?php
						}
					?>
				</tr>
				
			</table>
		</div>
	</body>

</html>