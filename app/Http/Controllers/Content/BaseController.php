<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Content;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    protected function _index(Request $request)
    {
        $contents = Content::orderBy('id', 'desc')
            ->simplePaginate(12);

        return ['contents' => $contents];
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    protected function _create(Request $request)
    {
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function _store(Request $request)
    {
        $user = $request->user();
        $content = new Content;
        $content->user_id = $user->id;
        $content->title = $request->input('title');
        $content->description = $request->input('description');
        if (isset($request->uploaded->content)) {
            $content->src = $request->uploaded->content;
        } else {
            $content->src = '';
        }
        if (isset($request->uploaded->thumbnail)) {
            $content->thumbnail = $request->uploaded->thumbnail;
        }
        $content->save();

        return ['content' => $content];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    protected function _show(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        return ['content' => $content];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    protected function _edit(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if ($content->user_id !== $request->user()->id) {
            abort(403);
        }

        return ['content' => $content];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    protected function _update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if ($content->user_id !== $request->user()->id) {
            abort(403);
        }

        if (isset($request->uploaded->content)) {
            $content->src = $request->uploaded->content;
            $content->save();
        }

        if (isset($request->uploaded->thumbnail)) {
            $content->thumbnail = $request->uploaded->thumbnail;
            $content->save();
        }

        $content->update($request->all());

        return ['content' => $content];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    protected function _destroy(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if ($content->user_id !== $request->user()->id) {
            abort(403);
        }

        $content->delete();

        return [];
    }

}
