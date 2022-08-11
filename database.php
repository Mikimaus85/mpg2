<?php
session_start();
require_once __DIR__ . '/dbcon.php';
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <?php include('header.php'); ?>
    <title>Auflistung</title>
</head>

<body class="bg-dark text-white meinbody">
    <div class="container">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-sm-10 offset-sm-1 p-3 mb-2">
                <div class="text-center">
                    <header>
                        <div>
                            <h1 class="text-xl-center meinh1">Auflistung der Kontakte <img src="img/logo.png" id="logo" /></h1>
                        </div>
                        <nav class="navbar navbar-dark bg-dark text-white meinnavtext">
                            <a class="navbar-brand navbar-text-bold" href="index.php">Kontaktformular</a>
                            <button class="navbar-toggler align-items-lg-end bg-white" type="button" title="Züruck zum Formular!" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbartext" aria-expanded="false" aria-label="Toggle navigation"></button>
                        </nav>
                    </header>
                </div>
                <hr />
                <p>
                    <span>
                        <a class="btn btn-light btn-sm text-xl-center" title="Öffnen Sie!" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                            <i class="bi bi-card-list"></i> Liste öffnen...</a>
                    </span>
                </p>
                <div class="col-xl-12">
                    <div class="card-header">
                        <h4>Wünschen Sie einen neuen Eintrag dann bitte rechts klicken!
                            <a href="index.php" class="btn btn-secondary btn-sm float-end">Neuer Eintrag</a>
                        </h4>
                        <form action="code.php" method="POST">
                            <input type="text" name="search" placeholder="Begriff" title="Geben Sie was ein!" id="suchbegriff" /> 
                            <button class="btn btn-light btn-sm float-left" type="submit" name="submit-search">Suchen</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive meintable">
                        <table class="text-left table table-dark table-xm table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Vorname</th>
                                    <th>Postleitzahl</th>
                                    <th>Telefon</th>
                                    <th>Email</th>
                                    <th>Betreff</th>
                                    <th>Text</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tbody class="collapse multi-collapse" id="multiCollapseExample1">
                                <?php
                                
                                if (isset($_SESSION['search'])){
                                    $result = $_SESSION['search'];
                                } else {
                                    $query = "SELECT * FROM contactlist";
                                    $query_run = mysqli_query($con, $query);
                                    $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                                }
                                foreach ($result as $eintrag) {
                                ?>
                                <tr> 
                                    <td><?= htmlentities($eintrag["id"]); ?></td>
                                    <td><?= htmlentities($eintrag["name"]); ?></td>
                                    <td><?= htmlentities($eintrag["vorname"]); ?></td>
                                    <td><?= htmlentities($eintrag["plz"]); ?></td>
                                    <td><?= htmlentities($eintrag["telefon"]); ?></td>
                                    <td><?= htmlentities($eintrag["email"]); ?></td>
                                    <td><?= htmlentities($eintrag["betreff"]); ?></td>
                                    <td><?= htmlentities($eintrag["text"]); ?></td>
                                        <td>
                                        <div class="d-grid gap-2">
                                            <a href="eintrag-view.php?id=<?= $eintrag['id']; ?>" class="btn btn-light btn-sm float-end" title="Ansicht" style="margin-bottom: 5px;">Ansicht</a>
                                            <a href="eintrag-edit.php?id=<?= $eintrag['id']; ?>" class="btn btn-success btn-sm float-end" title="Änderung" style="margin-bottom: 5px;">Ändern</a>
                                            <form action="code.php" name="myFormTwo" method="POST" class="d-inline">
                                                 <button type="submit" name="delete_eintrag" value="<?= $eintrag['id']; ?>" class="btn btn-danger btn-sm float-end" title="Löschen" onclick="return confirm('Soll der Datensatz wirklich gelöscht werden?');">Löschen</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr />
                    <div class="col-12 text-xl-center">
                        <?php include('footer.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>