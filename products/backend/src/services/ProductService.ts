import ProductRepository from '../repositories/ProductRepository';
import { Product, ProductCreateInput, ProductUpdateInput } from '../interfaces/Product';

export default class ProductService {
  constructor(private repository: ProductRepository) {}

  async getAll(): Promise<Product[]> {
    return this.repository.findAll();
  }

  async getById(id: number): Promise<Product> {
    const product = await this.repository.findById(id);
    if (!product) {
      const error = new Error('Produto não encontrado');
      error.name = 'NotFound';
      throw error;
    }
    return product;
  }

  async create(data: ProductCreateInput): Promise<Product> {
    return this.repository.create(data);
  }

  async update(id: number, data: ProductUpdateInput): Promise<Product> {
    await this.getById(id);
    return this.repository.update(id, data);
  }

  async delete(id: number): Promise<void> {
    await this.getById(id);
    await this.repository.delete(id);
  }
}