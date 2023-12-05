<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class S3Facade extends Facade
{
    /**
     * @method static string getObjectUrl(string $objectKey, int $expiration = self::EXPIRATION_TIME)
     * @method static string getPreSignedUploadUrl(string $objectKey, int $expiration = self::EXPIRATION_TIME)
     *
     * @see \App\Helpers\AmazonS3
     */
    protected static function getFacadeAccessor(): string
    {
        return 'AmazonS3';
    }
}
