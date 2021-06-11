<?php

$method = $_SERVER["REQUEST_METHOD"];
$parsed = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed['path'];

$routes = [
  'POST' => [
    '/products' => 'createProductHandler',
    '/delete-product' => 'deleteProductHandler',
    '/update-product' => 'updateProductHandler',
    '/customers' => 'createCustomerHandler',
    '/delete-customer' => 'deleteCustomerHandler',
    '/update-customer' => 'updateCustomerHandler'
  ],
  'GET' => [
    '/' => 'homeHandler',
    '/home' => 'homeHandler',
    '/products' => 'productListHandler',
    '/customers' => 'customerListHandler'
  ]
];

$handlerFunction = $routes[$method][$path] ?? 'notFoundHandler';

$safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : 'notFoundHandler';

$safeHandlerFunction();

function compileTemplate($filePath, $params = []): string
{
  ob_start();
  require $filePath;
  return ob_get_clean();
}

function homeHandler()
{
  $homeTemplate = compileTemplate('./views/home.php');

  echo compileTemplate('./views/wrapper.php', [
    'innerTemplate' => $homeTemplate,
    'activeLink' => '/'
  ]);
  // echo "<h1 style='text-align: center; margin-top: 2rem;'><span style='color: limegreen;'>Willkommen</span> - HomePage</h1>";
}

function productListHandler()
{
  $contents = file_get_contents('./products.json');
  $products = json_decode($contents, true);
  $isSuccess = isset($_GET['success']);

  $productListTemplate = compileTemplate('./views/product-list.php', [
    'products' => $products,
    'isSuccess' => $isSuccess,
    "editedProductId" => $_GET["edit"] ?? ''
  ]);

  echo compileTemplate('./views/wrapper.php', [
    'innerTemplate' => $productListTemplate,
    'activeLink' => '/products'
  ]);
}

function createProductHandler()
{
  $newProduct = [
    'id' => uniqid(),
    "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
    "description" => filter_var($_POST["description"], FILTER_SANITIZE_STRING),
    "price" => (float)$_POST["price"],
    "discount" => (float)$_POST["discount"],
    "quantity" => (int)$_POST["quantity"]
  ];

  $contents = file_get_contents('./products.json');
  $products = json_decode($contents, true);

  array_push($products, $newProduct);
  $json = json_encode($products);
  file_put_contents('./products.json', $json);

  header('Location: /products?success=1');
}

function updateProductHandler()
{
  $updatedProductId = $_GET["id"] ?? "";
  $products = json_decode(file_get_contents("./products.json"), true);

  $foundProductIndex = -1;
  foreach ($products as $index => $product) {
    if ($product["id"] === $updatedProductId) {
      $foundProductIndex = $index;
      break;
    }
  }

  if ($foundProductIndex === -1) {
    header("Location: /products");
    return;
  }

  $updatedProduct = [
    "id" => $updatedProductId,
    "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
    "description" => filter_var($_POST["description"], FILTER_SANITIZE_STRING),
    "price" => (float)$_POST["price"],
    "discount" => (float)$_POST["discount"],
    "quantity" => (int)$_POST["quantity"]
  ];

  $products[$foundProductIndex] = $updatedProduct;

  file_put_contents('./products.json', json_encode($products));
  header("Location: /products");
}

function deleteProductHandler()
{
  $deletedProductId = $_GET['id'] ?? '';
  $products = json_decode(file_get_contents('./products.json'), true);

  $foundProductIndex = -1;

  foreach ($products as $index => $product) {
    if ($product['id'] === $deletedProductId) {
      $foundProductIndex = $index;
      break;
    }
  }

  if ($foundProductIndex === -1) {
    header('Location: /products');
    return;
  }

  array_splice($products, $foundProductIndex, 1);

  file_put_contents('./products.json', json_encode($products));

  header('Location: /products');
}

function customerListHandler()
{
  $contents = file_get_contents('./customers.json');
  $customers = json_decode($contents, true);
  $isSuccess = isset($_GET['success']);

  $customerListTemplate = compileTemplate('./views/customer-list.php', [
    'customers' => $customers,
    'isSuccess' => $isSuccess,
    "editedCustomerId" => $_GET["edit"] ?? '',
  ]);

  echo compileTemplate('./views/wrapper.php', [
    'innerTemplate' => $customerListTemplate,
    'activeLink' => '/customers'
  ]);
}

function createCustomerHandler()
{
  $newCustomer = [
    'id' => uniqid(),
    "firstname" => filter_var($_POST["firstname"], FILTER_SANITIZE_STRING),
    "lastname" => filter_var($_POST["lastname"], FILTER_SANITIZE_STRING),
    "street" => filter_var($_POST["street"], FILTER_SANITIZE_STRING),
    "city" => filter_var($_POST["city"], FILTER_SANITIZE_STRING),
    "zipCode" => filter_var($_POST["zipCode"], FILTER_SANITIZE_STRING),
    // "isSubscribed" => (bool)$_POST["isSubscribed"]
  ];

  $contents = file_get_contents('./customers.json');
  $customers = json_decode($contents, true);

  array_push($customers, $newCustomer);
  $json = json_encode($customers);
  file_put_contents('./customers.json', $json);

  header('Location: /customers?success=1');
}

function updateCustomerHandler()
{
  $updatedCustomerId = $_GET["id"] ?? "";
  $customers = json_decode(file_get_contents("./customers.json"), true);

  $foundCustomerIndex = -1;
  foreach ($customers as $index => $customer) {
    if ($customer["id"] === $updatedCustomerId) {
      $foundCustomerIndex = $index;
      break;
    }
  }

  if ($foundCustomerIndex === -1) {
    header("Location: /customers");
    return;
  }

  $updatedCustomer = [
    "id" => $updatedCustomerId,
    "firstname" => filter_var($_POST["firstname"], FILTER_SANITIZE_STRING),
    "lastname" => filter_var($_POST["lastname"], FILTER_SANITIZE_STRING),
    "street" => filter_var($_POST["street"], FILTER_SANITIZE_STRING),
    "city" => filter_var($_POST["city"], FILTER_SANITIZE_STRING),
    "zipCode" => filter_var($_POST["zipCode"], FILTER_SANITIZE_STRING),
    // "isSubscribed" => (bool)$_POST["isSubscribed"]
  ];

  $customers[$foundCustomerIndex] = $updatedCustomer;

  file_put_contents('./customers.json', json_encode($customers));
  header("Location: /customers");
}

function deleteCustomerHandler()
{
  $deletedCustomerId = $_GET['id'] ?? '';
  $customers = json_decode(file_get_contents('./customers.json'), true);

  $foundCustomerIndex = -1;

  foreach ($customers as $index => $customer) {
    if ($customer['id'] === $deletedCustomerId) {
      $foundCustomerIndex = $index;
      break;
    }
  }

  if ($foundCustomerIndex === -1) {
    header('Location: /customers');
    return;
  }

  array_splice($customers, $foundCustomerIndex, 1);

  file_put_contents('./customers.json', json_encode($customers));

  header('Location: /customers');
}

function notFoundHandler()
{
  echo "<h1 style='text-align: center; margin-top: 2rem;'><span style='color: tomato;'>Error 404</span> - Page Not Found</h1>";
}
