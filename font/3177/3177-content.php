<?php
$url_host = $_SERVER['HTTP_HOST'];

$pattern_document_root = addcslashes(realpath($_SERVER['DOCUMENT_ROOT']), '\\');

$pattern_uri = '/' . $pattern_document_root . '(.*)$/';

preg_match_all($pattern_uri, __DIR__, $matches);

$url_path = $url_host . $matches[1][0];

$url_path = str_replace('\\', '/', $url_path);
?>
<div class="type-3177">

<nav class="navbar navbar-light bg-white">
    <div class="container">
        <div class="navbar-container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://trackstore.qodeinteractive.com/wp-content/uploads/2017/11/Logo-dark-green.png" alt="Track Store Logo">
            </a>

            <!-- Navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Elements</a>
                </li>
            </ul>

            <!-- Search form -->
            <form class="form-inline">
                <input class="form-control" type="search" placeholder="SEARCH" aria-label="Search">
                <button class="btn" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            <div class="mobile-nav" hidden>
                <img src="./img/image.png" alt="" sizes="" srcset="">
            </div>
        </div>
    </div>
</nav>

</div>