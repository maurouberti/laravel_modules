#Modulariza��o no Laravel  

###**Passo 1** - Criar um projeto *laravel*
```
composer create-project laravel/laravel {nome_projeto}
```
Entre na diret�rio do projeto que acabou de criar.

---
###**Passo 2** - Instalar *Laravel-Modules*
`nwidart/laravel-modules` � um pacote do Laravel que foi criado para gerenciar m�dulos.

---
###Instalar
Para instalar atrav�s do *composer*, execute o seguinte comando:
```
composer require nwidart/laravel-modules
```
Ser� criada a paste `vendor/nwidart`

---
###Registrar
Registre um *provedor de servi�os* e um *alias* adicionando no arquivo `config/app.php` as seguintes linhas:
```
/*
 |--------------------------------------------------------------------------
 | Autoloaded Service Providers
 |--------------------------------------------------------------------------
 |
 */
 'providers' => [
     
     /*
      * Package Service Providers...
      */
     Nwidart\Modules\LaravelModulesServiceProvider::class,
 ],


/*
 |--------------------------------------------------------------------------
 | Class Aliases
 |--------------------------------------------------------------------------
 |
 */
 'aliases' => [
     
     'Module' => Nwidart\Modules\Facades\Module::class,
 ],
```
---
###Publicar
Publique o arquivo de configura��o do pacote executando:
```
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

No arquivo `config/moduloes.php` que foi criado, altere o nomespace:
```
/*
 |--------------------------------------------------------------------------
 | Module Namespace
 |--------------------------------------------------------------------------
 |
 | Default module namespace.
 |
 */
 'namespace' => '{namespace_modulo}',
```

---
###Autoloading
Por padr�o, as classes do m�dulo n�o s�o carregadas automaticamente. Para carregar automaticamente os m�dulos altere o arquivo `composer.json`:
```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "{namespace_modulo}\\": "Modules/"
    }
},
```
Para gerar o **autoload** execute o seguinte comando:
```
composer dump-autoload
```
**Obs**.: Para listar os camandos artisan do `nwidart/laravel-modules` digite:
```
php artisan module
```

---
###**Passo 3**: Criar m�dulo
Criar m�dulo usando o comando:
```
php artisan module:make {nome_modulo}
```
Ser� criado uma pasta `Modules/{nome_modulo}`

---
###Testar
Suba o servidor
```
php artisan serve
```
Acesse o novo m�dulo pelo browser:
```
http://localhost:8000/blog
```

---
###**Passo 4**: Criar banco de dados
Crie um bando de dados:
```
echo "create database {nome_banco_dados};" | mysql -u root -p
```
Altere o arquivo **.env**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={nome_banco_dados}
DB_USERNAME={usuario_banco_dados}
DB_PASSWORD={senha_banco_dados}
```

---
###**Passo 5**: Criar migrations

Para criar uma *migration* execute o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:make-migration create_{nome_tabela}_table {none_modulo}
```
Ser� criado uma *migration* na pasta `Modules/{nome_modulo}/Database/Migrations`, altere o arquivo criado com os campos necess�rios.

Execute a *migration* com o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:migrate {nome_modulo}
```

---
###**Passo7**: Criar model
Para criar uma *model* execute o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:make-model {nome_model} {nome_modulo}
```
Ser� criado uma *model* na pasta **Modules/{nome_modulo}/Entities/{nome_model}


---
###**Passo 8**: Criar seed
Para criar uma *seed* execute o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:make-seed {nome_seed} {nome_modulo}
```
Ser� criado uma *seed* na pasta `Modules/{nome_modulo}/Database/Seeders/`, altere o arquivo criado e registre ela no arquivo`DatabaseSeeder.php` do m�dulo
```
$this->call("{nome_seed}");
```
Execute a *seed* com o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:seed {nome_modulo}
```
ou individualmente pelo comando:
```
php artisan module:seed --class={nome_seed} {nome_modulo}
```

---
###**Passo 9**: Criar controller
Para criar uma *controller* execute o camando artisan do `nwidart/laravel-modules`:
```
php artisan module:make-controller {nome_controller} {nome_modulo}
```
Ser� criado um *controller* na pasta `Modules/{nome_modulo}/Http/Controllers`

---
###**Passo 10**: Arquivo de rota
O arquivo *route* do m�dulo: 
```
Modules/{nome_modulo}/Http/routes.php
```

---
###**Passo 11**: Publicar com git
Alterar o arquivo `Modules/{nome_modulo}/composer.json` do m�dulo:
```
{
    "name": "{usuario_git}/blog",
    "description": "",
    "authors": [
        {
            "name": "{nome_autor}",
            "email": "{email_autor}"
        }
    ],
    "extra": {
        "laravel": {
            "providers": [
                "{spacename_modulo}\\{nome_modulo}\\Providers\\{service_provider}"
            ],
            "aliases": {
                
            }
        }
    },
    "autoload": {
        "psr-4": {
            "{spacename_modulo}\\{nome_modulo}\\": ""
        }
    }
}
```
Entrar no diret�rio do m�dulo `{projeto}/Modules/{nome_modulo}`, e executar o comando do *git* para inicializar o reposit�rio do git:
```
git init
```
> Execute o comando **git status**

Para adicionar arquivos, executar o comando:
```
git add .
```

Dar um *Commit* nos arquivos:
```
git commit -m "{descricao}"
```

> Talvez n�o tenha registrado as credenciais no *git*
> git config --global user.name "{nome}"
> git config --global user.email "{email}"
> git checkout -b "master"

---
Entrar na conta do github

>https://www.github.com

Criar um reposit�rio

---
Enviar os arquivos com os camandos do *git*
```
git remote add origin https://github.com/{usuario_git}/{nome_repositorio}.git
git push -u origin master
```


---
#Sequ�ncia 
Comandos:
```
composer create-project laravel/laravel projeto1
cd projeto1
composer require nwidart/laravel-modules
```

Registrar provedor de servi�o e um alias no arquivo `config/app.php` :
```
'providers' => [
    Nwidart\Modules\LaravelModulesServiceProvider::class,
],
'aliases' => [
    'Module' => Nwidart\Modules\Facades\Module::class,
],
```

Comandos:
```
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

Alterar namespace no arquivo `config/moduloes.php`:
```
'namespace' => 'Son',
```
Adicionar no arquivo `composer.json`:
```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Son\\": "Modules/"
    }
},
```
Comandos:
```
composer dump-autoload
php artisan module:make Blog
echo "create database laravel_modules;" | mysql -u root -p
```
Alterar arquivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_modules
DB_USERNAME=root
DB_PASSWORD=123456
```
Comandos:
```
php artisan module:make-migration create_posts_table Blog
php artisan module:migrate Blog
php artisan module:make-model Post Blog
php artisan module:make-seed Posts Blog
php artisan module:seed Blog
php artisan module:make-controller PostsController Blog
```
Alterar arquivo `composer.json`
```
{
    "name": "maurouberti/blog",
    "description": "",
    "authors": [
        {
            "name": "Mauro Uberti",
            "email": "mauro.uberti@gmail.com"
        }
    ],
    "extra": {
        "laravel": {
            "providers": [
                "Son\\Blog\\Providers\\BlogServiceProvider"
            ],
            "aliases": {
                
            }
        }
    },
    "autoload": {
        "psr-4": {
            "Son\\Blog\\": ""
        }
    }
}
```
Comandos:
```
cd Modules
cd Blob
git init
git add .
git commit -m "Primeiro commit"
git remote add origin https://github.com/maurouberti/laravel_modules.git
git push -u origin master

```