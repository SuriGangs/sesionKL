<?php 
include("con_db.php");
if (isset($_POST['register'])) {
	if (strlen($_POST['name']) >= 1 && strlen($_POST['email']) >= 1) {
		$name = trim($_POST['name']);
		$apellidos = trim($_POST['apellidos']);
		$email = trim($_POST['email']);
		$fechareg = date("d/m/y");

		$caracteres = '823ANBXCF';
		for($x = 0; $x < 1; $x++){
			$codigo = substr(str_shuffle($caracteres), 0, 6);
		}

		$liga=utf8_encode('https://knowlearn.org/index.php/register/');

		$consulta = "INSERT INTO datos(codigo, nombre, apellidos, email, fecha_reg) VALUES ('$codigo', '$name', '$apellidos', '$email', '$fechareg')";
		$resultado = mysqli_query($conex,$consulta);
		if ($resultado) {
			?> 
			<h3 class="ok">¡Te has inscrito correctamente!</h3>
			<?php
			require_once("PHPMailer-5.2.11/PHPMailerAutoload.php");

			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->CharSet = 'UTF-8';
			$mail->SMTPDebug = 0;
			$mail->Host = 'smtp.office365.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;

			$mail->Username = "scarrasco@coregroupsolutions.com";
			$mail->Password = "DreamNoise*27";
			$mail->setFrom('scarrasco@coregroupsolutions.com', 'Registro a Knowlearn');
			$mail->addAddress($email, $name, $apellidos);
			$mail->Subject = 'Código para Laboratorio de Habilidades Digitales '.$name." ".$apellidos;
			$mail->Body = 'BIENVENID@ ' .$name." ".$apellidos."\n\n"
			.'Ingresa a la siguiente liga '.$liga." "."\n\n"
			.'Regístrate e ingresa el código a continuación para acceder a más cursos y seguir capacitándote.  ';
		} else {
			?> 
			<h3 class="bad">¡Ups ha ocurrido un error!</h3>
			<?php
		}
	}   else {
		?> 
		<h3 class="bad">¡Por favor complete los campos!</h3>
		<?php
	}
}
?>