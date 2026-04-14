<?php
  //cabecalho
  header("Content-Type: application/json"); //define o tipo de resposta

    $metodo = $_SERVER['REQUEST_METHOD'];

    //recupera o arquivo json na mesma pasta do projeto
    $arquivo = 'usuarios.json';

    //verifica se o arquivo existe, se não der existir cria um com array vazio
    if (!file_exists($arquivo)){
        file_put_contest($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    //le o conteudo do arquivo json
    $usuarios = json_decode(file_get_contents($arquivo),true);

    //echo "Método da requisição".$metodo;

    // conteudo
   // $usuarios = [
    //["id" => 1, "nome" => "Isadora", "email" => "isadoraribeiro2708@gmail.com"], 
    //["id" => 2, "nome" => "Miguel", "email" => "miguelbizerrasilva@gmail.com"]
    //];

    switch ($metodo) {
        case 'GET':
            //echo "aqui ações do método get";
            echo json_encode($usuarios);
            break;
        case 'POST':
            //echo "aqui ações do método post";
            $dados = json_decode(file_get_contents('php://input'), true);
            //print_r($dados);
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            //adiciona o novo usuario ao array
            array_push($usuarios, $novoUsuario);
            echo json_encode('Usuario inserido com sucesso');
            print_r($usuarios);
            break;
        default:
            echo "método não encontrado";
            break;
    }

    // converte para JSON e retorna
    //echo json_encode($usuarios);

?>