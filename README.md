
# Visualização de sucos e ingredientes

Projeto consiste em retornar o suco com determinado cliente, customizando caso você queira ou colocar mais ingredientes ou retirar algum deles.


## Executar

Para executar esse projeto, favor rodar o comando abaixo

```bash
  git clone https://github.com/bhcosta90/test-dafiti.git && cd test-dafiti
  $ docker-compose -f docker-compose.prod.yml up -d --build
```

## Desenvolvimento (Deve utilizar no mínimo PHP:^8.0)

Para executar esse projeto em modo desenvolvimento, executar os comandos abaixos

```bash
  $ docker-compose up -d --build
  composer install
  cp .env.example .env
  php artisan key:generate
  $ chmod 777 -R storage/
```


## Documentação da API

#### Retorna todos os itens do suco

```http
  GET http://localhost:8888/api/juice/${juice}
```

#### Retorna todos os itens do suco, adicionando chocolate e morango

```http
  GET http://localhost:8888/api/juice/${juice},+chocolate,morango
```

#### Retorna todos os itens do suco, adicionando chocolate e retirando morango
```http
  GET http://localhost:8888/api/juice/${juice},+chocolate,-morango
```
