<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exception\FileUploaderException;
use App\FileUploader;
use PHPUnit\Framework\TestCase;

class FileUploaderTest extends TestCase
{
    private FileUploader $uploader;

    public function setUp(): void
    {
        $this->uploader = new FileUploader();
    }

    /**
     * @covers \App\FileUploader::upload
     * @throws FileUploaderException
     */
    public function testUpload(): void
    {
        $tmpFile = '/tmp/simulating-uploaded-file.xxx';
        touch($tmpFile);

        $filename = 'uploaded-file.txt';
        $globalVarFiles = [
            "uploaded_file" => [
                'tmp_name' => $tmpFile,
                'name' => $filename,
            ],
        ];

        $this->uploader->upload($globalVarFiles);

        $this->assertFileExists('/tmp/' . $filename);
    }

    /**
     * @covers \App\FileUploader::upload
     * @throws FileUploaderException
     */
    public function testUploadThrowingNoFileToProcess(): void
    {
        $globalVarFiles = [
            "uploaded_file" => [
                'tmp_name' => '',
                'name' => '',
            ],
        ];

        $this->expectException(FileUploaderException::class);
        $this->expectExceptionMessage('There is no file to process.');
        $this->uploader->upload($globalVarFiles);
    }

    /**
     * @covers \App\FileUploader::upload
     * @throws FileUploaderException
     */
    public function testUploadThrowingCanNotCopy(): void
    {
        $this->markTestSkipped('Not testable in docker env as all docker commands are run as root.');
        $tmpFile = '/tmp/simulating-uploaded-file.xxx';
        touch($tmpFile);

        $targetDirectory = '/var/log/';

        $filename = 'uploaded-file.txt';
        $globalVarFiles = [
            "uploaded_file" => [
                'tmp_name' => $tmpFile,
                'name' => $filename,
            ],
        ];

        $this->expectException(FileUploaderException::class);
        $this->expectExceptionMessage("Can't move file.");
        $this->uploader->upload($globalVarFiles, $targetDirectory);
    }
}
