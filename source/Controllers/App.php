<?php

namespace Source\Controllers;

use Source\Models\User;


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
        $head = $this->seo->optimize(
            site("nome") . " | Gerenciador de arquivos  ",
            site("desc"),
            $this->router->route("app.filesystems"),
            routeImage("Gerenciador de arquivos"),
        )->render();
        $path = '/';
        $this->adapterInit($path);
        $listing = $this->filesystem->listContents($path);
        $listing = $this->listPathFiles($listing);


        echo $this->view->render("theme/system/filesystems/view", [
            "head" => $head,
            "path" => $path,
            "listpath" =>  $listing
        ]);
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
