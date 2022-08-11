<?php
    session_start();
    require_once __DIR__ . '/dbcon.php';
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php require_once __DIR__ . '/header.php'; ?>
	    <title>Änderung</title>
    </head>
    <body class="bg-dark text-white meinbody">
        <div class="container">
            <?php include('message.php'); ?>
            <div class="row">
                <div class="col-sm-10 offset-sm-1 p-3 mb-2">
				    <div class="text-xl-center">
					    <header>
						<span>
							<h1 class="meinh1">Ändern des Datensatzes <img src="img/logo.png" id="logo" /></h1>
						</span>
					    </header>
					    <hr />
				    </div>
                    <div class="card bg-muted text-xl">
                        <div class="card-header text-black">
                            <h4>Eintrag Ändern
                                <a href="database.php" class="btn btn-danger float-end" title="zurück" >Zurück</a>
                            </h4>
                        </div>
                        <div class="card-body text-black">
                            <?php
                                if(isset($_GET['id'])){
                                    $eintrag_id = mysqli_real_escape_string($con, $_GET['id']);
                                    $query = "SELECT * FROM contactlist WHERE id='$eintrag_id' ";
                                    $query_run = mysqli_query($con, $query);
                                
                                    if(mysqli_num_rows($query_run) > 0){
                                        $eintrag = mysqli_fetch_array($query_run);
                                    ?>
                                    <div class="row text-left">
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="eintrag_id" value="<?= htmlentities($eintrag['id']); ?>" />
                                            <div class="mb-3">
                                                <label>Name</label>
                                                <input class="form-control" type="text" name="name" value="<?= htmlentities($eintrag['name']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                 <label>Vorname</label>
                                                <input class="form-control" type="text" name="vorname" value="<?= htmlentities($eintrag['vorname']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label>PLZ</label>
                                                <input class="form-control" type="text" name="plz" value="<?= htmlentities($eintrag['plz']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label>Telefon</label>
                                                <input class="form-control" type="text" name="telefon" value="<?= htmlentities($eintrag['telefon']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="email" value="<?= htmlentities($eintrag['email']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label>Betreff</label>
                                                <input class="form-control" type="text" name="betreff" value="<?= htmlentities($eintrag['betreff']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label>Text</label>
                                                <textarea class="form-control" cols="100" rows="6" maxlength="500" type="text" name="text" value="<?= htmlentities($eintrag['text']); ?>"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" name="update_eintrag" class="btn btn-primary" title="Ändern" id="aendern">Eintrag ändern</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    }else{
                                        echo "<h4>Keinen Eintrag mit dieser ID gefunden</h4>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <hr />
                    <div class="text-xl-center">
                        <?php require_once __DIR__ . '/footer.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once __DIR__ . '/after-footer.php'; ?>
    </body>
</html>