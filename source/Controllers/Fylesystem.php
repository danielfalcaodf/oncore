<?php

namespace Source\Controllers;

use League\Flysystem\UnableToRetrieveMetadata;
use League\Flysystem\FilesystemError;

class Fylesystem extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function pathTo($data)
    {
        try {
            $path = urldecode($data['folder']) . '/';
            $this->adapterInit($path);
            $listing =  $this->filesystem->listContents('/');

            $listing = $this->listPathFiles($listing);
            if (empty($listing)) {
                # code...
                echo $this->ajaxResponse('message', ['message' => 'Pasta Vazia ou não encontrada']);
                return;
            }
            echo $this->ajaxResponse('listing', $listing);
        } catch (FilesystemError | UnableToRetrieveMetadata $exception) {

            echo $this->ajaxResponse('message', ['message' => "Erro! {$exception}"]);
        }
    }
    public function openFile($data)
    {
        # code...
    }
}