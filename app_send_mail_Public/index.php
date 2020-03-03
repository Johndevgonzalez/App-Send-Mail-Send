<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<!-- inclusao do css -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>
		<!-- classes do bootstrap -->
		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<!-- inclusao de formularios e inclusao do ACTION  e POST-->
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="para">Para</label>
								<!-- incluindo NAMES para os input-->
								<input name="para" type="text" class="form-control" id="para" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<!-- incluindo NAMES para os input-->
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assunto do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<!-- incluindo NAMES para os input-->
								<textarea name="mensagem" class="form-control" id="mensagem"></textarea>
							</div>

							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>