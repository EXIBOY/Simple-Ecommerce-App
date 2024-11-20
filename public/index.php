<?php

    require_once __DIR__ . '/../vendor/autoload.php';

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    // Set up Twig
    $loader = new FilesystemLoader(__DIR__ . '/../templates');
    $twig = new Environment($loader, [
        'cache' => false,
    ]);

    // Render a template
    echo $twig->render('index.twig', ['name' => 'World']);
