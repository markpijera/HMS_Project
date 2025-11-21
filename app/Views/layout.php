<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/custom.css">

    <!-- STYLES -->


</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

    <div class="menu">
        <ul>
            <li class="logo">
                <a href="/" target="_blank">
                    <i class="fas fa-hospital fa-2x text-white"></i>
                </a>
            </li>
            <li class="menu-toggle">
                <button id="menuToggle" class="btn btn-outline-light">&#9776;</button>
            </li>
            <li class="menu-item hidden"><a href="/">Home</a></li>
            <li class="menu-item hidden"><a href="/patients">Patients</a></li>
            <li class="menu-item hidden"><a href="https://codeigniter.com/user_guide/" target="_blank">Docs</a>
            </li>
            <li class="menu-item hidden"><a href="https://forum.codeigniter.com/" target="_blank">Community</a></li>
            <li class="menu-item hidden"><a
                    href="https://codeigniter.com/contribute" target="_blank">Contribute</a>
            </li>
        </ul>
    </div>

</header>

<!-- CONTENT -->

<section>
    <?= $this->renderSection('content') ?>
</section>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

<footer>
    <div class="environment">

        <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

        <p>Environment: <?= ENVIRONMENT ?></p>

    </div>

    <div class="copyrights">

        <p>&copy; <?= date('Y') ?> CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
            open source licence.</p>

    </div>

</footer>

<!-- SCRIPTS -->

<script {csp-script-nonce}>
    document.getElementById("menuToggle").addEventListener('click', toggleMenu);
    function toggleMenu() {
        var menuItems = document.getElementsByClassName('menu-item');
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];
            menuItem.classList.toggle("hidden");
        }
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- -->

</body>
</html>