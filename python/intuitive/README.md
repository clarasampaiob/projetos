## DESENVOLVIMENTO

O código foi desenvolvido em python (backend), vue.js (frontend) e MySql (banco de dados)

## WEB SCRAPING

O código se encontra no diretório scraping e executa os seguintes requisitos:

- [Acesso ao site](https://www.gov.br/ans/pt-br/acesso-a-informacao/participacao-da-sociedade/atualizacao-do-rol-de-procedimentos)

- Download dos Anexos I e II em formato PDF

- Compactação de todos os anexos em um único arquivo (formato ZIP)

## TRANSFORMAÇÃO DE DADOS

O código se encontra no diretório scraping e executa os seguintes requisitos:

- Extração dos dados da tabela Rol de Procedimentos e Eventos em Saúde do PDF do Anexo I (todas as páginas) que foram baixadas no com web scraping

- Dados salvos em uma tabela estruturada em formato csv

- Compactação do csv em um arquivo denominado "Teste_{meu_nome}.zip"

- Substituição das abreviações das colunas OD e AMB pelas descrições completas (ambulatorial e odontológico) conforme a legenda no rodapé.

## BANCO DE DADOS

O código se encontra no diretório banco_dados e executa os seguintes requisitos em SQL para banco MySql:

- [Arquivos dos últimos 2 anos deste repositório](https://dadosabertos.ans.gov.br/FTP/PDA/demonstracoes_contabeis/)

- [Dados cadastrais deste repositório](https://dadosabertos.ans.gov.br/FTP/PDA/operadoras_de_plano_de_saude_ativas/)

- Queries para estruturar tabelas necessárias para os arquivos csv

- Queries para importar o conteúdo dos arquivos preparados com o encoding correto

- Queries analíticas para consultar sobre as 10 operadoras com maiores despesas em "EVENTOS/ SINISTROS CONHECIDOS OU
AVISADOS DE ASSISTÊNCIA A SAÚDE MEDICO HOSPITALAR" no último trimestre e no último ano

## API 

O código se encontra no diretório api e vue contendo uma aplicação web desenvolvida em vue.js e python para realizar as
tarefas abaixo:

- Criação de um servidor com uma rota que realiza uma busca textual na lista de cadastros de operadoras e retorne os registros relevantes do csv de dados cadastrais das Operadoras Ativas na ANS

- Coleção elaborada no Postman para demonstrar o resultado.

## CÓDIGO AUXILIAR

- Criar ambientes python: python -m venv <nome_do_ambiente>

- Ativar ambientes pyhton: Scripts\activate

- Executar código python: python nomeArquivo.py

- Executar código vue: npm run dev
