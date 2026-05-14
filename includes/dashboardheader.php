<header class="header">

    <div class="navBox">

        <div id="user_container">

            <img src="../assets/images/bell.png" class="notif_bell">

            <div class="user_profile"></div>

            <div class="name_container">

                <h3 id="username">
                    <?php 
                        echo isset($_SESSION['fullname']) 
                        ? $_SESSION['fullname'] 
                        : 'Guest';
                    ?>
                </h3>

                <p id="user_type">
                    <?php 
                        echo isset($_SESSION['user_type']) 
                        ? $_SESSION['user_type'] 
                        : 'User';
                    ?>
                </p>

            </div>

        </div>

    </div>

</header>