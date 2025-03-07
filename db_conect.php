<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'db_empresa');

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    $CodSistema = $conn->real_escape_string($_POST['CodSistema']);
    $Descrição = $conn->real_escape_string($_POST['Descriçao']);
    $Usuario = $conn->real_escape_string($_POST['Usuario']);
    $CpfCnpj = $conn->real_escape_string($_POST['CpfCnpj']);
    $Cep = $conn->real_escape_string($_POST['Cep']);
    $Logradouro = $conn->real_escape_string($_POST['Logradouro']);
    $NumLog = $conn->real_escape_string($_POST['NumLog']);
    $Complemento = $conn->real_escape_string($_POST['Complemento']);
    $Bairro = $conn->real_escape_string($_POST['Bairro']);
    $Municipio = $conn->real_escape_string($_POST['Municipio']);
    $UF = $conn->real_escape_string($_POST['UF']);
    $DDD = $conn->real_escape_string($_POST['DDD']);
    $Telefone = $conn->real_escape_string($_POST['Telefone']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Contato = $conn->real_escape_string($_POST['Contato']);
    $Industria = $conn->real_escape_string($_POST['Industria']);
    $Comercio = $conn->real_escape_string($_POST['Comercio']);
    $Serviços = $conn->real_escape_string($_POST['Serviços']);
    $OptSimples = $conn->real_escape_string($_POST['OptSimples']);


    // Verifica se já existe um registro com o mesmo CPF ou CNPJ
    $sql_check = "SELECT * FROM TabelaEmpresa WHERE cpf = '$cpf' OR cnpj = '$cnpj'";
    $result = $conn->query($sql_check);

    if ($result && $result->num_rows > 0) {
        // Mensagem de erro
        echo "<script>
            alert('Erro: CPF ou CNPJ já cadastrado.');
            window.location.href = 'index.php';
        </script>";
    } else {
        // Insere os dados no banco
        $sql_insert = "INSERT INTO TabelaEmpresa (CodSistema,Descriçao,Usuario,CpfCnpj,cep,Logradouro,NumLog,Complemento,Bairro,Municipio,UF,DDD,Telefone,Email,Contato,Industria,Comercio,Serviços,OptSimples) 
        VALUES ('$CodSistema', '$CpfCnpj', '$Cep','$Logradouro','$NumLog','$Complemento','$Bairro','$Municipio','$UF','$DDD','$Telefone','$Email','$Contato','$Industria','$Comercio','$Serviços','$OptSimples')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }

    $conn->close();
}
?>