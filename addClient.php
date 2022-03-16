<?php include 'includes/head.php' ?>
</head>
    <body>
    <?php include 'includes/header.php' ?>
    <div id="page-container">
        <div id="content-wrap">
            <div class="center">
                <h2 class="title">Add Client Information</h2>
                <?php include 'includes/db_conn.php' ?>

                <form action="addClient2.php" method="post" enctype="multipart/form-data">
                    <label for="fname"><b>Name: </b></label><br>
                    <input class="inputC" type="text" id="fname" placeholder="Client name..." size="50" name="name" required>
                    <br><br>

                    <label for="fnif"><b>NIF: </b></label><br>
                    <input class="inputC" type="text" size="9" name="nif" id="fnif" placeholder="123456789" required onkeypress="return allowNumbers(event)">
                    <br><br>

                    <label for="femail"><b>E-mail: </b></label><br>
                    <input class="inputC" type="text" size="50" id="femail" placeholder="Market@email.com" name="email" required>
                    <br><br>

                    <label for="fadress"><b>Address: </b></label><br>
                    <input class="inputC" type="text" size="50" id="fadress" placeholder="Street Up and down, 123, 2nd floor" name="adress" required>
                    <br><br>

                    <label for="fcontact"><b>Contact: </b></label><br>
                    <input class="inputC" type="text" size="15" name="contact" id="fcontact" placeholder="(123) 123 456 789" required onkeypress="return allowNumbers(event)">
                    <br><br>

                    <input class="butEdit" type="submit" value="Insert"> 
                    <input class="butClear" type="reset" value="Clear"><br><br>
                    <input class="butStatus" type="button" value="Cancel" onclick="window.open('Index.php', '_self')"></p><br>
                </form>
            </div>
        </div>
    <?php include 'includes/footer.php' ?>
    </div>
    </body>
</html>