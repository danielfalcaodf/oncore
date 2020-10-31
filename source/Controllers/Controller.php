<?php

namespace Source\Controllers;

use ArrayObject;
use League\Plates\Engine;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\StorageAttributes;
use League\Flysystem\FileAttributes;
use League\Flysystem\DirectoryAttributes;
use CoffeeCode\Optimizer\Optimizer;
use CoffeeCode\Router\Router;

/**
 * Controller
 */
abstract class Controller
{
    /** @var Engine */
    protected $view;
    /** @var Router */
    protected $router;
    /** @var Optimizer */
    protected $seo;
    /** @var Flysystem */
    protected $filesystem;
    public $root;


    /**
     * @param mixed $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->view = Engine::create(dirname(__DIR__, 2) . "/views", "php");
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(site("name"), site("locale"), "article");
        // ->publisher(SOCIAL["facebook_page"], SOCIAL["facebook_author"])
        // ->twitterCard(SOCIAL["twitter_creator"], SOCIAL["twitter_site"], site("domain"))
        // ->facebook(SOCIAL["facebook_appId"]);


        $this->adapterInit(ROOT_OS);
    }

    /**
     * @param array $values
     * @param string $status
     * 
     * @return string
     */
    public function ajaxResponse(array $values, int $status = 200): string
    {
        http_response_code($status);
        return json_encode($values);
    }
    public function adapterInit($root)
    {
        $this->root =  ($root == ROOT_OS) ? $root : ROOT_OS . '/' . $root;
        $adapter = new LocalFilesystemAdapter($this->root);
        $this->filesystem = new Filesystem($adapter);
    }
    public function listPathFiles($listing): array
    {
        $itens = [];


        /** @var StorageAttributes $item */
        foreach ($listing as $item) {
            $path = $item->path();

            if ($item instanceof FileAttributes) {
                // handle the file
                $itens['file'][urlencode($path)]['name'] =  $path;

                $itens['file'][urlencode($path)]['size'] =  $this->filesystem->filesize($path);
                $itens['file'][urlencode($path)]['lastModified'] =  $this->filesystem->lastModified($path);
            } elseif ($item instanceof DirectoryAttributes) {
                // handle the directory
                $itens['dir'][urlencode($path)]['name'] =  $path;
                $itens['dir'][urlencode($path)]['lastModified'] =  $this->filesystem->lastModified($path);;
            }
        }

        return $itens;
    }
}
