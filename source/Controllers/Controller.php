<?php

namespace Source\Controllers;

use League\Plates\Engine;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
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


    /**
     * @param mixed $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->view = Engine::create(dirname(__DIR__, 2) . "/views", "php");
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(site("name"), site("locale"), "article")
            ->publisher(SOCIAL["facebook_page"], SOCIAL["facebook_author"])
            ->twitterCard(SOCIAL["twitter_creator"], SOCIAL["twitter_site"], site("domain"))
            ->facebook(SOCIAL["facebook_appId"]);



        $adapter = new LocalFilesystemAdapter("C:\\xampp");
        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @param string $param
     * @param array $values
     * 
     * @return string
     */
    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}