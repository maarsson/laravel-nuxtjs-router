<?php

namespace Maarsson\NuxtJsRouter\Http\Controllers;

use Illuminate\Routing\Controller;

class RouteController extends Controller
{
    /**
     * Get the NuxtJS view.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $folder = realpath(public_path(config('nuxtjs.public_folder')));

        if (
            $folder === false
            || ! is_dir($folder))
        {
            // NuxtJs public path does not exists
            abort(412, 'The frontend was not compiled yet');
        }

        $path = $folder . request()->getRequestUri();

        if (
            file_exists($path)
            && ! is_dir($path)
        ) {
            // The request was an existing file to be loaded
            include $path;

            return;
        }

        $indexPath = $folder . '/index.html';

        if (! file_exists($indexPath))
        {
            // NuxtJs index file does not exists
            abort(422, 'The frontend loader not exists');
        }

        return file_get_contents($indexPath);
    }
}
