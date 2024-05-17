<?php
   include_once "conexao.php";


   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //echo "Tem algo que foi enviado pelo formulario";
      //echo"<pre>";
      //print_r ($_POST);
      //echo "</pre>";

      $nome = $_POST['nome'];
      $sobrenome = $_POST['sobrenome'];
      $cpf = $_POST['cpf'];
      $estado_civil = $_POST['estado_civil'];
      $nascimento = $_POST['nascimento'];
      $endereco = $_POST['endereco'];
      $telefone = $_POST['telefone'];
      $email = $_POST['email'];

     $conexaoComBanco = abrirBanco();

     $sql = "insert into pessoas (nome, sobrenome, cpf, estado_civil, nascimento, endereco, telefone, email) 
     values ('$nome', '$sobrenome', '$cpf', '$estado_civil', '$nascimento', '$endereco', '$telefone', '$email')";

     if($conexaoComBanco->query($sql) === TRUE){
        echo ":) Contato salvo com sucessso no banco de dados :)";
     } else {
        echo ":( Erro ao salvar no banco de dados: " . $conexaoComBanco->error;
     }

     fecharBanco($conexaoComBanco);
   }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoas</title>
   <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Agenda de Contatos</h1>
        <nav>
            <ul>
                <li> <a href="index.php">Home</a></li>
                <li> <a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Cadastro de pessoas</h2>

        <form action="cadastrar.php" method="POST">

           <label for="nome">Nome</label>
           <input type="text" name="nome" required>

           <label for="sobrenome">Sobrenome</label>
           <input type="text" name="sobrenome" required>

           <label for="cpf">Cpf</label>
           <input type="text" name="cpf" required>

           <label for="estado_civil">Estado Civil</label>
           <input type="text" name="estado_civil" required>

           <label for="nascimento">Nascimento</label>
           <input type="date" name="nascimento" required>

           <label for="endereco">Endereço</label>
           <input type="text" name="endereco" required>

           <label for="telefone">Telefone</label>
           <input type="text" name="telefone" required>

           <label for="email">Email</label>
           <input type="text" name="email" required>

           <button type="submit">Salvar</button>

        </form>
    </section>
</body>
</html>