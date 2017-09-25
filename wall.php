<?php
// index.php
$page_title = 'Suuri viestiseinä';
$output = '<h2>Uusimmat viestit</h2>';

$output .= '
<div id="message-area">

</div><!-- #message-area -->
';



?>
<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/favicon.ico">

    <title>Datanomien Viestiseinä</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./css/custom.css" rel="stylesheet">

  </head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="./img/esedu_png_40y.png" alt="Esedu-logo" id="logo"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Lähetä viesti</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="wall.php">Seinä</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container kuplat">
		<div class="col-md-12">
			<?php echo $output; ?>
		</div>
	</div>

<script src="js/jquery-1.11.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

function showMessages(){
    $.post( "getMessages2.php", function( data ) {
        $( "#message-area" ).html( data );
    });
}


$( document ).ready(function() {

	showMessages();

	setInterval( function(){
		showMessages();
		//alert('hep');
	}, 1000 );

});

</script>

</body>
</html>
