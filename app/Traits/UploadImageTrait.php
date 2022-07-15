<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTrait
{
    protected function uploadTheImage(Request $request, $field = "image", $path = "images")
    {
        if ($request->$field) {

            $name = time() . '.' . explode('/', explode(':', substr($request->$field, 0, strpos($request->$field, ';')))[1])[1];

            \Image::make($request->$field)->save(public_path($path) . $name);

            return $name;
        }

        return null;
    }
}
