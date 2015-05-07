<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/content/styles.css" />
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
    <header>
        <a href="/"><img src="/content/images/site-logo.png"></a>
        <ul class="menu">
            <li><a href="/">Home</a></li>
            <li><a href="/playlists">Playlists</a></li>
            <li><a href="/genres">Genres</a></li>
            <li><a href="/songs">Songs</a></li>
        </ul>
        <?php if(!$this->isLoggedIn()) : ?>
            <div id="not-logged-in-header">
                <a href="/accounts/login">Login</a>
                <a href="/accounts/register">Register</a>
            </div>
        <?php endif; ?>
        <?php if($this->isLoggedIn()) : ?>
            <div id="logged-in-header">
                <span>Hello <a href="/accounts/profile"><?php echo $_SESSION['username']; ?></a></span>
                <form action="/accounts/logout"><input type="submit" value="Logout" /></form>
            </div>
        <?php endif; ?>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>
