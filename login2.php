<?php
include 'includes/head.php';
?>
    <body>
        <?php
            //include 'includes/valida.php';

            echo "<h2>Login Com sucesso!</h2>";
            //echo "<h2>Bem-vindo " .$_SESSION['nick']. "</h2>";
            ?>
                <input type="button" value="Editar Perfil" onclick="window.open('perfil.php', '_self')">
                <br>
                <!-- <input type="button" value="Vender" onclick="window.open('', '_self')"> -->
                <br>
                <form action="Vender.php" method="POST">
                    <input type="hidden" name="categoria" value="1">
                    <input type="submit" value="Vender">
                </form>
                <!-- <input type="button" value="Comprar" onclick="window.open('', '_self')"> -->
                <form action="comprar.php" method="POST">
                    <input type="hidden" name="categoria" value="0">
                    <input type="submit" value="Comprar">
                </form>

                <input type="button" value="Pesquisar" onclick="window.open('', '_self')">    
                <input type="button" value="Historico" onclick="window.open('', '_self')">
                <input type="button" value="Logout" onclick="window.open('logout.php', '_self')">

            <?php

            if(strcmp($_SESSION['nick'], "admin") ==0){
                ?>
                <br><br><h2>Area de Administracao</h2>
                <input type="button" value="Gerir Utilizadores" onclick="window.open('gerir_U.php', '_self')">
                <input type="button" value="Pesquisar Utilizadores" onclick="window.open('pesquisar_U.php', '_self')">
                <input type="button" value="Gerir Posts" onclick="window.open('gerirP.php', '_self')">
                <input type="button" value="Gerir Respostas" onclick="window.open('gerir_R_Admin.php', '_self')">
                <?php }?>
    </body>
</html>