<?php
// index.php

session_start();
include 'autentikoi.php';

if ( autentikoiBasic() === false ) {
	header("refresh:2;url=tietovisa.php");
	die("<h1 style=\"color: red;\">Pääsy evätty! Mene pois!</h1>");
}


$page_title = 'Viestiseinän hallinta';
$output = '';


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

	<div class="container">
		<div class="page-header">
			<h1><?php echo ( isset($page_title) ) ? $page_title : 'Sivun title' ; ?></h1>
		</div>
		<div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Olet ylläpitotilassa. Sulje selainikkuna, kun lopetat!
		</div>
		<div id="content" class="col-md-12">
			<?php echo $output; ?>
		</div>

	</div>



	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>



	<script>

function showAdminMessages(){
	$.post( "getAdminMessages.php", function( data ) {
		$( "#message-area" ).html( data );
                //alert('Tsekattiin viestit!');
	});
}

$( document ).ready( function(){
	$(".alert").hide();

	// Käydään hakemassa viestit kannasta
	showAdminMessages();

	// Asetetaan sivu hakemaan viestit n sekunnin välein
  setInterval( function(){
		showAdminMessages();

	}, 5000 );

	//setInterval( showAdminMessages(), 1000 );

	$("#content").on("click", ".poista", function() {
            var id = $(this).data('viesti-id');
            $.ajax({
                    type: "POST",
                    url: 'delMessage.php',
                    data: { id : $(this).data('viesti-id')},
                    success: function( data ){

                        if ( data !== 'ok' ) alert( data );
			else {
                            $(".alert").html('Viesti ' + id + ' poistettiin onnistuneesti!').show().fadeOut(5000);
                            showAdminMessages();
                        }
                    },
                    statusCode: {
                        404: function() {
                                alert( "page not found" );
                        }
                    },
                    dataType: 'html'

            });
	}).on("click", ".julkaise", function(){
            var id = $(this).data('viesti-id');
            $.ajax({
                type: "GET",
                url: "publishMessage.php",
                data: { id : id },
                dataType: "html",
                success: function( data ) {
                    showAdminMessages();
                    $(".alert").html('Viesti ' + id + ' julkaistiin onnistuneesti!').show().fadeOut(5000);
                },
                statusCode: {
                        404: function() {
                                alert( "page not found" );
                        }
                    }
            });
        }).on("click", ".piilota", function(){
            var id = $(this).data('viesti-id');
            $.ajax({
                type: "GET",
                url: "unpublishMessage.php",
                data: { id : id },
                dataType: "html",
                success: function( data ) {
                    showAdminMessages();
                    $(".alert").html('Viesti ' + id + ' piilotettiin onnistuneesti!').show().fadeOut(5000);
                },
                statusCode: {
                        404: function() {
                                alert( "page not found" );
                        }
                    }
            });
        });



});

</script>

</body>
</html>
