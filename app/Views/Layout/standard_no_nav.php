<?php if (!defined('APP')) { exit; }
use App\Theme;
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title><?= $this->title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="m-0 w-screen h-screen flex flex-col bg-gray-200 p-3">
        <?= $contents; ?>
        <footer></footer>
    </body>
</html>