<?php

    date_default_timezone_set('Europe/Madrid');                                 // Establece la zona horaria.

    $nameErr = $surnameErr = $bookErr = $emailErr = $dateErr = $dniErr = "";    // Variables para mostrar errores  
  

    if(isset($_GET['send'])){

        //Validación nombre
        if(isset($_GET['name'])){
            $name = $_GET['name'];

            if( empty ( $name )){
                
                $nameErr = "Introducir nombre válido";

            } else {

                $name = test_input($_GET['name']);
            }
        }

        //Validación apellidos
        if(isset($_GET['surname'])){
            $surname = $_GET['surname'];

            if( empty ($surname)){

                $surnameErr = "Introducir apellido válido";

            } else {
                $surname = test_input($_GET['surname']);
            }
        }

        //Validacion libro
        if(isset($_GET['book'])){
            $book = $_GET['book'];

            if( empty($book)){

                $bookErr = "Introducir libro alquilar";

            } else {
                $book = test_input($_GET['book']);
            }
        }

        //Validación email
        if(isset($_GET['email'])){
            $email = $_GET['email'];

            if(empty($_GET['email']) || strpos($email, "@") === false){
                $emailErr = "Introduzca con un email válido";
            } else {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                   echo "<p class='valid'>Mail Correcto.</p>";
                }
            }
        }

        //Fecha de alquiler
        if(isset($_GET['date'])){
            $date = $_GET['date'];

            if(empty($_GET['date'])){
                $dateErr = "Introduzca una fecha";

            } else {
                $validatedDate = explode('-', date($date), 1);
                $year = $validatedDate[0];
                $mm = $validatedDate[1];
                $dd = $validatedDate[2];
                
                echo "{$yy}";
                echo "{$mm}";
                echo "{$dd}";
            }
        }
        

        //Validación dni
        if(isset($_GET['dni'])){
            $dni = $_GET['dni'];
    
            if( !empty( $dni) ){
    
                validatedDni( $dni );
    
            } else {
    
                $dniErr = "Introducir DNI válido";
            }
    
        }

    }

    /* **Funciones**  */

    //  función para validar textos
    function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    // función para validar dni.
    function validatedDni( $dni ){
        
        $separatedDni = explode( '-', $dni );
        $numbers = $separatedDni[0];
        $letter = strtoupper( $separatedDni[1] );
        $correctLetter = substr("TRWAGMYFPDXBNJZQVHLCKE", $numbers%23, 1);
    
        if( $correctLetter == $letter && strlen($numbers) == 8 && strlen($letter) == 1 ){
            $dniErr ="<p>DNI: {$dni} correcto. </p>";
    
        } else {
            //echo "<p>DNI: {$dni} incorrecto. </p>";
            echo "<p>DNI correcto: {$numbers}-{$correctLetter}</p>";
            
        }
    }

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TareaA01-02 - Biblioteca</title>
</head>
<body>
    <header>
        <h2>Tarea Aprendizaje01-02 | Biblioteca</h2>
    </header>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
            <div class="elem-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" placeholder="John" required>
                <span class="error"> <?php echo $nameErr;?></span>
            </div>
            <div class="elem-group">
                <label for="surname">Apellidos</label>
                <input type="text" name="surname" id="surname" placeholder="Doe" required>
                <span class="error"> <?php echo $surnameErr;?></span>
            </div>
            <div class="elem-group">
                <label for="book">Libro</label>
                <input type="text" name="book" id="book" placeholder="Libro" required>
                <span class="error"> <?php echo $bookErr;?></span>
            </div>
            <div class="elem-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@email.com">
                <span class="error"> <?php echo $emailErr;?></span>
            </div>
            <div class="elem-group">
                <label for="date">Fecha Alquiler</label>
                <input type="date" name="date" id="date">
                <span class="error"> <?php echo $dateErr;?></span>
            </div>
            <div class="elem-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" placeholder="55555555-X">
                <span class="error"> <?php echo $dniErr;?></span>
            </div>
            <button type="submit" name="send">Enviar</button>
        </form>
    </main>
</body>
</html>