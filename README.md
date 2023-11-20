
# Setup Docker Para Projetos Laravel (8, 9 ou 10)
[Assine a Academy, e Seja VIP!](https://academy.especializati.com.br)

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/DaviLNogueira/Tads.git
```

Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Especializa Ti"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acessar o projeto
[http://localhost:8989](http://localhost:8989)

## Rotas de Planos

| Rota | Método | Descrição |
|---|---|---|
| `/planos` | `GET` | Retorna uma lista de planos. |
| `/planos` | `POST` | Cria um novo plano. |
| `/planos/{id}` | `DELETE` | Exclui um plano. |
| `/planos/{id}` | `PATCH` | Edita um plano. |

## Rotas de Assinaturas

| Rota | Método | Descrição |
|---|---|---|
| `/assinatura` | `GET` | Retorna uma lista de assinaturas. |
| `/assinatura` | `POST` | Cria uma nova assinatura. |
| `/assinatura/{id}` | `PATCH` | Edita uma assinatura. |
| `/assinatura/{id}` | `GET` | Exibe uma assinatura. |
| `/assinatura/{id}` | `DELETE` | Exclui uma assinatura. |
