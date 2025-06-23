export interface Product {
  id?: number;
  nome: string;
  preco: string;
  estoque: number;
  descricao?: string | null;
  status: string;
  data_alteracao?: Date;
}

export type ProductCreateInput = Omit<Product, 'id' | 'data_alteracao'>;
export type ProductUpdateInput = Partial<ProductCreateInput>;