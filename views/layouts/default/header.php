<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="/content/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/content/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/content/bootstrap.min.css" />
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">Audio Album</a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li><a href="/genres">Genres</a></li>
                        <li><a href="/playlists">Playlists</a></li>
                        <li><a href="/songs">Songs</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(!$this->isLoggedIn()) : ?>
                            <li><a href="/accounts/login">Login</a></li>
                            <li><a href="/accounts/register">Register</a></li>
                        <?php endif; ?>
                        <?php if($this->isLoggedIn()) : ?>
                            <li><a href="/accounts/profile">Hello <?= $_SESSION['username']; ?></a></li>
                            <li><a href="/accounts/logout">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-inverse"></nav>
    <div class="container">
    <?php include_once('views/layouts/messages.php'); ?>
