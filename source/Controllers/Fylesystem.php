<?php

namespace Source\Controllers;

use League\Flysystem\UnableToRetrieveMetadata;
use League\Flysystem\FilesystemError;

class Fylesystem extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
        $this->router = $router;
    }

    public function pathTo($data)
    {
        try {

            $path = @$_REQUEST['pathTo'] ? urldecode($_REQUEST['pathTo']) . '/' : urldecode($data['folder']) . '/';
            $this->adapterInit($path);
            $listing =  $this->filesystem->listContents('/');

            $listing = $this->listPathFiles($listing);
            if (empty($listing)) {
                # code...
                echo $path;
                echo $this->ajaxResponse(['message' => ['message' => 'Pasta Vazia ou não encontrada ', 'type' => "error"]]);
                return;
            }
            $listpath = [];
            foreach ($listing as $key => $arr) :


                foreach ($arr as $index => $value) :

                    $img = ($key == 'dir') ?  'fas fa-folder' : fm_get_file_icon_class($value['name']);
                    $typeSize = ($key == 'dir') ?  'Pasta' : fm_get_filesize($value['size']);

                    $lastDate =  date('d/m/y à\s h:m:s', $value['lastModified']);
                    $href = ($key == 'dir') ?  $this->router->route('fylesystem.pathTo', ['folder' => urlencode($value['name']), 'pathTo' => urlencode($path . $value['name'])])
                        : $this->router->route('fylesystem.openFile', ['path' => urlencode($path), 'file' => urlencode($value['name'])]);
                    $listpath[] = ['img' => $img, 'typeSize' => $typeSize, 'lastDate' => $lastDate, 'href' => $href, 'name' => $value['name']];

                endforeach;
            endforeach;
            echo $this->ajaxResponse(['message' => ['message' => 'Diretório aberto', 'type' => "success"], 'listing' => $listpath]);
        } catch (FilesystemError | UnableToRetrieveMetadata $exception) {

            echo $this->ajaxResponse(['message' => ['message' => "Erro! {$exception}", 'type' => "error"]]);
        }
    }
    public function openFile($data)
    {
        # code...
    }
}
