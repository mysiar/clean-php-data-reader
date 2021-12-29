<?php

declare(strict_types=1);

namespace App;

use App\Exception\FileUploaderException;

class FileUploader
{
    public function upload(array $globalVarFiles, string $targetDirectory = '/tmp'): string
    {
        if (
            ! isset($globalVarFiles["uploaded_file"]['tmp_name'])
            || '' === $globalVarFiles["uploaded_file"]['tmp_name']) {
            throw FileUploaderException::noFile();
        }

        $filename = $globalVarFiles['uploaded_file']['name'];
        $tmpFilename = $globalVarFiles['uploaded_file']['tmp_name'];

        $newFilepath = $targetDirectory . "/" . $filename;

        if (! copy($tmpFilename, $newFilepath)) {
            throw FileUploaderException::cantMove();
        }
        unlink($tmpFilename);

        return $newFilepath;
    }
}
