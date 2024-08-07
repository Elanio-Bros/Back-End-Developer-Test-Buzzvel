# Back-End-Developer-Test-Buzzvel
## Conceitos Inciais
Esse projeto tem como ideia utilizar o framework laravel para inicar um projeto de gerenciamento de planos, utilizando-se de teste de intergração no sistema e autenticação via JWT

<details>
<summary>Sem Docker</summary>

### Primeiros Passo
Antes de colocar o projeto em ativa, primeiro deve se configurar o arquivo **.env** , esses arquivo ele é de extrema importancia para o projeto pois é nele que estão as principais configurações do sitema o arquivo [.env.example](.env.example) sevirar de base para nosso sistema. As variaveis a ser configurada nesse arquivo são

### Necessário
 - [PHP 8.0](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
 
<details>
<summary>Configurações do banco</summary>

### Configurações do banco
`DB_HOST`->url do banco de dados<br>
`DB_DATABASE`-> o banco principal<br>
`DB_PORT`->Porta utilizada no sistema de banco de dados<br>
`DB_USERNAME`->usuario do banco de dados<br>
`DB_PASSWORD`->senha do banco de dados<br>

</details>
<br>

Faça as devidas configurações no arquivo **.env** e execute alguns comandos em terminal dentro do repositório:

1. Instalação todas as dependecias do projeto
```bash
composer install
```
2. Gerar chave de encriptação da aplicação
```bash
php artisan key:generate
```
3. Gerar chave de encriptação da authenticação JWT
```bash
php artisan jwt:secret
```
4. Criar bases de dados e o segmentos iniciais
```bash
php artisan migrate --seed
```

5. Inicar um server local
```bash
php artisan serve
```

Caso queira utilizar ele em um servidor independete deve direcionar para [/public/index.php](public/index.php) para que a aplicação funcione de forma correta.

Caso queira, execute os testes para analise se está em ordem com as rotas na aplicação:
```bash
php artisan test
```
</details>

<details>
<summary>Com Docker</summary>

### Necessário
 - [Docker](https://www.docker.com/) 
 - [Docker-Compose](https://docs.docker.com/compose/)

Para começar execute os comandos :

1. Execute para poder fazer o build da imagem e inicializar os containers:
```bash
docker-compose -f "docker-compose.yml" up -d --build
```

2. Execute esse comando para uma configuração rápida da aplicação:

``` bash
docker exec -it aplication bash -c "cp .env.example .env; php artisan key:generate; php artisan jwt:secret; php artisan migrate --seed"
```
Ou Execute esses abaixo para:

3. Criar um copia do arquivo .env:
```bash
docker exec -it aplication cp .env.example .env
```
4. Gerar a chave de encriptação da aplicação:
```bash
docker exec -it aplication php artisan key:generate
```
5. Gerar chave de encriptação da authenticação JWT:
```bash
docker exec -it aplication php artisan jwt:secret
```
6. Criar bases de dados e o segmentos iniciais
```bash
docker exec -it aplication php artisan migrate --seed
```

Pronto seu sistema estára configurado para rodar de forma nativa no seu docker em [localhost](http://localhost/).

Caso queira, execute os testes para analise se está em ordem com as rotas na aplicação::
```bash
docker exec -it aplication php artisan test
```
</details>


<br>

### Endpoints
Aplicação conta com varias rotas de acesso para utlização do sistema, todas rotas autenticadas utilizam do sistema JWT descrito na documentação na rota ``/`` dos sistema. 
