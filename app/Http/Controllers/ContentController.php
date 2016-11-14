<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('uploader:content,thumbnail')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::simplePaginate(12);

        return view('contents/index', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents/upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $content = new Content;
        $content->user_id = $user->id;
        $content->title = $request->input('title');
        $content->description = $request->input('description');
        $content->src = $request->uploaded->content;
        $content->thumbnail = $request->uploaded->thumbnail;
        $content->save();

        return view('contents/uploaded', ['content' => $content]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::findOrFail($id);

        return view('contents/play', ['content' => $content]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getPublicUrl($containerName, $uploadedFile, $useBlobStorage)
    {
        if (!$useBlobStorage) {
            return Storage::url(
                Storage::disk('public')
                    ->putFile($containerName, $uploadedFile)
            );
        }
        if (!$this->blobRestProxy) {
            $this->blobRestProxy = ServicesBuilder::getInstance()
                ->createBlobService(env('BLOB_CONNECTION', ''));
        }

        $content_hashname = $uploadedFile->hashName();
        $tmpdir = 'tmp/';
        $filepath = public_path($tmpdir) . $content_hashname;

        $options = new CreateBlobOptions();
        $options->setBlobContentType($uploadedFile->getMimeType());

        $uploadedFile->move($tmpdir, $content_hashname);
        $content_file = fopen($filepath, 'r');

        $this->blobRestProxy->createBlockBlob(
            $containerName,
            $content_hashname,
            $content_file,
            $options
        );

        fclose($content_file);
        unlink($filepath);

        return env('BLOB_URL') .
            $containerName . '/' .
            $content_hashname;
    }
}
