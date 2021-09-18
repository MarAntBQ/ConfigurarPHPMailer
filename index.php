<?php
session_start();
require_once "controllers/controllers.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/functions.js"></script>
    <title>Ejemplo de PHPMailer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
   <div class="promo" id="promo" onclick="closepromo()">
       <div class="promo-box" id="promobox">
           <div class="promo-top" onclick="closepromo()">
               <i class="fas fa-door-closed"></i>
           </div>
           <a href="https://sites.marbust.com" target="_blank"><img src="promo/promo.jpeg" alt="Promo para Dominio .xyz"></a>
       </div>
   </div>
    <div class="main-container">
        <h1>Ingrese sus Datos</h1>
        <?php
         Mailer::SendM();
        if (isset($_SESSION["MSGFM"])) {
            echo $_SESSION["MSGFM"];
        }
        unset($_SESSION["MSGFM"]);
        ?>
        <div class="form-container">
            <form method="post">
                <p>Nombre:</p>
                <input type="text" name="name" required placeholder="Ingrese su nombre" value="<?php if(isset($_SESSION["NAME"])){echo $_SESSION["NAME"];} ?>">
                <p>Email:</p>
                <input type="email" name="mail" required placeholder="Ingrese su email" value="<?php if(isset($_SESSION["EMAIL"])){echo $_SESSION["EMAIL"];} ?>">
                <p>Teléfono:</p>
                <input type="tel" name="phone" required maxlength="10" pattern="[0-9]{10}" placeholder="Ingrese su teléfono" value="<?php if(isset($_SESSION["PHONE"])){echo $_SESSION["PHONE"];} ?>">
                <p>Tipo de ayuda:</p>
                <select name="kind">
                    <option value="Normal">Normal</option>
                    <option value="Mediana">Mediana</option>
                    <option value="Avanzada">Avanzada</option>
                </select>
                <p>Mensaje:</p>
                <textarea name="message" required placeholder="Ingrese su mensaje"><?php if(isset($_SESSION["MESSAGE"])){echo $_SESSION["MESSAGE"];} ?></textarea>
                <button type="submit" class="btn-center">Enviar</button>
                <input type="hidden" name="faction">
            </form>
        </div>
        <p>&copy; 2020 Marbust Videos &amp; Entertainment&reg;</p>
    </div>
    <?php
    unset($_SESSION["NAME"]);
    unset($_SESSION["EMAIL"]);
    unset($_SESSION["PHONE"]);
    unset($_SESSION["MESSAGE"]);
    ?>

</body>

</html>
