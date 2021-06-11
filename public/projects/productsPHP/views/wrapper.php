<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <title>Produkte</title>
</head>

<body>

    <nav class="navbar navbar-expand navbar-light bg-danger">
        <div class="navbar-nav">
            <a href="/" class="nav-item nav-link <?php echo $params['activeLink'] === "/" ? "active" : "" ?>">Home</a>
            <a href="/products" class="nav-item nav-link <?php echo $params['activeLink'] === "/products" ? "active" : "" ?>">Produkte</a>
            <a href="/customers" class="nav-item nav-link <?php echo $params['activeLink'] === "/customers" ? "active" : "" ?>">Mitglieds</a>
        </div>
    </nav>

    <?= $params['innerTemplate'] ?>

    <footer class="bg-danger text-center fixed-bottom text-lg-start text-warning">
        <div class="text-center p-3">
            madDesign&copy; <?= date('Y'); ?>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>