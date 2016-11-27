<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;

class RawUploader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$names)
    {
        $urls = array_map(function ($name) use ($request)
        {
            if ($request->has($name)) {
                return $this->upload($request, $name);
            }

            return NULL;
        }, $names);

        $request['uploaded'] = (object) array_combine($names, $urls);

        return $next($request);
    }

    function upload($request, $name)
    {
        $tmpdir = 'tmp/';
        $localPath = public_path($tmpdir) . str_random(16);
        file_put_contents($localPath, $request->input($name));

        $localFile = new File($localPath);

        if (!env('BLOB_ENABLED')) {
            // fallback: local storage
            return Storage::url(
                Storage::disk('public')
                    ->putFile($name, $localFile)
            );
        }

        if (!isset($this->blobRestProxy)) {
            $this->blobRestProxy = ServicesBuilder::getInstance()
                ->createBlobService(env('BLOB_CONNECTION', ''));
        }

        $options = new CreateBlobOptions();
        $options->setBlobContentType($localFile->getMimeType());

        $hashName = $localFile->hashName();
        $fileHandler = fopen($localPath, 'r');

        $uploadPath = $name . '/' . $hashName;

        $this->blobRestProxy->createBlockBlob(
            env('BLOB_CONTAINER'),
            $uploadPath,
            $fileHandler,
            $options
        );

        fclose($fileHandler);
        unlink($localPath);

        return env('BLOB_URL') .
            env('BLOB_CONTAINER') . '/' .
            $uploadPath;
    }
}
