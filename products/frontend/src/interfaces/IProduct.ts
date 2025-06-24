export interface IProduct {
    id: number;
    nome: string;
    preco: string;
    estoque: number;
    descricao?: string;
    status: 'ativo' | 'inativo' | 'excluido';
}

export interface IProductCard {
    product: IProduct;
    onEdit: (id: number) => void;
    onDelete: (id: number) => void;
}

export interface IProductList {
    products: IProduct[];
    onEdit: (id: number) => void;
    onDelete: (id: number) => void;
}

export interface IProductForm {
    initialData?: Partial<IProduct>;
    onSubmit: (data: Omit<IProduct, 'id'>) => Promise<void>;
    isLoading: boolean;
    error?: string | null;
    onCancel: () => void;
}