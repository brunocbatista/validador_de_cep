# Validação de CEPs

##### Tecnologias

* Angular
* Laravel 8 (PHP 7.4)
* MongoDB

##### Instruções de uso

###### Intruções do painel web
    cd web
    npm install
    ng serve --open

###### Intruções da api
    
    cd api
    composer install
    cp .env.example .env
    php artisan serve

**Sobre o banco de dados:** No desenvolvimento utilizou-se o MongoDBCompass para maniupular a base de dados, no **.env** declaramos a conexão com o banco utilizando a string - se necessário altere a variável DB_DSN



[Clique aqui para acessar a documentação do projeto (postman)](https://documenter.getpostman.com/view/9650885/TzmCgsp4)