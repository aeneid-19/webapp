<?php
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">ACME Inc.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Services/index">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Pricing/index">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Store/index">Store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Support/index">Support</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Access/index">Login</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Demos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/Portfolio/index">Dataset</a>
                    <a class="dropdown-item" href="/Impressum/index">DataTable</a>
                    <a class="dropdown-item" href="/DB/index">Database</a>
                    <a class="dropdown-item" href="/Speichern/index">Image upload</a>
                    <a class="dropdown-item" href="/Wertschoepfung/index">Wertschöpfung</a>
                    <a class="dropdown-item" href="/Darlehensberechnung/index">Darlehensberechnung</a>
                </div>
            </li>
            <form class="form-inline my-2 my-lg-0" action="/" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
        </ul>
    </div>
</nav>
