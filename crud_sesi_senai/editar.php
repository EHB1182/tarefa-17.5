<?php
   include_once "conexao.php";
   include_once "funcoes.php";
   
   if(isset($_GET['id'])&& $_GET['id']>0){
   $id= $_GET['id'];

   $conexaoComBanco = abrirBanco();
   $pegarDados = $conexaoComBanco->prepare("SELECT * FROM pessoas WHERE id = ?");
   $pegarDados->bind_param("i", $id);
   $pegarDados->execute();
   $result = $pegarDados->get_result();

   if($result->num_rows ==1){
    $registro = $result->fetch_assoc();
   }
   fecharBanco($conexaoComBanco);

   }
   if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $estado_civil = $_POST['estado civil'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

   $conexaoComBanco = abrirBanco();

   $sql = "UPDATE pessoas SET nome = '$nome', sobrenome = '$sobrenome', cpf = '$cpf', 
   estado civil = '$estado_civil'= nascimento = '$nascimento', endereco = '$endereco', 
   telefone = '$telefone', email = '$email'  
   WHERE id = $id";

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
        <h2>Atualizar contato</h2>

        <form action="" method="POST">

           <label for="nome">Nome</label>
           <input type="text" name="nome" value="<?= $registro['nome']?>" required>

           <label for="sobrenome">Sobrenome</label>
           <input type="text" name="sobrenome" value="<?= $registro['sobrenome']?>" required>

           <label for="cpf">Cpf</label>
           <input type="text" name="cpf" value="<?= $registro['cpf']?>" required>

           <label for="estado_civil">Estado Civil</label>
           <input type="text" name="estado_civil" value="<?= $registro['estado_civil']?>" required>

           <label for="nascimento">Nascimento</label>
           <input type="date" name="nascimento" value="<?= $registro['nascimento']?>" required>

           <label for="endereco">Endereço</label>
           <input type="text" name="endereco" value="<?= $registro['endereco']?>" required>

           <label for="telefone">Telefone</label>
           <input type="text" name="telefone" value="<?= $registro['telefone']?>" required>

           <label for="email">Email</label>
           <input type="text" name="email" value="<?= $registro['email']?>" required>

           <input type="hidden" name="id" value="<?= $registro['id']?>">

           <button type="submit">Atualizar</button>

        </form>
    </section>
</body>
</html>