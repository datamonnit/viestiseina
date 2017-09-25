<?php

include 'db.php';

$output = '
<table class="table table-striped">
	<tr>
		<th>Lähettäjä</th>
		<th>Aikaleima</th>
		<th>Viesti</th>
		<th id="kissa">Toimenpide</th>
	</tr>';

// Haetaan viestit tietokannasta
foreach ($dbConn->query("SELECT id, nimi, viesti, DATE_FORMAT(aika, '%T %d.%m.%y') as aika, ok FROM viestit ORDER BY aika DESC") as $viesti) {
	$output .= '<tr>
					<td>' . $viesti['nimi'] . '</td>
					<td>' . $viesti['aika'] . '</td>
					<td>' . $viesti['viesti'] . '</td>

					<td>
						<div class="btn-group" role="group">
						<button class="btn btn-danger btn-lg poista" id="' . $viesti['id'] . '" data-viesti-id="' . $viesti['id'] . '">Poista</button>';
		if ( $viesti['ok'] == 0 ) {


			$output	.=		'<button class="btn btn-primary btn-lg julkaise" id="' . $viesti['id'] . '" data-viesti-id="' . $viesti['id'] . '">Näytä</button></div>';
		} else {
			$output .=		'<button class="btn btn-warning btn-lg piilota" id="' . $viesti['id'] . '" data-viesti-id="' . $viesti['id'] . '">Piilota</button></div>';
		}

		$output .= '
					</td>

				</tr>';
}
$output .= '</table>';

echo $output;
