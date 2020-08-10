<nav>
    <ul>
        <li><a href="/">Home</a>
        <li><a href="/main/listblogs">Blog Listing</a>
        <li><a href="/main/readblog">Blog Entry</a>
        <?php if ($isLoggedIn == true) {
            echo('<li><a href="/main/logout">Logout</a>');
        } else {
            echo('<li><a href="/main/login">Login</a>');
        } ?>
    </ul>
</nav>