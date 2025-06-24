import { useEffect, useState } from 'react';
import { getProducts, deleteProduct, createProduct, updateProduct } from '../api/products';
import type { IProduct } from '../interfaces/IProduct';

export const useProducts = () => {
  const [products, setProducts] = useState<IProduct[]>([]);
  const [error, setError] = useState<string | null>(null);
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    setIsLoading(true);
    try {
      const data = await getProducts();
      setProducts(data);
      setError(null);
    }  catch (error: unknown) {
      setError(error instanceof Error ? error.message : 'Erro desconhecido');
    } finally {
      setIsLoading(false);
    }
  };

  const handleCreate = async (productData: Omit<IProduct, 'id'>) => {
    setIsLoading(true);
    try {
      await createProduct(productData);
      await fetchProducts();
      return true;
    } catch (error: unknown) {
      setError(error instanceof Error ? error.message : 'Erro ao criar produto');
      return false;
    } finally {
      setIsLoading(false);
    }
  };

  const handleEdit = async (id: number, productData: Partial<IProduct>) => {
    setIsLoading(true);
    try {
      await updateProduct(id, productData);
      await fetchProducts();
      return true;
    } catch (error: unknown) {
      setError(error instanceof Error ? error.message : 'Erro ao editar produto');
      return false;
    } finally {
      setIsLoading(false);
    }
  };

  const handleDelete = async (id: number) => {
    setIsLoading(true);
    try {
      await deleteProduct(id);
      await fetchProducts();
    } catch (err) {
      setError('Erro ao excluir produto');
    } finally {
      setIsLoading(false);
    }
  };

  return { 
    products, 
    error,
    isLoading,
    handleCreate,
    handleEdit,
    handleDelete,
    clearError: () => setError(null)
  };
};