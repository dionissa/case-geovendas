## Resolução de Case - Geovendas - PHP + MYSQL - Rodrigo Dionissa

## Resolução privada - Branch alternativo
Criei um branch com uma resolução alternativa pois o enunciado não deixou claro se ao fazer o update eu deveria somar a quantidade ou tornar agora como absoluta a nova quantidade que foi passada na última data. Esse branch update without adding faz exatamente isso, caso o produto já exista, ele vai sobrescrever com o último dado que foi passado e mantendo apenas essa quantidade, não somando a que já existia.

## Atualizador de Estoque
Este é um script PHP para atualizar o estoque de produtos em um banco de dados a partir de um arquivo JSON. Ele verifica se os produtos já existem no estoque e os atualiza ou adiciona novos produtos caso não existam.

## Como funciona
O script lê o conteúdo de um arquivo JSON fornecido.
Decodifica os dados JSON em um array associativo PHP.
Conecta-se ao banco de dados usando PDO.
Itera sobre os dados do estoque e verifica se cada produto já existe no banco de dados.
Se o produto existir, atualiza a quantidade disponível no estoque.
Se o produto não existir, insere um novo registro no banco de dados.
Finalmente, confirma as alterações no banco de dados.

## Requisitos
- PHP >= 5.6
- Servidor MySQL
- Extensão PDO MySQL habilitada

## Como usar
Clone o repositório ou baixe o arquivo PHP.
Certifique-se de ter um arquivo JSON com os dados do estoque no mesmo diretório.
Configure as credenciais do banco de dados no arquivo PHP.
Execute o script PHP no terminal ou no navegador.
Verifique o banco de dados para ver as atualizações no estoque.

## Exemplo de data.json para teste:
```json
[
{
"produto": "10.01.0419",
"cor": "00",
"tamanho": "P",
"deposito": "DEP1",
"data_disponibilidade": "2023-05-01",
"quantidade": 15
},
{
"produto": "11.01.0568",
"cor": "08",
"tamanho": "P",
"deposito": "DEP1",
"data_disponibilidade": "2023-05-01",
"quantidade": 2
},
{
"produto": "11.01.0568",
"cor": "08",
"tamanho": "M",
"deposito": "DEP1",
"data_disponibilidade": "2023-05-01",
"quantidade": 4
},
{
"produto": "11.01.0568",
"cor": "08",
"tamanho": "G",
"deposito": "1",
"data_disponibilidade": "2023-05-01",
"quantidade": 6
},
{
"produto": "11.01.0568",
"cor": "08",
"tamanho": "P",
"deposito": "DEP1",
"data_disponibilidade": "2023-06-01",
"quantidade": 8
}
]
``` 

## Configuração
No arquivo AtualizadorEstoque.php, você pode ajustar as consultas SQL e as credenciais do banco de dados conforme necessário.
