<?php

    require_once '../php/Conexao.php';
    require '../php/DataHoraAtual.php';


    $solucao = $_POST['solucao'];
    $andamento = $_POST['andamento'];
    $status = $_POST['status'];
    
    $ch = $_POST['ch'];

    echo $ch;



    //echo $dateTime;
    // BUSCAR NO BANCO OK
    // $sql = "SELECT * FROM chamadosset WHERE NomeUsuario = 'anderson' AND Mensagem = 'TESTE'";
    // $result = mysqli_query($conexao, $sql);
    // while ($row = mysqli_fetch_assoc($result))
    // {
    //     echo	'<tr>';
    //     echo	'<td>'. $row["NomeUsuario"]. '</td>';
    //     echo	'<td width = "30px">'. $row["Mensagem"]. '</td>';
    //     echo	'<td>'. $row["Tipo"]. '</td>';
    //     echo	'</tr>';
    // }
    // $totalRegistros = mysqli_num_rows ($result);

    //ATRIBUIR AO BANCO OK
    if(isset($status) && $status !="")
    {
        // ATUALIZA O STATUS DEFINIDO
        $sql1 = "UPDATE chamadosset SET Status = '$status' WHERE NumeroChamado = $ch";
        $result1 = mysqli_query($conexao, $sql1);
    }

    if($status == "Em andamento")
    {
        // DEFINE A HORA DO ANDAMENTO
        $sql2 = "UPDATE chamadosset SET DataAndamento = '$dateTime' WHERE NumeroChamado = $ch";
        $result2 = mysqli_query($conexao, $sql2);
    }
    if($status == "Fechado")
    {
        // DEFINE A HORA DO FECHAMENTO
        $sql3 = "UPDATE chamadosset SET DataFechamento = '$dateTime' WHERE NumeroChamado = $ch";
        $result3 = mysqli_query($conexao, $sql3);
    }

    
    // DEFINE A HORA DA ULTIMA MODIFICAÇÃO
    $sql4 = "UPDATE chamadosset SET UltimaModificacao = '$dateTime' WHERE NumeroChamado = $ch";
    $result4 = mysqli_query($conexao, $sql4);
    
    // INSERE A NOVO ANDAMENTO NO BANCO
    if($andamento != "")
    {
        $sql5 = "UPDATE chamadosset SET Andamento = '$andamento' WHERE NumeroChamado = $ch";
        $result5 = mysqli_query($conexao, $sql5);
    }

    // INSERE A NOVA SOLUCAO NO BANCO
    if($solucao != "")
    {
        $sql = "UPDATE chamadosset SET Solucao = '$solucao' WHERE NumeroChamado = $ch";
        $result = mysqli_query($conexao, $sql);
    }
    
    //INSERE NO BANCO E VERIFICA SE INSERIU
    if ($result5 || $result || $result1 && $result5 || $result1 && $result || $result1 && $result && $result5 || $result1) 
    {
        echo"<script language='javascript' type='text/javascript'>alert('Salvo com sucesso');window.location.href='FiltrarChamadosEdita.php';</script>";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexao);
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conexao);
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conexao);
        echo "Error: " . $sql3 . "<br>" . mysqli_error($conexao);
        echo "Error: " . $sql4 . "<br>" . mysqli_error($conexao);
        echo "Error: " . $sql5 . "<br>" . mysqli_error($conexao);
        echo"<script language='javascript' type='text/javascript'>alert('FALHA, SEUS DADOS NÃO FORAM SALVOS.');window.location.href='EditarChamados.php';</script>";
    }
    



    //FECHA CONEXÃO COM O BANCO
    mysqli_close($conexao);


?>