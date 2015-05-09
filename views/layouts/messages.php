<?php

renderMessages(INFO_MESSAGES_SESSION_KEY, 'alert alert-dismissible alert-success');
renderMessages(ERROR_MESSAGES_SESSION_KEY, 'alert alert-dismissible alert-danger');

function renderMessages($messagesKey, $cssClass) {
    if (isset($_SESSION[$messagesKey]) && count($_SESSION[$messagesKey]) > 0) {
        echo '<div class="' . $cssClass . '">';
        echo '<button type="button" class="close" data-dismiss="alert">×</button>';
        foreach ($_SESSION[$messagesKey] as $msg) {
            echo "<span>" . htmlspecialchars($msg) . '</span>';
        }
        echo '</div>';
    }
    $_SESSION[$messagesKey] = [];
}
