


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tinkièt'</title>
	<link rel="stylesheet" href="assets/style_accueil.css">
	<link rel="shortcut icon" href="Image/logo.png"/>
	<script defer src="script/accueil.js"></script>
</head>
<body>

	<header>

	<?php include 'header.php'; ?>

    </header>
	
	<section class="conteneur">
		<div class="case1">
			<div class="fond">
				<label>Capture ton stage sans stress, en ne laissant pas les offres prendre la fuite</label>
			</div>
			<div class="cercle"><img src="Image/tiplouf_montre.png"></div>
			<button><span>Démarre</span><span class="label_recherche">Ta capture</span></button>
			<div>
				<div class="carre" id="rotated-div1"></div>
				<div class="carre" id="rotated-div2"></div>
				<div class="carre" id="rotated-div3"></div>
				<div class="carre" id="rotated-div4"></div>
				<div class="carre" id="rotated-div5"></div>
				<div class="carre" id="rotated-div6"></div>
				<div class="carre" id="rotated-div7"></div>
				<div class="carre" id="rotated-div8"></div>
			</div>
			
		</div>

		<div class="case2">
			<div class="fond">
				<label>Renseigne toi sur des entreprises pour tes lettres de motivation ou ton entretien</label>
			</div>
			<button id="boutonRedirection"><span>Débute</span><span class="label_recherche">Tes renseignements</span></button>
			<div>
				<div class="carre" id="rotated-div1.1"></div>
				<div class="carre" id="rotated-div2.1"></div>
				<div class="carre" id="rotated-div3.1"></div>
				<div class="carre" id="rotated-div4.1"></div>
				<div class="carre" id="rotated-div5.1"></div>
				<div class="carre" id="rotated-div6.1"></div>
				<div class="carre" id="rotated-div7.1"></div>
				<div class="carre" id="rotated-div8.1"></div>
			</div>
		</div>

	</section>

	<?php include "footer.php"; ?>

</body>
</html>