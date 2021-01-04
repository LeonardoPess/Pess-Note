<?php
    include('config.php');
    $url = @$_GET['url'];
    $id = @$_GET['id'];
    if(isset($_GET['deletarnote'])){
        $idDeletar = intval($_GET['deletarnote']);
        Site::deletar('tb_site.notes',$idDeletar);
    }else if(isset($_GET['deletarlista'])){
        $idDeletar = intval($_GET['deletarlista']);
        Site::deletar('tb_site.listas',$idDeletar);
        $notes = MySql::conectar()->prepare("DELETE FROM `tb_site.notes` WHERE `lista_id` = ?");
        $notes->execute(array($idDeletar));

        Site::redirect(INCLUDE_PATH);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!--// title //-->
    <title>Pess Note</title>

    <!--// meta tags //-->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--// link //-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    
    <div class="topline"></div><!--topline-->

    <div class="container">
        <header> 
            <div class="logo">
                <h1>Pess Note</h1>
            </div>
            <div class="menu__list">
                <h1><i class="fas fa-align-right"></i></h1>
            </div><!--menu__list-->

            <div class="show__list container bg_img display__none">
                <div class="shadow__black">
                    <div class="layer"></div><!--layer-->

                        <div class="content__aside">
                            <h2 class="aside__title"><i class="fas fa-clipboard"></i></h2>

                            <nav>

                            <?php
                                $listas = MySql::conectar()->prepare("SELECT * FROM `tb_site.listas`");
                                $listas->execute();
                                $listas = $listas->fetchAll();
                                foreach($listas as $key => $value){
                                    $slug = $value['slug']
                            ?>
    
                            <ul <?php selecionadoMenu($slug); ?>>
                                <li>
                                <a class="listas" href="<?php INCLUDE_PATH; echo $slug.'?id='.$value['id'] ?>">
                                    <i class="fas fa-align-left"></i> <?php echo $value['nome'] ?>
                                </a>
                                <a actionBtn="delete" class="list_delete" href="<?php echo INCLUDE_PATH.$slug ?>?deletarlista=<?php echo $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                </li>
                            </ul>

                            <?php
                                }
                            ?>

                            <div class="adicionar__categoria">
                                <form class="form_aside" method="post">

                                    <?php
                                        if(isset($_POST['addLista'])){
                                            $nome = $_POST['nome'];
                                            $slug = Site::generateSlug($nome);
                                            $sucesso = true;
                                            if($nome == '' || strlen($nome) > 12){
                                                $sucesso = false;
                                            }
                                            if($sucesso){
                                                $sql = MySql::conectar()->prepare("INSERT INTO `tb_site.listas` VALUE (null,?,?)");
                                                $sql->execute(array($nome,$slug));
                                                Site::redirect(INCLUDE_PATH);
                                            }
                                        }
                                    ?>

                                    <input type="text" minlength="1" maxlength="12" name="nome" required>
                                    <input type="submit" name="addLista" value="Adicionar Lista">
                                </form>
                            </div><!--adicionar__categoria-->

                            </nav>

                        </div><!--content__aside-->
                </div><!--shadow__black-->
            </div><!--show__list-->
        
        </header>
    </div><!--container-->

    <div class="container flex">
        
        <aside class="shadow__black bg_img">
            <div class="layer"></div><!--layer-->

                <div class="content__aside">
                    <h2 class="aside__title">LISTAS</h2>

                    <nav>

                    <?php
                        $listas = MySql::conectar()->prepare("SELECT * FROM `tb_site.listas`");
                        $listas->execute();
                        $listas = $listas->fetchAll();
                        foreach($listas as $key => $value){
                            $slug = $value['slug']
                    ?>
    
                            <ul <?php selecionadoMenu($slug); ?>>
                                <li>
                                <a class="listas" href="<?php INCLUDE_PATH; echo $slug.'?id='.$value['id'] ?>">
                                    <i class="fas fa-align-left"></i> <?php echo $value['nome'] ?>
                                </a>
                                <a actionBtn="delete" class="list_delete" href="<?php echo INCLUDE_PATH.$slug ?>?deletarlista=<?php echo $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                </li>
                            </ul>

                    <?php
                        }
                    ?>
                        
                        <div class="adicionar__categoria">
                            <form class="form_aside" method="post">

                            <?php
                                if(isset($_POST['addLista'])){
                                    $nome = $_POST['nome'];
                                    $slug = Site::generateSlug($nome);
                                    $sucesso = true;
                                    if($nome == '' || strlen($nome) > 12){
                                        $sucesso = false;
                                    }
                                    if($sucesso){
                                        $sql = MySql::conectar()->prepare("INSERT INTO `tb_site.listas` VALUE (null,?,?)");
                                        $sql->execute(array($nome,$slug));
                                        Site::redirect(INCLUDE_PATH.$slug);
                                    }
                                }
                            ?>

                                <input type="text" minlength="1" maxlength="12" name="nome" required>
                                <input type="submit" name="addLista" value="Adicionar Lista">
                            </form>
                        </div><!--adicionar__categoria-->
                    </nav>

                </div><!--content__aside-->
        </aside>

        <?php 
            if(!isset($url)){ 
            //It don't have a selected list 
        ?>

        <section>

            <div class="title__section">
                SELECIONE OU CRIE UMA LISTA!
            </div><!--title_section-->

            <div class="body__section shadow__black"></div><!--body__section-->

        </section>

        <?php 
            }else{
            //It have a selected list
        ?>

        <section>

        <?php
            $sql = MySql::conectar()->prepare("SELECT `nome` FROM `tb_site.listas` WHERE `slug` = ?");
            $sql->execute(array($url));
            $lista = $sql->fetch();
        ?>

            <div class="title__section">
                <?php echo $lista['nome'] ?>
            </div><!--title_section-->

            <div class="body__section shadow__black">

                <div class="adicionar__tarefa">
                    <form method="post">
                        <?php 
                            if(isset($_POST['addNote'])){
                                $note = $_POST['note'];
                                $sucesso = true;
                                if($note == ''){
                                    $sucesso = false;
                                }
                                if($sucesso){
                                    $sql = MySql::conectar()->prepare("INSERT INTO `tb_site.notes` VALUE (null,?,?)");
                                    $sql->execute(array($id,$note));
                                }
                            }
                        ?>
                        <textarea name="note"></textarea>
                        <input type="submit" name="addNote" value="Adicionar Anotação" required>
                    </form>
                </div>
                    
                <?php
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.notes` WHERE `lista_id` = ? ");
                    $sql->execute(array($id));
                    $note = $sql->fetchAll();
                    foreach($note as $key => $value){
                    $slug = explode('/',$_GET['url'])[0];
                ?>
                    <div class="notes">
                        <a actionBtn="delete" class="delete" href="<?php echo INCLUDE_PATH.$slug ?>?id=<?php echo $value['lista_id'] ?>&deletarnote=<?php echo $value['id'] ?>"><i class="fas fa-times"></i></a>

                        <p>" <?php echo $value['note'] ?> "</p>
                    </div><!--notes-->
                <?php } ?>

            </div><!--body__section-->

        </section>

    </div><!--container-->

    <?php } ?>

<script src="js/all.min.js"></script>
<script src="js/jquery.js"></script>
<script>
    $(function(){
        $('.menu__list h1').click(function(){
            var menu = $('.show__list')
            menu.slideToggle()
        })

        $('[actionBtn="delete"]').click(function(){
        var txt;
        var r = confirm("Deseja excluir sua anotação?");
        if(r == true)
            return true;
        else
            return false;
        });
    });
</script>
</body>
</html>