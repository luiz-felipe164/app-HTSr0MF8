# API de Produtos
Cadastro e movimentação de produtos.

## Tecnologias Utilizadas
- PHP 7.4
- Laravel 8.X
- Docker
- Docker-compose
- Mysql 5.7
- Nginx

## Requerimentos
- Docker instalado na Máquina

## Instalação
- Faça o clone da aplicação e entre na raiz do projeto.
- Abra um terminal e digite o comando "docker-compose up -d" e espere o container subir.
- Verifique se deu tudo certo executando o comando "docker ps", é necessario que tenha 3 containers, um app, um mysql e um nginx.
- Acesse o container da aplicação executando o comando "docker exec -it api_products bash"
#### Execute os comandos abaixo:

```sh
cp .env.example .env
```
```sh
composer install
```
```sh
php artisan key:generate && php artisan migrate
```
```sh
php artisan optimize
```
Após isso a aplicação estará rodando em:

```sh
127.0.0.1
```

## Endpoints
### /api/product
 Method: POST
 Descrição: Cria um novo produto
 Params: 
```json
{
	"name": "product example",
	"SKU": "1",
	"quantity": 10
}
```

### /api/product
 Method: PUT
 Descrição: Edita a quantidade produto
 Params: 
```json
{
	"SKU": "1",
	"action": "add",
	"quantity": 10
}
```
> Nota: O paramêtro `action` aceita as seguintes palavras: "add" ou "remove"

### /api/history
 Method: GET
 Descrição: Retorna todas a movimentações de produtos
 
 ## Informações Adicionais
Foi implementado os padrão de projeto Injeção de Dependência e Service, o código foi implementado com o princípio de POO, e utilizando um Banco de Dados relacional.