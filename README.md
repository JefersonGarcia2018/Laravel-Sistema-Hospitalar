<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# Projeto desenvolvido utilizando Laravel 8 (rotas com autenticação) + Bootstrap (para layout e responsividade)

Projeto desenvolvido utilizando o framework LARAVEL 8, com implementação de rotas com autenticação. Utilizado o framework Bootstrap para layout e responsividade. Em parte do projeto, foi implementado Ajax, por meio de JavaScript, para consumo de API REST implementada no back-end.

## Funcionalidades do Sistema
- Cadastro/internação de pacientes.
- Cadastro de funcionários dos seguinte setores: RH, recepção, enfermagem e medicina.
- Possui a funcionalidade de relatórios de enfermagem.
- Possui as funcionalidades de prescrição e relatórios médicos.

## Dependências/libs/plugin utilizados

- [Bootstrap](https://getbootstrap.com/docs/5.0/getting-started/download/): versão 5.1.3
- [jQuery](https://jquery.com/download/): versão 3.6.0
- [jQuery Mask Plugin](https://igorescobar.github.io/jQuery-Mask-Plugin/)
- [pt-br-validator](https://github.com/LaravelLegends/pt-br-validator): versão 9.0

## Ambiente de desenvolvimento
Projeto implementado e rodado em ambiente de desenvolvimento local, com sistema operacional Windows e pacote XAMPP: servidor web Apche e banco de dados MySQL.

## Baixar o projeto
Primeiro passo, clonar o projeto:
``` bash
# Clonar
git clone https://github.com/JefersonGarcia2018/Laravel-Sistema-Hospitalar.git

# Acessar
cd Laravel-Sistema-Hospitalar
```

## Configuração
``` bash
# Atualizar dependências
npm install
composer install

# Configurar variáveis de ambiente
cp .env.example .env
# após executar o comando acima, crie a Base de Dados MySQL com o mome que você preferir, e atribua este nome a váriável BD_DATABASE que está contida no arquivo .env

#Agora, deve-se gerar a [ APP_KEY ] com o seguinte comando:
php artisan key:generate

# Executar migrations (tabelas e Seeders)
php artisan migrate --seed
```
# Login
O usuário/funcionário inicial, para Login, terá acesso para registrar novos funcionários para cada setor: Recepção, Medicina e Enfermagem. E a senha inícial, destes novos funcionários, é o número do CPF sem pontuação. Os funcionários podem redefinir sua senha na opção: configuração->redefinir senha
``` bash
email: analista_rh@gmail.com
senha: 12345678
```
# Vídeos do Sistema Hospitalar
- [001 - Sistema Hospitalar - Mostrando Tela inicial e fazendo Login](https://www.youtube.com/watch?v=kkkudcWr43s&list=PLziiWDFoVJ3a1AVlct3AOQ03F0SU6hlxs)
