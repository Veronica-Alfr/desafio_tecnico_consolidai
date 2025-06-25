# Desafio técnico
Pra realização desse teste o candidato deverá realizar um fork do repositório, realizar o teste inserindo os arquivos dentro do mesmo repositório e ao finalizar todo o teste deverá realizar um Pull Request para o repositório original.

Desenvolver uma aplicação web simples para gerenciar **clientes** e **produtos**, utilizando uma **API principal em Node.js**

## 📚 O que você irá construir

## 1. 📦 CRUD de Produtos (Node.js + PostgreSQL)
Desenvolver uma **API RESTful** em **Node.js + Express**, responsável por gerenciar os dados de produtos.

- Salvar os dados no banco **PostgreSQL**
- A API deve retornar os dados **do PostgreSQL**
- Endpoints obrigatórios:
  - `GET /produtos`
  - `GET /produtos/:id`
  - `POST /produtos`
  - `PUT /produtos/:id`
  - `DELETE /produtos/:id`

## 2. 👤 CRUD de Clientes (PHP 7.4 + MySQL)
Desenvolver uma Aplicação Web Simples(2 paginas: uma de listagem e outra de edição, sem necessidade de login), utilizando PHP e uma estrutura básica em MVC (sem a utilização de frameworks para o backend). A aplicação deve exibir uma listagem de registros de **CLIENTES**, em formato de “table”, onde cada um destes, poderão sofrer todas as operações básicas de CRUD, **UTILIZAR O BANCO MYSQL**.

O layout da aplicação deverá ser responsivo / adaptativo e utilizar o Boostrap para tal. Deve ser utilizado AJAX nas operações de CRUD utilizando jQuery.

- 📄 Página 1: Listagem de clientes (com filtro e tabela responsiva) - adicionar uma coluna para excluir o cliente e outra coluna  editar o cliente
- 📄 Página 2: Edição de clientes
- Não mostrar clientes excluidos 

## 3. 💻 SPA em React
Implemente uma SPA moderna em React, que:
- Consuma os endpoints de produtos da **API Node.js**
- Faça CRUD completo de produtos
- Utilize Axios ou fetch
- O layout da aplicação deverá ser responsivo / adaptativo
- Não mostrar produtos excluidos
  
## 4. Estrutura básica das tabelas
### produtos (PostgreSQL)
- id
- nome
- preco
- estoque
- descricao
- status  (ativo, inativo, excluido)
- data_alteracao

### clientes (MYSQL)
- id
- nome
- cpf
- email
- status (ativo, inativo, excluido)
- data_alteracao

**Para o teste ser válido, o candidato deverá preencher toda a documentação básica dentro deste mesmo arquivo README.md informando todos os tópicos necessários pra ser executado no ambiente do testador.**

Em casos de problema de execução do ambiente do avaliador, o teste poderá ser desconsiderado.

# Requisitos

1. PHP 7.4;
2. MySQL >= 5.6;
3. Jquery
4. Bootstrap.
5. Git / Github.
6. NodeJs
7. Express
8. React

## Instalação
### ✨ Instalação da Aplicação PHP + MySQL

### 📁 Rodando localmente com Apache (sem Docker)

Siga os passos abaixo para configurar e executar a aplicação localmente no seu sistema Ubuntu utilizando PHP 7.4, MySQL, Apache ou Docker:

---

### ⚙️ 1. Instale os pacotes necessários

No Ubuntu, execute no terminal:

```bash
sudo apt update
sudo apt install php7.4 php7.4-mysql mysql-server
```

---

### 📂 2. Configure o projeto PHP para rodar localmente

* Crie um arquivo `.env` na raiz do projeto (ao lado de `index.php`), caso não queira usar as variáveis padrões:

```
DB_HOST=localhost
DB_NAME=clientes_db
DB_USER=root
DB_PASS=password
```

---

### 3. Veja se o MySQL está rodando:

* Veja se está rodando, se não incie-o e deixei enable caso não esteja:

```bash
sudo systemctl status mysql
sudo systemctl start mysql
sudo systemctl enable mysql
```

---

### 4. Rodando a aplicação com comando simples no terminal

* Entre no diretório `clients/`, e rode o comando

```bash
sudo php -S localhost:8000
```
Agora só acessar no navegador:

```
http://localhost:8000
```

### 5. Rodando no Apache

* Rode o comando:
```bash
sudo apt install apache2
```

* Entre no diretório `clients/`:

* Copie os arquivos para o diretório raiz do Apache:

```bash
sudo cp -r . /var/www/html/clients
```
* Dê permissão ao Apache para acessar os arquivos:

```bash
sudo chown -R www-data:www-data /var/www/html/clients
sudo chmod -R 755 /var/www/html/clients
```
---

Veja se está rodando:

```bash
sudo systemctl status apache2
```
Caso ainda não esteja rodando:

```bash
sudo systemctl start apache2
```
Caso não esteja enable:

```bash
sudo systemctl enable apache2
```

---

* Acesse a aplicação pelo navegador:

```
http://localhost/clients/
```

Pronto! A aplicação estará em funcionamento.

---

### 6. 🐋 Rodando com Docker

⚠ Antes de começar, seu docker-compose precisa estar na versão 2.29 e o docker na versão 27.2 de preferência.

⚠ Para subir o projeto completo, basta navegar até o diretório `clients/` e executar:

```bash
docker-compose up --build
```

- Esses serviços inicializarão o contêiner da aplicação chamado php_app e do banco de dados chamado mysql_db.

- A partir daqui, você pode executar o contêiner via CLI ou abri-los no VS Code.

ℹ️ As dependências são instaladas por meio do Dockerfile que é lido pelo Docker.

✨ Dica: A extensão Remote - Containers é recomendada para que você possa desenvolver sua aplicação no container Docker diretamente no VS Code, assim como você faz com seus arquivos locais.


* A aplicação será acessada em:

```
http://localhost:8000
```

## Utilização
### 🧑‍💻 Utilização sobre o projeto PHP + MySQL

Após a instalação (local ou via Docker) e ao acessar à URL, siga os passos abaixo:

1. **Página Inicial – Lista de Clientes**

   * Exibe todos os clientes cadastrados (exceto os marcados como "excluídos").
   * Mostra as colunas de ID, nome, CPF, e-mail, status e data de alteração.
   * Botões disponíveis:

     * ✏️ **Editar**: Redireciona para o formulário de edição.
     * 🗑️ **Excluir**: Mostra um alerta de confirmação e realiza a exclusão lógica (status alterado para `excluido`).

2. **Cadastrar Novo Cliente**

   * Clique no botão "Novo Cliente".
   * Preencha os campos obrigatórios: nome, CPF e e-mail.
   * Clique em **Salvar** para registrar o cliente.

3. **Editar Cliente Existente**

   * Clique no ícone de edição na tabela.
   * Altere os dados desejados e clique em **Atualizar**.

---

## Funcionamento
### ⚙️ Funcionamento do projeto PHP + MySQL

* O projeto utiliza **PHP 7.4** com **PDO** para conexão segura ao banco de dados MySQL.

* Estrutura do projeto:

  ```
  clients/
  ├── config/          # Configuração do banco de dados (Database.php)
  ├── controllers/     # Lógica intermediária (ClientController.php)
  ├── models/          # Lógica de acesso ao banco (ClientModel.php)
  ├── views/           # Páginas HTML com Bootstrap + JS (list.php, edit.php)
  ├── api/             # Endpoints para AJAX (create_or_update_ajax.php, delete_ajax.php, list_ajax.php)
  └── index.php        # Roteador de páginas simples
  ```

* A interface é responsiva, feita com **Bootstrap 5**.

* As ações de criação, atualização e exclusão são feitas de forma assíncrona com **jQuery AJAX**.

* Exclusão é feita por **soft delete**: o status do cliente muda para `excluido`, permitindo rastreabilidade.

* O backend cria a tabela `clientes` automaticamente se ela não existir, ao iniciar a aplicação.

