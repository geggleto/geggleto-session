# geggleto-session
Object oriented wrapper around the super global _SESSION

# Usage
```php
//Make sure you are starting the session somewhere... session_start()

$sessionContainer = new Session();

$session->flash("error", "My error");

//In your view on the next page
$session->getFlash("error");
```

# Helpers
If you are using Twig it might be helpful to just directly inject the error.

```php
//Inject Error's into twig
/** @var $session \Geggleto\Session */
$session = $c[Geggleto\Session::class]; // Grab from the container
$error = $session->getFlash("error"); //Grab the message

if (isset($error)) {
    $view->getEnvironment()->addGlobal("error", $error); //Inject it into twig as a global
}
```