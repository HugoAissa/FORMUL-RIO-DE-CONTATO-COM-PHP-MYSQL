<?php
$mensagem = "Preencha os dados do formulário";
$nome = "";
$email = "";
$msg = "";

if (isset($_POST["nome"], $_POST["email"], $_POST["msg"])){    
    $nome = filter_input (INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input (INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $msg = filter_input (INPUT_POST, "msg", FILTER_SANITIZE_STRING);

    if(!$nome || !$email || !$msg){
        $mensagem = "Dados inválidos";

    }else{
        $conexao = new PDO ("mysql:host=localhost;dbname=formbd", "root", "123");

        $stm = $conexao -> prepare ('INSERT INTO contato(nome,email,msg) VALUES (:nome,:email,:msg)');
        $stm ->BindParam('nome', $nome);
        $stm ->BindParam('email', $email);
        $stm ->BindParam('msg', $msg);
        $stm ->execute();
        
        function limpar(){
            ("input").val("");
            ("textarea").val("");
        }


        $mensagem = "Mensagem Enviada com Sucesso!";

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main>
        <form method="POST">
            <label>Nome</label>
            <input type="text" name='nome' require />

            <label>Email</label>
            <input type="email" name='email' require />

            
            <label>Mensagem</label>
            <textarea name='msg'></textarea>

            <button type="submit">Enviar</button>
        </form>
        <div class="mensagem">
            <?=$mensagem?>
        </div>
    </main>
    
</body>
</html>
