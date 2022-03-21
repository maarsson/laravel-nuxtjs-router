<?php

namespace Maarsson\NuxtJsRouter\Http\Controllers;

use Illuminate\Routing\Controller;

class RouteController extends Controller
{
    /**
     * Handles the NuxtJS file request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $nuxtPublicFolderPath = realpath(public_path(config('nuxtjs.public_folder')));
        $nuxtRequestPath = $nuxtPublicFolderPath . request()->getRequestUri();
        $nuxtIndexPath = $nuxtPublicFolderPath . '/index.html';
        $filePath = file_exists($nuxtRequestPath) && ! is_dir($nuxtRequestPath) ? $nuxtRequestPath : $nuxtIndexPath;
        $responseHeader = str_ends_with($nuxtRequestPath, '.js') ? ['Content-Type' => 'application/javascript'] : [];

        if (
            $nuxtPublicFolderPath === false
            || ! is_dir($nuxtPublicFolderPath)) {
            abort(412, 'The NuxtJS public path does not exists! (Frontend was not compiled yet?)');
        }

        if (! file_exists($nuxtIndexPath)) {
            abort(422, 'The NuxtJS index file does not exists!');
        }

        if (! file_exists($filePath)) {
            abort(422, 'The requested file does not exists!');
        }

        return response(
            file_get_contents($filePath),
            200,
            $responseHeader
        );
    }
}
