<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../../assets/includes/include_default_head.html"); ?>
    
    <title>Présentation 2FA</title>
    
    <!-- Reveal.js Core CSS -->
    <link rel="stylesheet" href="https://unpkg.com/reveal.js/dist/reveal.css">
    <link rel="stylesheet" href="https://unpkg.com/reveal.js/dist/theme/black.css">
    <link rel="stylesheet" href="./styles_presentation.css">
    <link rel="stylesheet" href="./styles_exemple_auth.css">
</head>
<body class="dark-mode">
    <div class="reveal">
        <div class="slides">
            <!-- Titre -->
            <section>
                <h1>Authentification à Double Facteur (2FA ou A2F)</h1>
            </section>

            <!-- Sommaire avec animation -->
            <section>
                <h2>Sommaire</h2>
                <ul>
                    <li class="fragment fade-in">🔍 Qu’est-ce que l’authentification à double facteur ?</li>
                    <li class="fragment fade-in">⚖️ Différences entre A2F et authentification simple </li>
                    <li class="fragment fade-in">🔐 Les différents types de A2F</li>
                    <li class="fragment fade-in">⚠️ Avantages et limites</li>
                    <li class="fragment fade-in">✅ Bonnes pratiques pour une utilisation efficace</li>
                    <li class="fragment fade-in">🎯 Conclusion</li>
                </ul>
            </section>

            <!-- I. Définition -->
            <section>
                <h2> Qu’est-ce que l’authentification à double facteur ? </h2>
                <p> Impose deux formes d'authentification pour accéder à son compte. </p>
                <p> Permet de mieux surveiller et protéger les informations. </p>
            </section>

            <!-- II. Comparaison -->
            <section>
                <h2>Différences entre authentification classique et l'A2F </h2>
                <p> Ajoute une seconde couche de connexion, en plus du mot de passe. </p>
            </section>
            
           <!-- Exemple d'auth classique -->
            <section class="auth-classique">
                <h3> Exemple d'authentification simple </h3>
                <?php
                if (isset($_POST['connexion1'])) {
                    
                    echo "
                    <br>
                    <p> Vous êtes connecté à votre compte et vous avez accès vos données. </p>
                    <br>
                    <form method='post' action='./#/5'>
                        <input type='submit' name='no-connect' value='Se déconnecter'>
                    </form>";
                } else {
                    echo '
                    <br>
                    <form method="post" action="">
                        <h4> Une seule étape : connexion </h4>
                        <p>Identifiant</p>
                        <input type="text" name="id" value="Votre Identifiant" required>
                        <p>Mot de passe</p>
                        <input type="text" name="password" value="Votre Mot de Passe" required>
                        <input type="submit" name="connexion1" value="Se connecter">
                    </form>
                    ';
                }
                ?>
            </section>
            
            <!-- Deuxième formulaire d'auth classique -->
            <section class="auth-classique">
                <h3> Exemple d'authentification à deux facteurs </h3>
                <?php
                if (isset($_POST['connexion2'])) {
                    echo '
                    <br>
                    <p> Vous êtes connecté à votre compte et vous avez accès vos données. </p>
                    <br>
                    <form method="post" action="./#/6">
                        <input type="submit" name="no-connect" value="Se déconnecter">
                    </form>';
                } else if (isset($_POST['a2f'])) {
                    echo '
                    <br>
                    <h4> Seconde étape : </h4>
                    <p> Un message contenant un code de vérification vous a été envoyé. </p>
                    <form method="post" action="">
                    <img src="./Tel.png"> </img>
                    <input type="text" name="a2f" value="58492317" required>
                    <input type="submit" name="connexion2" value="Vérifier">
                    </form>';
                } else {
                    echo '
                    <br>
                    <form method="post" action="">
                        <h4> Première étape : connexion </h4>
                        <p>Identifiant</p>
                        <input type="text" name="id" value="Votre Identifiant" required>
                        <p>Mot de passe</p>
                        <input type="text" name="password" value="Votre Mot de Passe" required>
                        <input type="submit" name="a2f" value="Se connecter">
                    </form>
                    ';
                }
                ?>
            </section>


            <!-- III. Types de 2FA -->
            <section>
                <h2>Les différents types de 2FA</h2>
                <ul>
                    <li class="fragment fade-in">📩 Code SMS ou Email</li>
                    <li class="fragment fade-in">📲 Applications d’authentification</li>
                    <li class="fragment fade-in">🔑 Clés de sécurité physiques</li>
                    <li class="fragment fade-in">🖐️ Biométrie</li>
                </ul>
            </section>

            <!-- IV. Avantages et limites -->
            <section>
                <h2>Avantages et limites</h2>
            </section>
            <section>
                <h3>Avantages</h3>
                <ul>
                    <li class="fragment fade-in">🔒 Sécurité renforcée : bloque l'accès non autorisé même si un mot de passe est compromis.</li>
                    <li class="fragment fade-in">🌍 Adoption large : supporté par de nombreux services.</li>
                    <li class="fragment fade-in">🔄 Diversité des méthodes : choix entre plusieurs options (SMS, application, clé physique, biométrie).</li>
                </ul>
            </section>
            <section>
                <h3>Limites</h3>
                <ul>
                    <li class="fragment fade-in">⚠️ Contraintes pour l’utilisateur : nécessite une étape supplémentaire.</li>
                    <li class="fragment fade-in">🛑 Risque de perte d’accès : si l’appareil de 2FA est perdu.</li>
                    <li class="fragment fade-in">🔓 Vulnérabilités selon la méthode : les SMS peuvent être interceptés, la biométrie a des défis de confidentialité.</li>
                </ul>
            </section>

            <!-- V. Bonnes pratiques -->
            <section>
                <h2>Bonnes pratiques pour une utilisation efficace</h2>
                <ul>
                    <li class="fragment fade-in">✅ Privilégier les applications d’authentification (ex. Google Authenticator, Authy) au lieu des SMS.</li>
                    <li class="fragment fade-in">🔑 Utiliser une clé physique pour les comptes sensibles.</li>
                    <li class="fragment fade-in">🔄 Configurer des options de récupération (codes de secours, contacts de confiance).</li>
                    <li class="fragment fade-in">🚫 Ne jamais partager son code 2FA, même si on vous le demande (au même titre que son MDP).</li>
                    <li class="fragment fade-in">📅 Mettre à jour régulièrement ses méthodes d’authentification.</li>
                </ul>
            </section>

            <!-- VI. Conclusion -->
            <section>
                <h2>Conclusion</h2>
                <p class="fragment fade-in">
                    L’A2F est une sécurité essentielle.
                </p>
                <p class="fragment fade-in">
                    Très efficace malgré certaines contraintes.
                </p>
                <p class="fragment fade-in">
                    L'utilisation du A2F est recommandée, accompagnée des bonnes pratiques.
                </p>
            </section>
        </div>
    </div>

    <!-- Scripts Reveal.js -->
    <script src="https://unpkg.com/reveal.js/dist/reveal.js"></script>
    <script>
        Reveal.initialize({
            transition: 'convex', // Animation plus fluide
            controls: true,
            progress: true,
            history: true,
            center: true,
            zoomKey: "ctrl"
        });
    </script>
</body>
</html>

