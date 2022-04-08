<?php
require_once "config.php";
 
$nev = $email = $uzenet = "";
$nev_err = $email_err = $uzenet_err = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if (empty(trim($_POST["nev"]))){
        $nev_err = "Kérlek írd be a neved!";     
    } else {
        $nev = trim($_POST["nev"]);
    }
	
	if (empty(trim($_POST["email"]))){
        $email_err = "Kérlek írd be az e-mail címed!";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Hibás e-mail formátum!";
      } else {
        $email = trim($_POST["email"]);
    }
    
    if (empty(trim($_POST["uzenet"]))){
        $uzenet_err = "Kérlek töltsd ki az üzenetet!";     
    } else {
        $uzenet = trim($_POST["uzenet"]);
    }
    
    if (empty($nev_err) && empty($email_err) && empty($uzenet_err)){
        
        $sql = "INSERT INTO teszt_forms (nev, email, uzenet) VALUES (?, ?, ?)";
         
        if ($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sss", $param_nev, $param_email, $param_uzenet);
            
            $param_nev = $nev;
			$param_email = $email;
            $param_uzenet = $uzenet;
            
            if ($stmt->execute()){
                header("location: success.php");
            } else {
                echo "Valami nem sikertült. Kérlek próbáld újra később.";
            }

            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
	<title>Kapcsolat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="bg-contact2" style="background-image: url('images/bg-01.jpg');">
		<div class="container-contact2">
			<div class="wrap-contact2">
				<form class="contact2-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="contact2-form-title">
						Kapcsolatfelvétel
					</span>
					<div class="error">
					<a><?php echo $nev_err; ?></a></br>
					</div>
					<div class="wrap-input2" >
						<input class="input2" type="text" name="nev" <?php echo (!empty($nev_error)) ? 'is-invalid' : ''; ?> value="<?php echo $nev; ?>" >
						<span class="focus-input2" data-placeholder="Neved"></span>
					</div>
					<div class="error">
					<a><?php echo $email_err; ?></a>
					</div>
					<div class="wrap-input2">
						<input class="input2" type="text" name="email" <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?> value="<?php echo $email; ?>">
						<span class="focus-input2" data-placeholder="E-mail címed"></span>
					</div>
					<div class="error">
					<a><?php echo $uzenet_err; ?></a></br>
					</div>
					<div class="wrap-input2">
						<textarea class="input2" name="uzenet" <?php echo (!empty($uzenet_err)) ? 'is-invalid' : ''; ?> value="<?php echo $uzenet; ?>"></textarea>
						<span class="focus-input2" data-placeholder="Üzenet szövege"></span>
					</div>
					<div class="container-contact2-form-btn">
						<div class="wrap-contact2-form-btn">
							<div class="contact2-form-bgbtn"></div>
							<button class="contact2-form-btn">
								Küldés
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/main.js"></script>
</body>
</html>
