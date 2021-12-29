<?php

declare(strict_types=1);

namespace App\Controller;

use App\Config;
use App\Exception\ConfigException;
use App\Exception\FileUploaderException;
use App\Factory\ReaderFactory;
use App\FileUploader;
use Throwable;

class ProcessDataController extends AbstractController
{
    private Config $config;

    private FileUploader $uploader;

    public function __construct(string $configFilePath, FileUploader $uploader)
    {
        try {
            $this->config = new Config($configFilePath);
        } catch (ConfigException $e) {
            $this->renderErrorPage($e->getMessage());
            die;
        }
        $this->uploader = $uploader;
    }

    public function process(array $globalVarFiles): void
    {
        try {
            $factory = new ReaderFactory($this->config);
            $reader = $factory->create($this->uploader->upload($globalVarFiles));
            $data = $reader->read();
        } catch (Throwable|ConfigException|FileUploaderException $e) {
            $this->renderErrorPage($e->getMessage());
            return;
        }

        $this->render('data.php', [
            'data' => $data,
        ]);
    }
}
