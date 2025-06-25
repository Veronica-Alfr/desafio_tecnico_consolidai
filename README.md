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

* Crie um arquivo `.env` na raiz do projeto (ao lado de `index.php`), caso não queira usar as variáveis padrões.

Exemplo:

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
php -S localhost:8000
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

---


### ✨ Instalação da Aplicação Express.js (Node) + React

Siga os passos abaixo para configurar e executar a aplicação localmente no seu sistema Ubuntu utilizando **Node.js**, **React (Vite)** e **PostgreSQL** com **Prisma ORM**.

---

### ⚙️ 1. Instale os pacotes necessários

Certifique-se de ter as dependências instaladas:

```bash
sudo apt update
sudo apt install nodejs 
npm postgresql postgresql-contrib
```

Verifique se o `node` e `npm` estão instalados:

```bash
node -v
npm -v
```
⚠  **A versão mínima recomendada do Node.js é 18.17.0** ⚠

Se quiser usar `nvm`, você pode instalar uma versão LTS mais recente do Node(da série 22.x):

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
source ~/.bashrc

nvm install 22.11
nvm use 22.11
```

---

### 📂 2. Configure o ambiente

Crie um arquivo `.env` dentro do diretório `products/backend/` com o seguinte conteúdo:

```env
NODE_ENV=development
DATABASE_URL="prisma+postgres://localhost:51213/?api_key=..."  # Sua URL do prisma dev aqui
```

> ⬆️ A URL do `DATABASE_URL` é gerada automaticamente ao rodar `npx prisma dev`. Esse banco precisa estar ativo enquanto o backend roda.

> Por padrão as portas do prisma+postgres que ficam abertas são de 51213 à 51215.

---

### ⚙️ 3. Inicialize o banco e o backend (Node.js)

Entre no diretório `products/backend`:

```bash
cd products/backend
```

Instale as dependências:

```bash
npm install
```

Execute os comandos Prisma:

```bash
npx prisma generate
npx prisma db push   # Ou npx prisma migrate dev (caso use migrações)
```

Suba o banco com Prisma Cloud local:

```bash
npx prisma dev
```

Inicie a aplicação em modo desenvolvimento:

```bash
npm run dev
```

---

### 🎨 4. Inicie o Frontend (React + Vite)

Entre no diretório `products/frontend`:

```bash
cd products/frontend
```

Instale as dependências:

```bash
npm install
```

Rode a aplicação:

```bash
npm run dev
```

Acesse no navegador: [http://localhost:5173](http://localhost:5173)

---

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

### 🚀 Utilização da aplicação Node + React

**CRUD completo de produtos**:

  * Criar produtos
  * Editar produtos
  * Visualizar todos os produtos ativos
  * Excluir produtos logicamente (status = "excluido")
  * A aplicação React se comunica com a API Node.js usando **Axios**.
  * A listagem é responsiva e adaptada para diferentes tamanhos de tela.

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


###  💡 Funcionamento Backend (Node.js + Express + Prisma)

- API RESTful criada com **Express.js**
- Banco de dados PostgreSQL com **Prisma ORM**
- Arquitetura MVC desacoplada com:
  - Controllers: tratam as requisições e respostas HTTP
  - Services: contêm a lógica de negócio
  - Repositories: fazem a interação com o Prisma
- Middleware para tratamento de erros centralizado (`errorMiddleware.ts`)
- Validações de entrada com **Joi** (`validateProduct.ts`)

Endpoints REST principais:

```http
GET    /produtos         # Lista todos os produtos ativos
GET    /produtos/:id     # Detalha um produto
POST   /produtos         # Cria um novo produto
PUT    /produtos/:id     # Atualiza dados de um produto
DELETE /produtos/:id     # Remove logicamente (status = "excluido")
```

---

### 📦 Estrutura esperada no banco de dados (tabela `produtos`)

| Campo           | Tipo      | Observação                 |
| --------------- | --------- | -------------------------- |
| id              | int       | Chave primária             |
| nome            | string    | Nome do produto            |
| preco           | decimal   | Preço unitário             |
| estoque         | int       | Quantidade em estoque      |
| descricao       | string    | Descrição do produto       |
| status          | enum      | ativo / inativo / excluido |
| data\_alteracao | timestamp | Atualizado automaticamente |

---

### 💾 Considerações

- Certifique-se de que o Prisma Cloud (ou o banco local) está ativo ao rodar a aplicação
- Para resetar o banco: `npx prisma migrate reset`
- Para explorar os dados: `npx prisma studio`

---

### ⚙️ Funcionamento do Frontend (React + Vite)

A aplicação frontend é uma **SPA (Single Page Application)** desenvolvida com **React** e empacotada com **Vite**, focada no consumo de uma API REST e em uma interface responsiva e intuitiva.

#### 🔍 Estrutura da aplicação

```
frontend/
├── src/
│   ├── api/             # Requisições HTTP (ex: getProducts, createProduct...)
│   ├── components/      # Componentes reutilizáveis da interface
│   │   ├── ProductCard.tsx
│   │   ├── ProductForm.tsx
│   │   └── ProductsList.tsx
│   ├── hooks/           # Hooks customizados (ex: useProducts)
│   ├── interfaces/      # Interfaces TypeScript (ex: IProduct)
│   ├── pages/           # Páginas principais (ex: ProductsPage.tsx)
│   ├── App.tsx          # Componente raiz da aplicação
│   ├── main.tsx         # Ponto de entrada da aplicação React
│   └── vite-env.d.ts    # Declarações de tipos para o Vite
```

#### 💡 Como funciona

* `App.tsx`: define a estrutura geral e contém a rota.
* `main.tsx`: monta o componente `App` na DOM no elemento `#root`.
* `ProductsPage.tsx`: página principal que carrega e exibe a lista de produtos.
* `useProducts.ts`: hook central que gerencia o estado e operações (CRUD) de produtos.
* `ProductForm.tsx`: componente com formulário para criar ou editar produtos.
* `ProductCard.tsx`: cartão individual com informações de cada produto.
* `ProductsList.tsx`: renderiza a lista completa dos produtos ativos.
* `IProduct.ts`: define a interface do objeto Produto, com campos como `id`, `nome`, `preco`, etc.

#### 💡 Comportamentos principais

* Consome os endpoints do backend via `axios` (ou `fetch`).
* Faz validações de entrada no frontend antes de enviar os dados.
* Atualiza dinamicamente a interface com base nas operações realizadas (ex: exclusão, edição).
* Produtos com status `"excluido"` não são listados na interface.
* Interfaces responsivas com foco em usabilidade e feedback visual.

#### ⚡ Vite

* Utiliza **Vite** como empacotador para:

  * Recarga instantânea (Hot Module Replacement)
  * Compilação rápida
  * Suporte nativo a Módulos ES

#### 🔢 TypeScript

* Todos os componentes e hooks são escritos com **TypeScript**, garantindo maior robustez no desenvolvimento e detecção precoce de erros.

---

Essa arquitetura facilita a manutenção e expansão do frontend, permitindo trabalhar com uma base modular, clara e tipada. A comunicação com o backend ocorre de forma limpa e escalável.
