# Star Wars API Catalog

Este projeto é um catálogo web que utiliza a API do Star Wars (https://swapi.dev/) para exibir informações sobre filmes, personagens, naves espaciais e planetas. O projeto foi desenvolvido usando PHP (sem frameworks), MySQL, JavaScript, HTML e CSS.

## Features

*   **Catálogo de Filmes:**
    *   Listagem de todos os filmes ordenados por data de lançamento.
    *   Barra de pesquisa para filtrar os filmes.
    *   Exibição detalhada de cada filme (título, número do episódio, sinopse, data de lançamento, diretor, produtores, personagens e idade).
*   **Catálogo de Pessoas, Naves Espaciais e Planetas:**
    *   Listagem de pessoas, naves espaciais e planetas.
    *   Barra de pesquisa para filtrar os itens.
    *   Exibição detalhada de cada item.
*   **Logs de Requisições:**
    *   Registro de todas as requisições feitas à API do projeto no banco de dados.
    *   Visualização dos logs em uma página específica (data, hora, requisição e mensagem).
*   **API:**
    *   API própria para consumir a API do Star Wars.
    *   Endpoints distintos para cada tipo de requisição.
    *   Cálculo da idade dos filmes no backend.
*   **Arquitetura:**
    *   Estrutura MVC adaptada.
    *   Programação Orientada a Objetos.
    *   Utilização de JQuery e Bootstrap no frontend.

## Instruções de Instalação

1.  **Requisitos:**
    *   XAMPP instalado com PHP 7.4 ou superior e MySQL.
    *   Sistema Operacional: Windows, Linux ou macOS.
    *   Conexão com a Internet para consumir a API do Star Wars.
2. **Baixe o XAMPP**
    *   Acesse o site oficial do XAMPP: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
    *   Baixe a versão mais recente do XAMPP que inclua o PHP 8.x e o MySQL.
3.  **Instalação do XAMPP:**
    *   Execute o instalador do XAMPP que você baixou.
    *   Siga os passos do assistente de instalação.
    *   Durante a instalação, você pode selecionar os componentes que deseja instalar (Apache, MySQL, PHP, etc.). É recomendado deixar todas as opções padrão selecionadas.
    *   Escolha o diretório de instalação do XAMPP. O padrão é `C:\xampp`.
   4. **Configuração da Porta:**
      *   **Edite o arquivo `httpd.conf`:**
          *  Abra o arquivo `C:\xampp\apache\conf\httpd.conf`.
          *   Procure pela linha `Listen 80` e altere para `Listen 9000`.
          *   Procure pela linha `ServerName localhost:80` e altere para `ServerName localhost:9000`.
          *   Salve as alterações.
   5. **Configuração do `DocumentRoot`:**
      *   **Edite o arquivo `httpd.conf`:**
           *   Abra o arquivo `C:\xampp\apache\conf\httpd.conf`.
           *   Procure pela linha `DocumentRoot "C:/xampp/htdocs"`
           *   Altere o caminho para `DocumentRoot "C:/Users/seu_usuario/Documents/Github/swapi-app/public"`. (Substitua `C:/Users/seu_usuario/Documents/Github/swapi-app/public` pelo caminho **completo** da pasta `public` do seu projeto).
           *   Procure pelo bloco `<Directory "C:/xampp/htdocs">` e altere o caminho para `<Directory "C:/Users/seu_usuario/Documents/Github/swapi-app/public">`.
           *   Salve as alterações.
      *   **Observação:** Certifique-se que todos os arquivos do seu projeto, incluindo a pasta `public`, estão localizados no caminho indicado no `DocumentRoot`.
4.  **Importe o Projeto:**
    *   Coloque todos os arquivos do projeto na pasta `public` (ou na pasta configurada no `DocumentRoot`) do seu servidor XAMPP.
    *    Caso não tenha alterado o `DocumentRoot` do seu apache, coloque a pasta `swapi-app` na pasta `htdocs` do xampp (geralmente em `C:\xampp\htdocs`).
5.  **Configuração do Banco de Dados:**
    *  **Abra o Prompt de Comando (CMD):**
        *  Abra o prompt de comando como administrador.
    *  **Acesse o MySQL:**
        *  Digite `cd C:\xampp\mysql\bin` e pressione Enter para navegar até a pasta onde está o executável do MySQL.
        *  Digite `mysql -u root` e pressione Enter para acessar o MySQL como usuário root (sem senha).
    *  **Crie o Banco de Dados:**
        *  Digite `CREATE DATABASE testes_gerais;` e pressione Enter para criar um banco de dados chamado `testes_gerais`.
    *  **Use o Banco de Dados:**
        *  Digite `USE testes_gerais;` e pressione Enter para selecionar o banco de dados `testes_gerais`.
    *  **Crie a Tabela `logs`:**
        *  Digite o seguinte comando e pressione Enter para criar a tabela `logs`:

            ```sql
            CREATE TABLE logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                date_time DATETIME NOT NULL,
                request VARCHAR(255) NOT NULL,
                message TEXT
            );
            ```
    *  **Saia do MySQL:**
        *  Digite `exit` e pressione Enter para sair do MySQL.
6.  **Configure o arquivo `config/config.php`:**
    *   Abra o arquivo `config/config.php`.
    *   Defina as configurações do banco de dados (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) com as suas credenciais.
    *   A constante `API_URL` deve apontar para a API do Star Wars (ex: `https://swapi.dev/api/`).
    *   A constante `BASE_URL` deve apontar para a URL base do seu projeto (ex: `http://localhost/` para localhost com porta 80).
7. **Configure o Arquivo `.htaccess`**
    * Certifique-se que o arquivo `.htaccess` está presente na pasta `public` e que ele tem a configuração correta:
    ```apache
      RewriteEngine On
      RewriteBase /

    # Redireciona requisições que começam com /api para api/index.php
      RewriteCond %{REQUEST_URI} ^/api/(.*)$
      RewriteRule ^(.*)$ api/index.php/$1 [L]

    # Redireciona todas as outras requisições para index.php
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule ^(.*)$ index.php/$1 [L]
    ```

## Documentação da API

A API do projeto está disponível através da pasta `/api` e possui os seguintes endpoints:

*   **Listagem:**
    *   `GET /api/films`: Retorna uma lista de filmes (em formato JSON).
    *   `GET /api/people`: Retorna uma lista de pessoas (em formato JSON).
    *   `GET /api/starships`: Retorna uma lista de naves espaciais (em formato JSON).
    *  `GET /api/planets`: Retorna uma lista de planetas (em formato JSON).
*   **Detalhes:**
    *   `GET /api/films/details/{id}`: Retorna os detalhes de um filme específico (em formato JSON).
    *   `GET /api/people/details/{id}`: Retorna os detalhes de uma pessoa específica (em formato JSON).

## Como Utilizar a Aplicação

1.  **Inicie o XAMPP:**
    *   Abra o painel de controle do XAMPP.
    *   Clique em "Start" ao lado de "Apache" e "MySQL".
2.  **Acesse a Aplicação no Navegador:**
    *   Abra seu navegador e digite `http://localhost:9000/` (se você configurou a porta do Apache para 9000) ou `http://localhost/` (se estiver usando a porta padrão 80).
    *   Você deverá ver a página inicial com o catálogo de filmes.
3.  **Navegue pelo Catálogo:**
    *   Use a barra de pesquisa para filtrar os filmes.
    *   Clique em um filme para ver os detalhes.
    *   Use os links para acessar as páginas de pessoas, naves espaciais, planetas e logs.

## Melhorias Aplicadas

*   Implementação completa de acordo com os requisitos.
*   Estrutura MVC adaptada para melhor organização do código.
*   Logs de requisições no banco de dados.
*   Cálculo da idade dos filmes no backend.
*   Rotas para a API.
*   Layout responsivo usando bootstrap.
*   Página inicial com barra de pesquisa.
*   Página para visualização dos logs.
*   Separação das rotas do frontend e do backend.

## Observações

*   Este projeto foi desenvolvido sem o uso de frameworks PHP.
*   É necessário ter uma conexão ativa com a internet para consumir a API do Star Wars.
*   A porta padrão do Apache é 80, mas você pode configurá-lo para usar a porta 9000.
*   Certifique-se de que todas as configurações de caminhos, portas e arquivos sejam idênticas ao seu ambiente.

Se você tiver alguma dúvida ou problema ao instalar e rodar este projeto, consulte os logs do Apache e do MySQL, ou entre em contato para que eu possa te ajudar.