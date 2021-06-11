<?php

session_start();
error_reporting(-1);
ini_set('display_errors', 'on');

# Router
$method = $_SERVER['REQUEST_METHOD'];
$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

$routes = [
    'GET' => [
        '/' => 'homeHandler',
        '/login' => 'loginFormHandler',
        '/register' => 'registerFormHandler',

        '/blog' => 'blogHandler',
        '/peter' => 'peterHandler',
        '/projekte' => 'projectHandler',
        '/bootcamp' => 'bootcampHandler',
        '/unterlagen' => 'documentHandler',
        '/kontakt' => 'documentHandler',
        '/kids-zone' => 'kidsHandler',
        '/schwesterEdit' => 'schwesterEditHandler'
    ],
    'POST' => [
        '/register' => 'registrationHandler',
        '/login' => 'loginHandler',
        '/logout' => 'logoutHandler'
    ],
];

$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";
$handlerFunction();

function getPathWithId($url)
{
    $parsed = parse_url($url);
    if (!isset($parsed['info'])) {
        return $url;
    }

    $queryParams = [];
    parse_str($parsed['info'], $queryParams);
    // var_dump($queryParams);
    // exit;
    // var_dump($parsed['path'] . "?id=" . $queryParams['id']);

    return $parsed['path'];
}

function logoutHandler()
{
    session_start();

    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));

    session_destroy();

    header('Location: /');
}

function redirectToLoginPageIfNotLoggedIn()
{
    if (isLoggedIn()) {
        return;
    }

    header('Location: /login');

    exit;
}

function loginHandler()
{
    $username = esc($_POST["username"]);
    $username = $_POST["username"];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);

    $pdo = getConnection();
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([
        $username
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('Location: /login?info=invalidCredentials');
        return;
    }

    $isVerified = password_verify($_POST['password'], $user["password"]);

    if (!$isVerified) {
        header('Location: /login?info=invalidCredentials');
        return;
    }

    session_start();
    $_SESSION['username'] = $user['username'];
    $_SESSION['userId'] = $user['id'];
    $_SESSION['isAuthorized'] = isLoggedIn();

    header('Location: /?info=isLoggedIn');
}


function registrationHandler()
{
    $username = $_POST["username"];
    $email = $_POST["email"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    
    if (empty($password)) {
        // $_SESSION['info'] = 'username or email already exists';
        header('Location: /register?info=invalidRegister');
        exit;
    }

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);

    $pdo = getConnection();


    $statement = $pdo->prepare("SELECT * FROM `users` WHERE username = ? OR email = ?;");

    if ($statement) {

        $statement->execute([
            $username,
            $email,
        ]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            // $_SESSION['info'] = 'username or email already exists';
            header('Location: /register?info=invalidRegister');
            exit;
        }
    }

    


    $statement = $pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`, `createdAt`) VALUES (?, ?, ?, ?);");
    $statement->execute([
        $username,
        $email,
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        time()
    ]);

    header('Location: /login?info=isSuccess');
}

function loginFormHandler()
{
    // $username = $_POST['username'];
    echo render('wrapper.phtml', [
        'content' => render('loginForm.phtml', []),
        'isAuthorized' => isLoggedIn(),
        'isAuthorized' => false,
        // 'username' => $username
    ]);
    return;
}

function registerFormHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('registrationForm.phtml', []),
        'isAuthorized' => isLoggedIn(),
        'isAuthorized' => false,
    ]);
}

function esc(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function isLoggedIn(): bool
{
    // echo "<pre>";
    // var_dump(isset($_COOKIE['PHPSESSID']));
    // exit;
    if (!isset($_COOKIE[session_name()])) {

        return false;
    }

    if (!isset($_SESSION)) {

        session_start();
    }

    if (!isset($_SESSION['userId'])) {

        return false;
    }

    return true;
}


function peterHandler()
{
    // redirectToLoginPageIfNotLoggedIn();
    if (!isLoggedIn()) {
        echo render("wrapper.phtml", [
            'content' => render('subscriptionForm.phtml', [
                // 'isRegistration' => isset($_GET['isRegistration']),
                // 'url' => getPathWithId($_SERVER['REQUEST_URI']),
                'isAuthorized' => isLoggedIn()

            ]),
            'isAuthorized' => isLoggedIn(),

            'isAuthorized' => false,
        ]);
        return;
    }

    echo render('wrapper.phtml', [
        'content' => render('peter.phtml', []),
        'isAuthorized' => true,
    ]);
}

function schwesterEditHandler()
{
    if (!isLoggedIn()) {
        echo render("wrapper.phtml", [
            'content' => render('subscriptionForm.phtml', []),
            'isAuthorized' => false,
        ]);
        return;
    }

    echo render('wrapper.phtml', [
        'content' => render('schwesterEdit.phtml', []),
        'isAuthorized' => true,
    ]);
}

function homeHandler()
{
    // redirectToLoginPageIfNotLoggedIn();
    if (!isLoggedIn()) {
        echo render('wrapper.phtml', [
            'content' => render('home.phtml', [
                // 'isRegistration' => isset($_GET['isRegistration']),
                // 'info' => $_GET['info'] ?? '',
                // 'isAuthorized' => false,
                // 'isAuthorized' => isLoggedIn(),
                // 'username' => $_POST['username']
            ]),
            'isAuthorized' => false,
            'isAuthorized' => isLoggedIn(),

        ]);
    return;
    }

    echo render('wrapper.phtml', [
        'content' => render('home.phtml', [
            // 'isRegistration' => isset($_GET['isRegistration']),
            // 'info' => $_GET['info'] ?? '',
            'isAuthorized' => isLoggedIn(),
            // 'username' => $_POST['username']
            ]),
            'isAuthorized' => true,
            'isAuthorized' => isLoggedIn(),
    ]);

    return;
}

function kidsHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('kidszone.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function blogHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('blog.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function contactHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('contact.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function documentHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('document.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function projectHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('project.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function bootcampHandler()
{
    echo render('wrapper.phtml', [
        'content' => render('bootcamp.phtml', []),
        'isAuthorized' => isLoggedIn()
    ]);
}

function render($filePath, $params = []): string
{
    ob_start();
    require __DIR__ . "/views/" . $filePath;
    return ob_get_clean();
}

function getConnection()
{
    return new PDO(
        'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'],
        $_SERVER['DB_USER'],
        $_SERVER['DB_PASSWORD']
    );
}

function notFoundHandler()
{
    http_response_code(404);

    echo render('wrapper.phtml', [
        'content' => render('404.phtml', []),
    ]);
}
