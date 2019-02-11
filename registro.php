<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
<style>
body {
        background-image: url("aula.jpg");
} 
 
</style>
	<?php
		include './database.php';
		// Crear novo registro (resposta a GET)
		if ( isset($_REQUEST['crear']) ) {
			$insertar = "INSERT INTO Registro (id_habito, dia, valor) VALUES (" . $_REQUEST['crear'] . ",'" . $_REQUEST['data'] . "',1);";
			$result = mysqli_query($conn, $insertar);
		}
		$lectura = "SELECT * FROM Habitos ORDER BY Nombre;";
		$habitos = mysqli_query($conn, $lectura);
		$leregistro = "SELECT * FROM Registro INNER JOIN Habitos ON Registro.id_habito = Habitos.ID WHERE Registro.dia >= CURDATE() - INTERVAL 4 DAY ORDER BY Habitos.Nombre, Registro.dia;";
		$valores = mysqli_query($conn, $leregistro);
	?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Seguimiento</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		  <li class="nav-item">
		   <a class="nav-link" href="Home.php">Indice</a>
		  </li>
		  <li class="nav-item ">
		    <a class="nav-link" href="habitos.php">Hábitos</a>
		  </li>
		  <li class="nav-item active">
		    <a class="nav-link" href="registro.php">Registro</a>
		  </li>
 			<li class="nav-item">
		    <a class="nav-link" href="usuario.php">Usuario</a>
		  </li>
		</ul>
	  </div>
	</nav>
	<table class="table">
		<tr>
			<td></td>
			<?php
				$hoxe = mktime(0,0,0);
				$datas = [];
				for ($dias=4;$dias>=0;$dias--) {
					echo "<td>" . date('j/n/Y', $hoxe-$dias*24*60*60) . "</td>";
					$datas[] = date('Y-m-d', $hoxe-$dias*24*60*60);
				}
			?>
		</tr>
		<?php
			$valor = mysqli_fetch_array($valores);
			while ($hab = mysqli_fetch_array($habitos)) {
				echo "<tr><td>" . $hab['Nombre'] . "</td>";
				if ($valor['ID'] != $hab['ID']) {
					foreach ($datas as $data) {
						echo "<td><a href=\"registro.php?crear=" . $hab['ID'] . "&data=" . $data . "\"><button type=\"button\" class=\"btn btn-light\"><i class=\"far fa-circle\"></i></button></a></td>";
					}
				} else {
					foreach ($datas as $data) {
						if (($valor['dia'] == $data) and ($valor['ID'] == $hab['ID'])) {
							if ($valor['valor'] == 0) {
								echo "<td><i class=\"fas fa-times-circle\"></i></td>";
							} else {
								echo "<td><i class=\"fas fa-check-circle\"></i></td>";
							}
							$valor = mysqli_fetch_array($valores);
						} else {
							echo "<td><a href=\"registro.php?crear=" . $hab['ID'] . "&data=" . $data . "\"><button type=\"button\" class=\"btn btn-light\"><i class=\"far fa-circle\"></i></button></a></td>";
						}
					}
				}
				echo "</tr>";
			}
		?>
	</table>

<div style="text-align:center;padding:1em 0;"> <h2><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/city/3105976"><span style="color:gray;">Hora actual en</span><br />Vigo, España</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=large&timezone=Europe%2FMadrid" width="100%" height="140" frameborder="0" seamless></iframe> </div>
</body>
</html>
