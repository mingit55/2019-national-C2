<?php
    session_start();

    define("ROOT", dirname(__DIR__));
    define("PUBLIC", ROOT."/public");
    define("__PUBLIC", ROOT."/public");
    define("TEMPLATE", __PUBLIC."/template");
    define("SRC", ROOT."/src");
    define("VIEW", SRC."/View");

    require ROOT."/autoload.php";
    require ROOT."/helper.php";
    require ROOT."/permission.php";
    require ROOT."/web.php";