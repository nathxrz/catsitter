<header class="header-content-login">
    <a href="login.php">
        <?php if(isset($showArrow) && $showArrow === true) {?>
            <img id='arrow-back-login' src="./images/icons/iconBack.svg" alt="Ícone de voltar.">
        <?php } ?>
    </a>
    <nav>
        <div class='menu-container'>
            <input type="checkbox" id='checkbox-menu'>

            <label for="checkbox-menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <ul id="menu">
            <li><a href="login.php">Home</a></li>
            <li><a href="">Serviços</a></li>
            <li><a href="">Contato</a></li>
        </ul>
    </nav>
</header>