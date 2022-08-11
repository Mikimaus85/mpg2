<?php
    session_start();
    require_once __DIR__ . '/dbcon.php';

    if(isset($_POST['delete_eintrag'])){
        $eintrag_id = mysqli_real_escape_string($con, $_POST['delete_eintrag']);
        $query = "DELETE FROM contactlist WHERE id='$eintrag_id' ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Eintrag wurde erfolgreich gelöscht!";
            header("Location: database.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Eintrag wurde nicht gelöscht!";
            header("Location: database.php");
            exit(0);
        }
    }

    if(isset($_POST['update_eintrag'])){
        $eintrag_id = mysqli_real_escape_string($con, $_POST['eintrag_id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $vorname = mysqli_real_escape_string($con, $_POST['vorname']);
        $plz = mysqli_real_escape_string($con, $_POST['plz']);
        $telefon = mysqli_real_escape_string($con, $_POST['telefon']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $betreff = mysqli_real_escape_string($con, $_POST['betreff']);
        $text = mysqli_real_escape_string($con, $_POST['text']);

        $query = "UPDATE contactlist SET name='$name', vorname='$vorname', plz='$plz', telefon='$telefon', email='$email', betreff='$betreff', text='$text' WHERE id='$eintrag_id' ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Ändern des Eintrags erfolgreich übernommen!";
            header("Location: database.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Änderung war nicht erfolgreich!";
            header("Location: database.php");
            exit(0);
        }
    }

    if(isset($_POST['save_eintrag'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $vorname = mysqli_real_escape_string($con, $_POST['vorname']);
        $plz = mysqli_real_escape_string($con, $_POST['plz']);
        $telefon = mysqli_real_escape_string($con, $_POST['telefon']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $betreff = mysqli_real_escape_string($con, $_POST['betreff']);
        $text = mysqli_real_escape_string($con, $_POST['text']);

        $query = "INSERT INTO contactlist (name, vorname, plz, telefon, email, betreff, text) VALUES ('$name', '$vorname', '$plz', '$telefon', '$email', '$betreff', '$text')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Eintrag erfolgreich übernommen!";
            unset($_SESSION['search']);
            header("Location: database.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Eintrag war nicht erfolgreich!";
            header("Location: index.php");
            exit(0);  
        }
    }

    if (isset($_POST['search'])) {
        $search = mysqli_real_escape_string($con, $_POST['search']);
        $query = "SELECT * FROM contactlist WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR plz LIKE '%$search%'";
        $query_run = mysqli_query($con, $query);
        
        if ($query_run) {
            $_SESSION['message'] = "Eintrag gefunden!";
            $_SESSION['search'] = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            header("Location: database.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Keinen Eintrag gefunden!";
            header("Location: database.php");
            exit(0);
        }
    }else{
        unset($_SESSION['search']);
    }
?>