<?php

    $destinatario = 'aprendelotumismoahorasoporte@gmail.com';

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];  

    $contenido = "Nombre:\t" . $nombre . "\nEmail:\t" . $email . "\nTeléfono:\t" . $phone . "\nMensaje:\t". $message;

    mail($destinatario,"Contacto", $contenido);
 
    header("Location:/index.php");
    
?>