<?php

namespace App\Action;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageAction
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return bool|string
     */
    public function __invoke(Request $request): bool|string
    {
      return Storage::putFile('images', $request->file('images'));
    }
}
