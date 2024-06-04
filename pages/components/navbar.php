<header class="header">
    <section class="flex">
        <div class="logo">
        <a href="home.php" class="active"><img src="../img/CTF-Logo.png" alt="CTF Logo"></a>
        </div>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="practice.php">Practice</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact Us</a>
            <div class="dropdown">
                <a class="dropbtn">Learn</a>
                <div class="dropdown-content">
                    <a href="resources.php">Resources</a>
                    <a href="community.php">Community</a>
                    <a href="lectures.php">Lectures</a>
                </div>
            </div>
        </nav>
        
        <div class="login-signup">
            <?php 
                if(isset($_SESSION['username'])) {
                    echo "<a href='logout.php'>Logout</a>";
                }else{
                    echo "<a href='../login/index.php'>Login</a> or <a href=''>Signup</a>";
                }
            ?> 
        </div>
    </section>
</header>