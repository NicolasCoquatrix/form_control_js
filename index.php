<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'authentication';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName", $user, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
    exit;
}

session_start();

?>

<!doctype html>
<html lang="FR">
    <head>
        <title>Controle formulaire JavaScript</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <header>
        </header>
        
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <p class="alert <?php if(!empty($_SESSION['name'])){echo 'alert-success';} else {echo 'alert-light';} ?> text-center" id="formAlert"><?php if(!empty($_SESSION['name'])){echo 'Inscription de \'' . $_SESSION['name'] . '\' réalisé avec succés.';} else {echo 'Merci de remplir ce formulaire d\'inscription.';} ?></p>
                        <div class="card">
                            <div class="card-header">
                                <h1 class="mb-0 text-center">Inscription</h1>
                            </div>
                            <form action="add_user.php" method="POST" id="form" name="form">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Nom</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Confirmez votre mot de passe" required>
                                        <p id="lastnameHelp" class="px-2 form-text text-secondary">Le nom doit comporter entre 2 et 50 caractères.</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Confirmez votre mot de passe"  required>
                                        <p id="firstnameHelp" class="px-2 form-text text-secondary">Le prénom doit comporter entre 2 et 50 caractères.</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email"  required>
                                        <p id="emailHelp" class="px-2 form-text text-secondary">L'adresse mail doit être unique.</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password1" class="form-label">Mot de passe</label>
                                        <div class="input-group mb-2">
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="Entrez votre mot de passe"  required>
                                            <span class="input-group-text">
                                                <i id="password1Visibility" class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirmez votre mot de passe"  required>
                                            <span class="input-group-text">
                                                <i id="password2Visibility" class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        <p id="passwordHelp" class="px-2 form-text text-secondary">Le mot de passe doit contenir au minimum, une minuscule, une majuscule, un chiffre et un caractère spécial (#,?,!,@,$,%,^,&,*,-) et comporter entre 8 et 40 caractères.</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="hidden_submit"  required>
                                    <button type="submit" class="btn btn-primary w-100" name="form_submit" id="formSubmit">S'inscrire</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="form_control.js"></script>
    </body>
</html>

<?php unset($_SESSION['name']); ?>