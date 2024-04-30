<?php

class AtualizadorEstoque {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function atualizarEstoqueDoArquivo($nomeArquivo) {
        $json = file_get_contents($nomeArquivo);
        $dadosEstoque = json_decode($json, true);
        $this->atualizarEstoque($dadosEstoque);
    }

    public function atualizarEstoque(array $dadosEstoque) {
        $verificaExistencia = "SELECT quantidade, data_disponibilidade FROM estoque WHERE produto = :produto AND cor = :cor AND tamanho = :tamanho AND deposito = :deposito ORDER BY data_disponibilidade DESC LIMIT 1";
        $atualizaEstoque = "UPDATE estoque SET quantidade = :quantidade, data_disponibilidade = :data_disponibilidade WHERE produto = :produto AND cor = :cor AND tamanho = :tamanho AND deposito = :deposito";
        $insereEstoque = "INSERT INTO estoque (produto, cor, tamanho, deposito, data_disponibilidade, quantidade) VALUES (:produto, :cor, :tamanho, :deposito, :data_disponibilidade, :quantidade)";
        
        $stmtExistencia = $this->pdo->prepare($verificaExistencia);
        $stmtAtualiza = $this->pdo->prepare($atualizaEstoque);
        $stmtInsere = $this->pdo->prepare($insereEstoque);
    
        $this->pdo->beginTransaction();
    
        foreach ($dadosEstoque as $dados) {
            $stmtExistencia->execute([
                ':produto' => $dados['produto'],
                ':cor' => $dados['cor'],
                ':tamanho' => $dados['tamanho'],
                ':deposito' => $dados['deposito']
            ]);
    
            $produtoExistente = $stmtExistencia->fetch(PDO::FETCH_ASSOC);
    
            if ($produtoExistente) {
                $novaQuantidade = $dados['quantidade'];
                $dataDisponibilidade = date('Y-m-d');
                $stmtAtualiza->execute([
                    ':produto' => $dados['produto'],
                    ':cor' => $dados['cor'],
                    ':tamanho' => $dados['tamanho'],
                    ':deposito' => $dados['deposito'],
                    ':quantidade' => $novaQuantidade,
                    ':data_disponibilidade' => $dataDisponibilidade
                ]);
            } else {
                $stmtInsere->execute([
                    ':produto' => $dados['produto'],
                    ':cor' => $dados['cor'],
                    ':tamanho' => $dados['tamanho'],
                    ':deposito' => $dados['deposito'],
                    ':data_disponibilidade' => $dados['data_disponibilidade'],
                    ':quantidade' => $dados['quantidade']
                ]);
            }
        }
    
        $this->pdo->commit();
    }
    
}

$dsn = "mysql:host=geo-resolution-database-case-geo.h.aivencloud.com;port=25310;dbname=defaultdb";
$usuario = "avnadmin";
$senha = "AVNS_HLqV5j3z7uegvKzeyC4";

$pdo = new PDO($dsn, $usuario, $senha);
$atualizadorEstoque = new AtualizadorEstoque($pdo);
$arquivoDados = 'data.json';
$atualizadorEstoque->atualizarEstoqueDoArquivo($arquivoDados);

?>