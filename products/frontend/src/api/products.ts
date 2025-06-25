import axios, { type AxiosResponse } from 'axios';
import type { IProduct } from '../interfaces/IProduct';
import type { AxiosApiError } from './types';

const API_URL = 'http://localhost:3000/produtos';

const api = axios.create({
  baseURL: API_URL,
  timeout: 5000,
  headers: {
    'Content-Type': 'application/json',
  },
});

const handleApiError = (error: unknown): never => {
  const axiosError = error as AxiosApiError;
  const errorMessage = axiosError.response?.data?.message || axiosError.message || 'Erro na requisição';
  console.error('Erro na API:', error);
  throw new Error(errorMessage);
};

export const getProducts = async (): Promise<IProduct[]> => {
  try {
    const response: AxiosResponse<IProduct[]> = await api.get('/');
    return response.data.filter((product: IProduct) => product.status !== 'excluido');
  } catch (error: unknown) {
    return handleApiError(error);
  }
};

export const getProductById = async (id: number): Promise<IProduct> => {
  try {
    const response: AxiosResponse<IProduct> = await api.get(`/${id}`);
    return response.data;
  } catch (error: unknown) {
    return handleApiError(error);
  }
};

export const createProduct = async (productData: Omit<IProduct, 'id'>): Promise<IProduct> => {
  try {
    const dataToSend = {
      ...productData,
      status: productData.status || 'ativo'
    };

    const response: AxiosResponse<IProduct> = await api.post('/', dataToSend);
    return response.data;
  } catch (error: unknown) {
    return handleApiError(error);
  }
};

export const updateProduct = async (id: number, productData: Partial<IProduct>): Promise<IProduct> => {
  try {
    const response: AxiosResponse<IProduct> = await api.patch(`/${id}`, productData);
    return response.data;
  } catch (error: unknown) {
    return handleApiError(error);
  }
};

export const deleteProduct = async (id: number): Promise<void> => {
  try {
    await api.patch(`/${id}`, { status: 'excluido' });
  } catch (error: unknown) {
    return handleApiError(error);
  }
};