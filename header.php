<!-- header.php -->
<header>
    <div class="container">
        <h1>Práctica PHP</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mi Sitio Web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php if (estaLogueado()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="bi bi-person-fill-down"></i>Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="bi bi-person-fill-check"></i>Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="check_in.php"><i class="bi bi-person-fill-add"></i> Registro</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
</header>
