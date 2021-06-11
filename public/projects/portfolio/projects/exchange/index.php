<?php

$value = (int)($_GET['howmuch'] ?? 1);
// var_dump($value);
// exit;
$sourceCurrency = $_GET['aboutwhat'] ?? 'USD';
$targetCurrency = $_GET['forwhat'] ?? 'EUR';

$content = file_get_contents("https://petersworld.ch/api/exchangerates.json?base=" . $sourceCurrency);
$decodedContent = json_decode($content, true);

$result = $decodedContent["rates"][$targetCurrency] * $value;


$currencies = json_decode(file_get_contents('./currencies.json'), true);

// var_dump($result);
// var_dump($currencies);
// exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
  <title>ExChange App</title>
</head>

<body>
  <section class="container mt-5">
    <div class="card w-50 m-auto p-3">
      <div class="card-header bg-dark">
        <h1 class="text-center text-warning">Money ExChange</h1>
      </div>
      <div class="card-body">
        <form action="index.php?base=" method="get" class="form-group">
          <label for="von">wie viel:</label>
          <input class="form-control mb-2" name="howmuch" type="number" id="von" value="<?= $value ?>" />

          <label for="von">von:</label>
          <select name="aboutwhat" class="form-control mb-2">
            <?php foreach ($currencies as $currency) : ?>
              <option value="<?= $currency['label'] ?>" <?= $sourceCurrency === $currency['label'] ? 'selected' : '' ?>>
                <?= $currency['name'] ?> <?= $currency['symbol'] ?>
              </option>
            <?php endforeach; ?>
          </select>

          <label for="von">auf:</label>
          <select name="forwhat" class="form-control mb-2">
            <?php foreach ($currencies as $currency) : ?>
              <option value="<?= $currency['label'] ?>" <?= $targetCurrency === $currency['label'] ? 'selected' : '' ?>>
                <?= $currency['name'] ?> <?= $currency['symbol'] ?>
              </option>
            <?php endforeach; ?>
          </select>
          <button type="submit" class="btn btn-success form-control">Change</button>
        </form>
      </div>
      <div class="card-footer">
        <h3 class="text-right text-danger"><b><?= number_format($result, 4, ',', '').' '.$targetCurrency ?></b></h3>
      </div>
    </div>
  </section>
</body>

</html>