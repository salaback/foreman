<?php

namespace Alablaster\Foreman\Traits;

trait InteractsWithFilesTrait
{
    private function openFile($path)
    {
        $file = fopen($path, "r") or die("Unable to open file!");
        $return = fread($file,filesize($path));
        fclose($file);

        return $return;
    }

    private function saveFile($path, $content) : void
    {
        $this->checkForDirectory($path);

        $file = fopen($path, "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);
    }

    private function deleteFile($path) : void
    {
        if(file_exists($path))
        {
            unlink($path);
        }
    }

    private function checkForDirectory($path)
    {
        $path = explode('/', $path);
        array_pop($path);
        $path = implode('/', $path);

        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
