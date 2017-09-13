# BitCoin SDK 

## Construido com:

* [PHP](https://secure.php.net/)
* [MySQL](https://www.mysql.com/)

## Por que php?

Optei pela escolha pois constatei que possuia uma gama de ferramentas que facilmente poderiam 
solucionar o problema de maneira rapida e eficiente, além de ser uma das linguagens mais utilizadas
para backend de websites.

## Uso

Para utilizacao da classe Ticker responsavel por armazenar informacoes de uma API
de dados de negociações do mercado BitCoin disponibilizado pelo link 
https://www.mercadobitcoin.net/api/v2/ticker/ é necessario possuir as plataformas [php](https://secure.php.net/) e [mysql](https://www.mysql.com/) instalada no seu pc, a classe Ticker é a responsavel por processar tais informações
e se encontra no script 'bc_ticker.php'.

## Configuração

É obrigatorio a utilização de um banco de dados MySql, para armazenamento das informações
coletadas do link, para isso altere o script 'server_config.php' com o 'servername','username'
e 'password' do banco a ser utilizado.

Para realizar a população do banco de dados em tempo real basta chamar o script 'bc_populate.php'
que basicamente fara requisições no link e persistirá as informações no banco de dados a cada 60s
que é o tempo de atualização do conteudo do mesmo.

## Exemplo

O script 'example.php' possui uma exemplificação de cada um dos usos.

## Autor

* ** Jordão Rodrigues Oliveira Rosario ** - [engylemure](https://github.com/engylemure)
