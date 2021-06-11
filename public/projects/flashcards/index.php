<?php

$number = filter_input(INPUT_GET, 'num', FILTER_SANITIZE_NUMBER_INT);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css" type="text/css">
    <link rel="shortcut icon" href="./public/favicon.ico" type="image/x-icon">
    <title>Multiplication Flash Cards</title>
</head>

<body>
    <?php include_once 'view/header.php'; ?>

    <?php

    if ($number) {
        include_once 'view/results.php';
    } else {
        include_once 'view/form.php';
    }

    ?>

    <?php include_once 'view/footer.php'; ?>
</body>

</html>