<?php
session_start();
require_once __DIR__ . '/dbcon.php';
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <?php require_once __DIR__ . '/header.php'; ?>
    <title>Ansicht</title>
</head>

<body class="bg-dark text-white meinbody">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 p-3 mb-2 text-center">
                <div>
                    <header>
                        <span>
                            <h1 class="meinh1">Datensatz Detailansicht <img src="img/logo.png" id="logo" /></h1>
                        </span>
                    </header>
                    <hr />
                </div>
                <div class="card bg-muted text-xl-start">
                    <div class="card-header text-black">
                        <h4>Eintrag Detailansicht
                            <a href="database.php" class="btn btn-danger float-end" title="zurück" >Zurück</a>
                        </h4>
                    </div>
                    <div class="card-body text-black">
                        <?php
                        if (isset($_GET['id'])) {
                            $eintrag_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM contactlist WHERE id='$eintrag_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $eintrag = mysqli_fetch_array($query_run);
                        ?>
                                <div class="mb-3">
                                    <label>Name</label>
                                    <p class="form-control"><?= $eintrag['name']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Vorname</label>
                                    <p class="form-control"><?= $eintrag['vorname']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>PLZ</label>
                                    <p class="form-control"><?= $eintrag['plz']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Telefon</label>
                                    <p class="form-control"><?= $eintrag['telefon']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <p class="form-control"><?= $eintrag['name']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Betreff</label>
                                    <p class="form-control"><?= $eintrag['betreff']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Text</label>
                                    <textarea class="form-control" cols="100" rows="6" maxlength="500"><?= $eintrag['text']; ?></textarea>
                                </div>
                        <?php
                            } else {
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