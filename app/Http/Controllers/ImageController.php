<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;

class ImageController extends Controller
{
    public function show(FileSystem $filesystem, $path)
    {
        try {
            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(request()),
                'source' => app('filesystem')->disk('public')->getDriver(),
                'cache' => storage_path('framework/cache/glide'),
            ]);
            return $server->getImageResponse($path, request()->query()) ;
        } catch (\League\Glide\Filesystem\FileNotFoundException $e) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}
