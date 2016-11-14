<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;

class FileUploader
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
            if ($request->hasFile($name) && $request->file($name)->isValid()) {
                return $this->upload($request, $name);
            }

            return NULL;
        }, $names);

        $request['uploaded'] = (object) array_combine($names, $urls);

        return $next($request);
    }

    function upload($request, $name)
    {
        $localFile = $request->file($name);

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
        $tmpdir = 'tmp/';
        $localPath = public_path($tmpdir) . $hashName;

        $localFile->move($tmpdir, $hashName);
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
