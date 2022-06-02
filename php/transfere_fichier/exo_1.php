<?php
$title = "Envoi d'images sur le serveur Web";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <link type="image/x-icon" rel="shortcut icon" href="images/toulibre_icon.png" />
    <link rel="stylesheet" media="screen" href="css/style.css" />
    <title><?php echo $title; ?></title>
</head>

<body id="main_body">
    <header>
        <h1><?php echo $title; ?></h1>
    </header>
    <?php if (empty($_POST) || empty($_FILES)) { ?>
        <!-- génération du formulaire -->
        <section id="main">
            <h2>Page destinée à envoyer des fichiers</h2>
            <form action="#" method="post" enctype="multipart/form-data" id="upload">

                <ul>
                    <li>
                        <label for="file" class="description">Envoyer le(s) fichier(s)</label>
                        <div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                            <!-- indique la taille max du fichier-->
                            <input type="file" name="files[]" id="file" multiple="multiple" title="Le fichier à envoyer doit être une image de taille maximale 300 Mo" />
                        </div>
                    </li>

                    <li>
                        <input type="submit" name="submit" value="Envoyer" />
                    </li>
                </ul>
            </form>
        </section>
    <?php } else {
        // analyse des valeurs transmises
        $dest_dir = 'upload';
        print_r($_FILES);
        exit;
        // Répertoire de destination qui doit etre capable d'écrire

        foreach (array_keys($_FILES['files']['name']) as $i) {
            if (!empty($_FILES['files']['name'][$i])) {
                $new_name = basename($_FILES['files']['name'][$i]);
                $new_location = $dest_dir . '/' . md5(mt_rand() . time()) . '_' . $new_name;
                if (isset($_FILES['files']['error'][$i]) && UPLOAD_ERR_OK === $_FILES['files']['error'][$i]) {
                    // détection d'érreur
                    if (@move_uploaded_file($_FILES['files']['tmp_name'][$i], $new_location)) {
                        printf("<h2>transfert de <samp>%s</samp> réalisé</h2>\n", $new_name);
                        printf("<p>le lien suivant <a href=\"%s\">%s</a> donne accès au fichier transféré</p>\n", $new_location, $new_location);
                    } else {
                        $message = sprintf(
                            "Une erreur interne est survenue lors de la récupération du fichier <samp>%s</samp> (<em>%s</em>).<br/>\n" .
                                "<p>message : <code>%s</code><br/>\n",
                            $_FILES['files']['tmp_name'][$i],
                            $new_name,
                            join("<br/>\n", error_get_last())
                        );
                    }
                } else {
                    $message = 'Une erreur interne a empêché l\'upload de l\'image : ' . $_FILES['files']['error'][$i];
                }
            } else {
                $message = 'Veuillez passer par le formulaire svp !';
            }
        }
        if (isset($message)) {
            echo "<h2>$message</h2>\n";
        }
    } ?>
</body>

</html>