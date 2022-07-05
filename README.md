
# Visualização de sucos e ingredientes

Projeto consiste em retornar o suco com determinado cliente, customizando caso você queira ou colocar mais ingredientes ou retirar algum deles.


## Executar

Para executar esse projeto, favor rodar o comando abaixo

```bash
  git clone https://github.com/bhcosta90/test-dafiti.git && cd test-dafiti
  $ docker-compose -f docker-compose.prod.yml up -d --build
```

## Documentação da API

Lista de Sucos ${juices}
- Classic
- Forest Berry
- Freezie
- Greenie
- Vegan Delite
- Just Desserts

#### Retorna todos os itens do suco

```http
  GET http://localhost:8888/api/juice/Classic
```

#### Retorna todos os itens do suco, adicionando chocolate e morango

```http
  GET http://localhost:8888/api/juice/Classic,+chocolate,morango
```

#### Retorna todos os itens do suco, adicionando chocolate e retirando morango
```http
  GET http://localhost:8888/api/juice/Classic,+chocolate,-morango
```

#### Retorna todos os itens do suco, adicionando chocolate e retirando morango
```http
  GET http://localhost:8888/api/juice/testando
```
```
{
  "message": "testando not found"
}
```
## Desenvolvimento

Para executar esse projeto em modo desenvolvimento, executar os comandos abaixos *(Deve utilizar no mínimo PHP:8.0.2)*

```bash
  $ docker-compose up -d --build
  composer install
  cp .env.example .env
  php artisan key:generate
  $ chmod 777 -R storage/
```

## Rodando os testes

Para rodar os testes, rode o seguinte comando *(Deve utilizar no mínimo PHP:8.0.2)*

```bash
  composer install
  php artisan test
  php vendor/bin/behat
```
