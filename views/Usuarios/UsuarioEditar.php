<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title> BKM Eventos</title>
</head>
<body>
<?php
    include_once __DIR__."/../Helpers/Mensagem.php"
?>
<h3>Editar Usuário</h3>
<br>

<?php foreach($data['usuarios'] as $usuario): ?>
    <form action="./Usuariocontroller.php?action=ipdate&id=<?=$usuario->getId()?>"method="POST">
    Nome completo: <input type="text" name="nome completo" value="<?=$usuario->getNome();?>">
    <br>
    E-mail: <input type="text" name="email" value="<?=$usuario->getEmail()?>" method="POST">
    <br>
    Senha: <input type="password" name="senha" value="<?=$usuario->getSenha()?>"method="POST" >
    </form>

<? endforeach;?>


</body>



</html>
