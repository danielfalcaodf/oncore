<?php

namespace Source\Controllers;

use Source\Models\User;
use League\Flysystem\StorageAttributes;

/**
 * [Description App]
 */
/**
 * App
 */
class App extends Controller
{
    /** @var User */
    protected $user;
    public function __construct($router)
    {

        parent::__construct($router);
        // if (empty($_SESSION['user']) || !$this->user = (new User())->findById($_SESSION["user"])) {
        //     unset($_SESSION['user']);
        //     flash("error", "Acesso negado. Favor logue-se");
        //     $this->router->redirect("web.login");
        // }
    }
    /**
     * @return void
     */
    public function home(): void
    {
        // $this->user->first_name
        $head = $this->seo->optimize(
            "Bem-vindo(a) Dashboard  | " . site("nome"),
            site("desc"),
            $this->router->route("app.home"),
            routeImage("Conta de TESTE"),
        )->render();
        echo $this->view->render("theme/dashboard", [
            "head" => $head,
            "user" => $this->user
        ]);
    }
    public function filesystems(): void
    {
        // $this->user->first_name
        $listing =
            $this->filesystem->listContents('/');

        $head = $this->seo->optimize(
            "Gerenciador de arquivos | " . site("nome"),
            site("desc"),
            $this->router->route("app.filesystems"),
            routeImage("Gerenciador de arquivos"),
        )->render();

        // echo $this->view->render("theme/system/filesystems/view", [
        //     "head" => $head,
        //     "user" => $this->user
        // ]);

        /** @var StorageAttributes $item */
        foreach ($listing as $item) {
            $path = $item->path();

            if ($item instanceof \League\Flysystem\FileAttributes) {
                // handle the file
                echo  $path . '<br>';
            } elseif ($item instanceof \League\Flysystem\DirectoryAttributes) {
                // handle the directory
                echo  $path . '<br>';
            }
        }
    }
    public function login(): void
    {
        // $this->user->first_name
        $head = $this->seo->optimize(
            "Faça seu login para continuar | | " . site("nome"),
            site("desc"),
            $this->router->route("app.login"),
            routeImage("Conta de TESTE"),
        )->render();
        echo $this->view->render("theme/login", [
            "head" => $head,
            "user" => $this->user
        ]);
    }
    /**
     * @return void
     */
    public function logoff(): void
    {
        unset($_SESSION['user']);
        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect('web.login');
    }
}