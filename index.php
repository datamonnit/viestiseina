<?php
$page_title = 'Suuri viestiseinä';
$output = '<h2>Lisää viesti</h2>';

$form = '
<form id="viestiForm" action="javascript:chk()">
	<div class="form-group">
		<label for="nimi">Nimi</label>
		<input type="text" name="nimi" id="nimi" placeholder="Anna nimesi" class="form-control" />
	</div>
	<div class="form-group">
		<label for="viesti">Viesti</label>
		<textarea rows="5" id="viesti" name="viesti" class="form-control" max-length="255" placeholder="Kirjoita viesti tähän"></textarea>
	</div>
	<div class="form-group">
		<button id="btn-send" class="btn btn-primary btn-lg">Lähetä viesti</button>
	</div>
</form>
<div class="alert alert-info" role="alert">
  <strong>Viestejä moderoidaan!</strong> Viestin näkyminen seinällä voi kestää pienen hetken, sillä jokainen viesti tarkistetaan ennen julkaisua.
</div>';

$output .= $form;
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
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Lähetä viesti</a>
				</li>
				<li class="nav-item">
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
function chk(e){
	console.log("Lähetetään");
	$.ajax({
		type: "POST",
		url: "addMessage.php",
		data: $('#viestiForm').serialize(),
		statusCode: {
			404: function() {
				alert( "page not found" );
			}
		},
		success: function( data ) {
			if ( data !== 'ok' ) console.log('Ei onnistunut!');
			else console.log('Onnistui');
			window.open("wall.php","_self")
		}

	});
	// e.preventDefault();
	// return false;
// });
}

$(document).ready(function(){

/* Animaatio-koodi */
var animationDelay = 2500;

animateHeadline($('.cd-headline'));

function animateHeadline($headlines) {
	$headlines.each(function(){
		var headline = $(this);
		//trigger animation
		setTimeout(function(){ hideWord( headline.find('.is-visible') ) }, animationDelay);
		//other checks here ...
	});
}

function hideWord($word) {
	var nextWord = takeNext($word);
	switchWord($word, nextWord);
	setTimeout(function(){ hideWord(nextWord) }, animationDelay);
}

function takeNext($word) {
	return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
}

function switchWord($oldWord, $newWord) {
	$oldWord.removeClass('is-visible').addClass('is-hidden');
	$newWord.removeClass('is-hidden').addClass('is-visible');
}

});

</script>
</body>
</html>
