<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <a href="index.php"><h1 id="titreBlog">TeamHub</h1></a>
                <p>Bienvenue !</p>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div>
            <footer id="piedBlog">
                Site réalisé par Valentin Fortun et Romain Frayssinet
            </footer>
        </div>
    </body>
</html>