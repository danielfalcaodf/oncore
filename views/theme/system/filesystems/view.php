<?php $v->layout("theme/_theme"); ?>
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Gerenciador de arquivos</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $router->route('app.home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Sistema</li>
                    <li class="breadcrumb-item active">Gerenciador de arquivos</li>
                </ol>
            </div>

            <div class="">
                <button
                    class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i
                        class="ti-settings text-white"></i></button>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-md-3 align-self-end">
                                <button type="button" class="btn btn-primary ">Upload</button>


                                <button type="button" class="btn btn-primary ">Novo Item</button>
                            </div>
                        </div>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#"></a>
                            <a class="breadcrumb-item" href="#"></a>
                            <span class="breadcrumb-item active"></span>
                        </nav>
                        <table id="filesystem" class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="" id="" autocomplete="off"></th>
                                    <th>Nome</th>
                                    <th>Tamanho</th>
                                    <th>Modificado</th>
                                    <th class="text-nowrap">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="filetbody">

                                <?php


                                foreach ($listpath as $key => $arr) :


                                    foreach ($arr as $index => $value) :

                                        $img = ($key == 'dir') ?  'fas fa-folder' : fm_get_file_icon_class($value['name']);
                                        $typeSize = ($key == 'dir') ?  'Pasta' : fm_get_filesize($value['size']);

                                        $lastDate =  date('d/m/y à\s h:m:s', $value['lastModified']);
                                        $href = ($key == 'dir') ?
                                            $router->route('fylesystem.pathTo', ['folder' => urlencode($value['name'])])
                                            : $router->route('fylesystem.openFile', ['path' => urlencode($path), 'file' => urlencode($value['name'])])

                                ?>

                                <tr>


                                    <td>
                                        <input type="checkbox" name="" id="" autocomplete="off">
                                    </td>

                                    <td>

                                        <div class="filename">
                                            <a name="" id="" class="btn btn-outline-gray filepath" href="<?= $href ?>"
                                                role="button">
                                                <i class="<?= $img ?>"></i>
                                                <?= $value['name'] ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $typeSize ?>
                                    </td>
                                    <td><?= $lastDate ?></td>
                                    <td class="text-nowrap">
                                        <a href="#" data-toggle="tooltip" data-original-title="Edit"
                                            aria-describedby="tooltip769723"> <i
                                                class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="tooltip" data-original-title="Close"> <i
                                                class="fas fa-times text-danger"></i> </a>
                                    </td>




                                </tr>


                                <?php endforeach;
                                endforeach ?>
                            </tbody>



                            <!-- <p> tamanho completo: 34.66 KB Arquivo: 4 Pasta: 31 Memória usada: 4 MB Tamanho
                                            da partição: 162.14 GB Livre de 465.13 GB</p> -->

                            <!-- <button type="button" class="btn btn-primary ">Novo Item</button>
                                    <button type="button" class="btn btn-primary ">Novo Item</button> -->
                            <tfoot>
                                <tr>
                                    <td class="gray" rowspan="1" colspan="1"></td>
                                    <td class="gray" colspan="4" rowspan="1">
                                        tamanho completo: <span class="badge badge-light">34.66 KB</span> Arquivo:
                                        <span class="badge badge-light">4</span> Pasta: <span
                                            class="badge badge-light">31</span> Memória usada: <span
                                            class="badge badge-light">4 MB</span> Tamanho da partição: <span
                                            class="badge badge-light">162.14 GB</span> Livre de <span
                                            class="badge badge-light">465.13 GB</span>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                        <div class="row">
                            <div class="col-12">
                                <ul class="list-inline footer-action ">
                                    <li class="list-inline-item"> <a href="#/select-all"
                                            class="btn btn-small btn-outline-primary btn-2"
                                            onclick="select_all();return false;"><i class="fa fa-check-square"></i>
                                            Selecionar tudo </a></li>
                                    <li class="list-inline-item"><a href="#/unselect-all"
                                            class="btn btn-small btn-outline-primary btn-2"
                                            onclick="unselect_all();return false;"><i class="fa fa-window-close"></i>
                                            Desmarcar tudo </a></li>
                                    <li class="list-inline-item"><a href="#/invert-all"
                                            class="btn btn-small btn-outline-primary btn-2"
                                            onclick="invert_all();return false;"><i class="fa fa-th-list"></i>
                                            Seleção reversa </a></li>
                                    <li class="list-inline-item">

                                        <a href="javascript:document.getElementById('a-delete').click();"
                                            class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-trash"></i>
                                            Excluir </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:document.getElementById('a-zip').click();"
                                            class="btn btn-small btn-outline-primary btn-2"><i
                                                class="fa fa-file-archive-o"></i>
                                            Zip </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:document.getElementById('a-tar').click();"
                                            class="btn btn-small btn-outline-primary btn-2"><i
                                                class="fa fa-file-archive-o"></i>
                                            Tar </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:document.getElementById('a-copy').click();"
                                            class="btn btn-small btn-outline-primary btn-2"><i
                                                class="fa fa-files-o"></i>
                                            Copiar </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

        <?php $v->start("scripts"); ?>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

        <script src="<?= asset("js/filesystems/custom.js") ?>"></script>


        <?php $v->end(); ?>