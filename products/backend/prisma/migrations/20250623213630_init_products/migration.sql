-- CreateTable
CREATE TABLE "Produto" (
    "id" SERIAL NOT NULL,
    "nome" VARCHAR(255) NOT NULL,
    "preco" TEXT NOT NULL,
    "estoque" INTEGER NOT NULL,
    "descricao" TEXT,
    "status" VARCHAR(50) NOT NULL DEFAULT 'ativo',
    "data_alteracao" TIMESTAMP(3) NOT NULL,

    CONSTRAINT "Produto_pkey" PRIMARY KEY ("id")
);
