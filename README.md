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
## ✨ Instalação da Aplicação PHP + MySQL

### 📁 Rodando localmente com Apache (sem Docker)

Siga os passos abaixo para configurar e executar a aplicação localmente no seu sistema utilizando Apache, PHP 7.4 e MySQL:

---

### ⚙️ 1. Instale os pacotes necessários

No Ubuntu, execute no terminal:

```bash
sudo apt update
sudo apt install apache2 php7.4 php7.4-mysql mysql-server
```

---

### 🔢 2. Configure o banco de dados MySQL

Entre no MySQL:

```bash
sudo mysql -u root -p
```

Crie o banco de dados:

```sql
CREATE DATABASE clientes_db;
```

---

### 📂 3. Configure o projeto PHP

* Entre no diretório `clients/`:

* Copie os arquivos para o diretório raiz do Apache:

```bash
sudo cp -r . /var/www/html/clients
```

* Crie um arquivo `.env` na raiz do projeto (ao lado de `index.php`), caso não queira usar as variáveis padrões:

```
DB_HOST=localhost
DB_NAME=clientes_db
DB_USER=root
DB_PASS=password
```

---

### 🚦 4. Inicie o Apache

Caso ainda não esteja rodando:

```bash
sudo systemctl start apache2
```

---

### 🔗 5. Acesse a aplicação

Abra o navegador e acesse:

```
http://localhost/index.php
```

Pronto! A aplicação estará em funcionamento.

---

### ⚡ Dica (Rodando em Docker)

Se quiser rodar o projeto com **Docker**, basta navegar até o diretório `clients/` e executar:

```bash
docker-compose up --build
```

A aplicação será acessada em:

```
http://localhost:8000
```

OBS: com ou sem /index.php no final da URL a aplicação permanece funcionando.

## ✨ Instalação da Aplicação Express.js(node) + React


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

