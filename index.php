<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Baixe seu certificado</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="">
	</head>
	<body>
		<div class="container">
			<img src="inc/header.jpg" width="100%" />
			<div class="w-100 p-3">
				<form action="inc/render.php" method="post">
					<div class="form-group">
						<label>Insira seu nome igual está escrito em seu crachá</label>
						<input type="text" name="nome" class="form-control" placeholder="Seu nome">
					</div>
					<button type="submit" class="btn btn-success">Gerar Certificado</button>
				</form>
			</div>
		</div>
	</body>
</html>