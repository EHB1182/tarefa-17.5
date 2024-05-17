<?php
   include_once "conexao.php";
   include_once "funcoes.php";
   if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){
    $id = $_GET['id'];

   $conexaoComBanco = abrirBanco();
   $sql = "DELETE FROM pessoas WHERE id = $id";

   if ($conexaoComBanco->query($sql) === TRUE){
    echo "Contato Deletado";
   }else{
    echo "Erro ao Deletar" . $conexaoComBanco->error;
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
        <h2>Lista de contatos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>CPF</th>
                    <th>Estado Civil</th>
                    <th>Nascimento</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $conexaoComBanco = abrirBanco();
                   $sql = "SELECT * FROM pessoas";
                   $result = $conexaoComBanco->query($sql);
                   if ($result->num_rows > 0){
                    while($registro = $result->fetch_assoc()){
                        // dd($registro['id']);
                    ?>
                    <tr>
                        <td><?= $registro['id']?></td>
                        <td><?= $registro['nome']?></td>
                        <td><?= $registro['sobrenome']?></td>
                        <td><?= $registro['cpf']?></td>
                        <td><?= $registro['estado_civil']?></td>
                        <td><?= date("d/m/y", Strotime( $registro['nascimento']))?></td>
                        <td><?= $registro['endereco']?></td>
                        <td><?= $registro['telefone']?></td>
                        <td><?= $registro['email']?></td>
                        <td>
                            <a href="editar.php?id=<?=$registro['id']?>"><button>Editar</button></a>
                            <a href="?acao=deletar&id=<?= $registro['id']?>" 
                            onclick="return confirm('Tem certeza que seja excluir?')">
                            <button>Excluir</button></a>
                        </td>

                    </tr>
                    <?php
                    }
                   }else{
                    echo("<tr><td>Nenhum registro para exibir</td></tr>");

                   }
                ?>

                
            </tbody>
        </table>
    </section>
</body>
</html>