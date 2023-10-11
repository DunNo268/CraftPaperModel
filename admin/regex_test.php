<?php
    function checkPrivilege($uri = false) {
        $uri = $uri != false ? $uri : $_SERVER['REQUEST_URI'];
        $privileges = $_SESSION['user_login']['privileges'];
        $privileges = implode("|", $privileges);
        preg_match('/admin\.php$|' . $privileges . '/', $uri, $matches);
        return !empty($matches);
    }
?>