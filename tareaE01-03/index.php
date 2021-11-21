<?php 
    date_default_timezone_set('Europe/Madrid');

    $activityErr = $timeErr = NULL;
    $activity = $time = NULL;
    $appointment = array();
   
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $activity = $_POST['activity'];
        $time = $_POST['time'];

        foreach ($appointment as $activity => $time) {    
            
            //Añadir al array
            if(!isset($activity) and (!empty($time))){
                $appointment[$activity] = $time;
            }
        
            //Modificar el array
            if(isset($activity) and !$time){
                $appointment[$activity] = $time;
            }
            
            //Borrar del array
            if(isset($activity) and ($time == NULL)){
                unset($appointment[$activity]);
            }
        
            //Visualización error
            if(empty($activity)){
                $activityErr = "Actividad es requerida"; 
            }
        }
        
        //Visualización agenda
        if (count($appointment) > 0){
            echo "<ul>";
            foreach( $appointment as $activity => $time )
            echo "<li>" .$activity. " : " . $time."</li>";
            echo "</ul>";
        }

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TareaA01-03 - Agenda</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header></header>
    <main>
        <h2>Agenda</h2>
       
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="elem-group">
                <label for="activity">Actividad</label>
                <input type="text" name="activity" id="activity" value="<?php if (isset($activity)) echo $activity; ?> required>
                <span class="error"> <?php echo $activityErr; ?></span>
            </div>
            <div class="elem-group">
                <label for="time">Hora</label>
                <input type="time" name="time" id="time" value="<?php if (isset($time)) echo $time; ?> required>
                <span class="error"> <?php echo $timeErr; ?></span>
            </div>
            <button type="submit" name="submit">Crear Actividad</button>
        </form>

    </main>
    <footer></footer>
</body>
</html>