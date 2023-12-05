<header class="header-content">
    <nav>
        <div class='menu-container'>
            <input type="checkbox" id='checkbox-menu'>

            <label for="checkbox-menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <ul id="menu" class="menu-content">
            <?php
                if(isset($_SESSION["cod_catsitter"]) and !isset($_SESSION["adm"])){ ?>
                <li><a href="sitter_schedule_page.php">Agenda</a></li>
                <li><a href="sitter_profile_page.php">Perfil</a></li>
            <?php } ?>

            <?php 
                if(!isset($_SESSION["cod_catsitter"]) and !isset($_SESSION["adm"])){ ?>
                    <li><a href="tutor_home_page.php">Home</a></li>
                    <li><a href="tutor_schedule_page.php">Agenda</a></li>
                    <li><a href="pet_page.php">Pets</a></li>
                    <li><a href="tutor_profile_page.php">Perfil</a></li>
            <?php } ?>

            <?php 
                if(isset($_SESSION["adm"])){ ?>
                <li><a href="adm_home_page.php">Home</a></li>
                <li><a href="adm_profile_page.php">Perfil</a></li>
            <?php } ?>
                <!-- <li><button id='theme-btn'>Tema</button></li> -->
        </ul>
    </nav>
</header>