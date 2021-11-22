<h1 align="center">
    Finanças Pessoais Back-end 
</h1>

<p align="center">
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-instalacao">Instalação</a>
  <a href="#-endpoints">Endpoints</a>
</p>

<br>

<p align="center">
  <img alt="Laravel" src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
</p>

## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/)
## 💻 Projeto

Esse projeto é finalidade de criar sistema de controle de finanças pessoais despesas e receitas. 

## 🔖 Instalação

- Git clone do projeto 
- cd financas-pessoais-back-end 
- docker-compose up -d 
- docker-compose exec app composer install 
- docker-compose exec app cp .env.example .env 
- docker-compose exec app php artisan key:generate 
- docker-compose exec app php artisan jwt:secret 
- docker-compose exec app php artisan migrate 

Acesse a API na URL http://localhost:8080/api 

## 🔖 Endpoints 

- http://localhost:8080/api/login 
- http://localhost:8080/api/register 
- http://localhost:8080/api/conta
- http://localhost:8080/api/categoria
- http://localhost:8080/api/financeiro 

---

Werley Silva
