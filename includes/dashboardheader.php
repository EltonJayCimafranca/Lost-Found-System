<header class="header">

    <div class="navBox">

        <div id="user_container">

            <img src="../assets/images/bell.png" class="notif_bell">

            <div class="user_profile"></div>

            <div class="name_container">

                <h3 id="username">
                    <?php echo $_SESSION['fullname']; ?>
                </h3>

                <p id="user_type">
                    <?php echo $_SESSION['user_type']; ?>
                </p>

            </div>

        </div>

    </div>

</header>