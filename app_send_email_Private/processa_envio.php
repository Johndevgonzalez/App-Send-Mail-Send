<?php

	//https://packagist.org/packages/phpmailer/phpmailer
	//https://github.com/PHPMailer/PHPMailer/tree/6.0
	//http://localhost/app_send_mail/processa_envio.php
	//https://stackoverflow.com/questions/3477766/phpmailer-smtp-error-could-not-connect-to-smtp-host
	/* FOI TRANSFERIDO PARA FORA DA PASTA DO PROJETO
	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php"; //tem o protocolo de recebimento de emai
	require "./bibliotecas/PHPMailer/SMTP.php"; // tem o protocolo das especificadoes do envio de email.
	*/
	// usando os namespace da biblioteca
	use PHPMailer\PHPMailer\PHPMailer;
	//use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


	//print_r($_POST);

	class Mensagem {
		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => '');

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

		public function mensagemValida() {
			//validar pra ver se esta preenchido
			if(empty($this->para) || empty($this->assunto) || empty($this->mensagem) ) {
				return false;
			}

			return true; //para mensagem valida
		}
	}

	$mensagem = new Mensagem();

	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);

	//print_r($mensagem);
	//negando o retorno
	if(!$mensagem->mensagemValida()) {
		echo 'mensagem não é valida, precisa preencher todos os campos!';
		//die(); //mata o processamento quando é lida / funcao nativa do php
		header('Location: index.php');
	} 

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug =  false;    //2 para ver os logs    //SMTP::DEBUG_SERVER                // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com'; //'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'SMTP username';          // SMTP username
	    $mail->Password   = 'SMTP password';                         // SMTP password
	    $mail->SMTPSecure = 'tls';     //tls  // PHPMailer::ENCRYPTION_STARTTLS ** Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    $mail->SMTPOptions = array(
    	'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
   			)
		);

	    //Recipients
	    $mail->setFrom('seu email', 'joao dev remetente');
	    $mail->addAddress($mensagem->__get('para'));     // Add a recipient
	    //$mail->addReplyTo('info@example.com', 'Information'); //contato padrao caso o destinatario responsa para o remetente
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    // Attachments //anexos para os emails
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content (conteudo)
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $mensagem->__get('assunto'); //assunto do email
	    $mail->Body    = $mensagem->__get('mensagem');
	    $mail->AltBody = 'É necessario utilizar um client que suporte HTML para ter acesso ao conteudo total dessa mensagem';

	    $mail->send();
	    $mensagem->status['codigo_status'] = 1;
	    $mensagem->status['descricao_status'] = 'Email enviado com sucesso!';
	    

	} catch (Exception $e) {
		$mensagem->status['codigo_status'] = 2;
	    $mensagem->status['descricao_status'] = "Não foi possivel enviar este email. Detalhes do erro"  . $mail->ErrorInfo;
	}
?>


<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<!-- inclusao do css -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

		<div class="container">
			<!-- vpíando a div da imagem-->
			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

			<div class="row">
				<div class="col-md-12">
					
					<? if($mensagem->status['codigo_status'] == 1) { ?>

						<div class="container">
							<h1 class="display-4 text-success">Sucesso</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<? } ?>

					<? if($mensagem->status['codigo_status'] == 2) { ?>

						<div class="container">
							<h1 class="display-4 text-danger">Ops!</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>

						</div>
					<? } ?>

				</div>
			</div>
		</div>

	</body>
</html>