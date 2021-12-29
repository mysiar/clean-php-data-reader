<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
    private const VIEW_FOLDER = __DIR__ . '/../Views/';

    protected function render(string $view, array $data = []): void
    {
        if (file_exists(self::VIEW_FOLDER . $view)) {
            require_once __DIR__ . '/../Views/' . $view;
        } else {
            die(sprintf('View "%s" does not exist', $view));
        }
    }

    protected function renderErrorPage(string $message): void
    {
        $this->render('error.php', [
            'error' => $message,
        ]);
    }
}
