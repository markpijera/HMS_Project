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

<div class="global-back-button-container">
    <button type="button" class="btn btn-outline-secondary btn-sm global-back-button" onclick="window.history.back()">
        <i class="fas fa-arrow-left me-1"></i> Back
    </button>
</div>

<!-- CONTENT -->

<section>
    <?= $this->renderSection('content') ?>
</section>

<!-- FOOTER intentionally left empty -->

<!-- SCRIPTS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var backButton = document.querySelector('.global-back-button');
            if (backButton && window.history.length <= 1) {
                backButton.style.display = 'none';
            }
        });
    </script>
<!-- -->

</body>
</html>