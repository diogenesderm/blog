<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;

class ImageController extends Controller
{
    public function show($path)
    {

        try {
            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(request()),
                'source' => app('filesystem')->disk('uploads')->getDriver(),
                'cache' => storage_path('framework/cache/glide/uploads'),
            ]);

            return $server->getImageResponse($path, request()->all());
        } catch (\League\Glide\Filesystem\FileNotFoundException $e) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}

