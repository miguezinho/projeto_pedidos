# Projeto de pedidos

Projeto de gerenciamento de cadastros de clientes e pedidos

## Tecnologias

> Para desenvolvimento desse projeto utilizei como principal ferramenta o framework Laravel 10 rodando na versão 8.3 do PHP.
> Utilizei banco de dados MYSQL onde hospedei o mesmo na AWS RDS. Caso queiram conferir o DDL das tabelas está na raiz do projeto no arquivo **ddl_projeto_pedidos.sql**.
> Para o Front-end utilizei o NPM para instalar pacotes como: AdminLTE, Vite, Jquery, etc.
> Para facilitar os testes utilizei o docker onde instalo dentro de um container todas as dependências que citei acima, além dos módulos do PHP, configurações do Apache,etc. Segue mais abaixo o passo a passo.

## Subindo o projeto

> Senhores, para testar o projeto é necessário a instalação do Docker. Recomendo utilizar a versão 4.19 do docker, pois as versões mais recentes estão instáveis.
> Para subir o servidor local será necessário entrar no diretório raiz do projeto via terminal e executar os comandos na seguinte ordem:

Cria uma imagem docker com o ambiente necessário. (Pode executar apenas a primeira vez que for testar caso queira)
```
docker build . --no-cache
```

Roda o container baseado na imagem criada anteriormente. (Executar sempre que for testar o projeto)
```
docker-compose up -d
```

Entra dentro do container depois que o mesmo está rodando para executar a geração da chave para funcionamento do laravel. (Executar apenas uma vez)
```
docker-compose exec webserver php artisan key:generate
```

Entra dentro do container depois que o mesmo está rodando e cria um link simbólico para acesso público das imagens dos pedidos. (Executar apenas uma vez)
```
docker-compose exec webserver php artisan storage:link
```

Entra dentro do container depois que o mesmo está rodando para subir o Vite e carrega as dependências de front-end na tela. (Executar sempre que for testar o projeto)
```
docker-compose exec webserver npm run dev
```

> Após a execução dos comandos acima, é só acessar http://localhost:8080 e realizar os testes do projeto.
> Observações: O projeto está configurado para rodar na porta 8080, caso essa porta do seu local esteja ocupada, é pode mudar no arquivo **docker-compose.yml**