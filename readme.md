# Sistema de Priorização de Tickets - NeoAssist - Desafio

### Rodando o projeto
-   clonar o projeto
-   composer install
-   composer update
-   cp .env.example .env
-   php artisan key:generate
-   Para iniciar o servidor local do laravel: php artisan serve

### Acessando o projeto na web
- http://127.0.0.1:8000/

### Sobre o projeto
- Possuímos um json que contem algumas informações sobre tickets abertos em alguma plataforma (reclame aqui, etc)
- Ao acessar o sistema a primeira tela encontra-se a listagem desses tickets em uma tabela, podendo visualizar detalhes do ticket desejado ao clicar no "+".

### Funcionalidades
- Listar os ticket do json
- Filtrar por qualquer campo da tabela
- Escolher quantos registros serão exibidos na tabela
- Paginação na tabela
- Acessar os detalhes de um ticket desejado

#### Rotas disponíveis
- / -> Rota default, ao acessar o sistema será listado todos os tickets
- /getjsonticket -> retorna os dados do json na tela

#### Observação
##### A lógica para classificação dos tickets encontra-se na função Priority do TicketsController.php

### Telas da aplicação
#### Inicial  
![image](https://user-images.githubusercontent.com/30474697/161440053-26cb6012-388f-4818-9d3e-61a18551509d.png)

#### Detalhes do Ticket  
![image](https://user-images.githubusercontent.com/30474697/161440026-13d3fd31-ee01-4bef-b8ee-b2fe457454c2.png)
