<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use GifCreator\GifCreator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
      $frames = [];

      foreach (Storage::allFiles('public/gifFrames') as $frame) {
        $frames[] = imagecreatefrompng(storage_path('app/' . $frame));
      }

      $maker = new GifCreator();
      $maker->create($frames, 250, 0);
      header('Content-type: image/gif');
      header('Content-Disposition: filename="bicuda-no-bozo.gif"');
      echo $maker->getGif();
    }
}
