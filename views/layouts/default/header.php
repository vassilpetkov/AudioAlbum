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
            <li><a href="/artists">Artists</a></li>
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
                <span>Hello <?php echo $_SESSION['username']; ?></span>
                <form action="/accounts/logout"><input type="submit" value="Logout" /></form>
            </div>
        <?php endif; ?>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>
