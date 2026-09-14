<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function image(Request $request): JsonResponse
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $path = $data['image']->store('editor-images', 'public');

        return response()->json([
            'url' => '/storage/'.$path,
        ]);
    }
}

