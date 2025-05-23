<?php 
include("./utils/ini_session.php"); 
include("./utils/db_access.php");
include("./utils/add_card_cheese.php");
include("./utils/user_home.php");
?>
<head>
    <!-- Config / styles -->
    <title> CheeseCards - Home </title>
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_common_pages.css">
    <?php include("./utils/common_head.php"); ?>
</head>

<body data-aos="fade-in" class="cheese">
    
    <!-- Header -->
    <?php include("./parts/header_home.php"); ?>
    
    <!-- Contenu -->
	<section id="home-container">
	    <div>
	    <?php include("./parts/nav_user_infos.php"); ?>
    	<?php include("./parts/nav_options.php"); ?>
    	<nav>
    	    <h2> Infos </h2>
    	    <p>
    	        Une grande MAJ arrivera en <b class="special">début juin</b>, le site et les BDD seront totalement modifiés. Vos informations seront toutes transférées, <b class="special">vous ne perderez rien</b>. 
    	        Des nouvelles fonctionnalités seront apportées (<b class="special">jeux, échange de cartes, responsive du syle, messages, forum et publications...</b>)
    	    </p>
    	</nav>
	    </div>
        <main>
            <div>
                <h1> Vos cartes </h1>
                <section class="content-home">
                <?php include("./utils/show_cheeses_home.php"); ?>
                </section>
            </div>
        </main>
    </section>
    
    <!-- Scripts -->
    <script src="./public/script_options.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init(); </script>
    
</body>