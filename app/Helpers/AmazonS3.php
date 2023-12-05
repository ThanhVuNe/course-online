<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

class AmazonS3
{
    /**
     * @var int
     */
    protected const EXPIRATION_TIME = 60;

    /**
     * @var FilesystemAdapter
     */
    protected $client;

    /**
     * Define storage to save
     *
     * @return $this
     */
    public function s3Client()
    {
        $this->client = Storage::disk('s3');
        return $this;
    }

    /**
     * Gennerate presigned url has expried time.
     *
     * @param string $objectKey The key of the object
     * @param int $expiration The time at which the URL should expire(minutes).
     *
     * @return string
     */
    public function getPreSignedUploadUrl(string $objectKey, int $expiration = self::EXPIRATION_TIME): string
    {
        return $this->s3Client()->client->temporaryUploadUrl(
            $objectKey,
            now()->addMinutes($expiration)
        )['url'];
    }

    /**
     * Gennerate presigned upload url has expried time.
     *
     * @param string $objectKey The key of the object
     * @param int $expiration The time at which the URL should expire(minutes).
     *
     * @return string
     */
    public function getObjectUrl(string $objectKey, int $expiration = self::EXPIRATION_TIME): string
    {
        return $this->s3Client()->client->temporaryUrl(
            $objectKey,
            now()->addMinutes($expiration)
        );
    }
}
