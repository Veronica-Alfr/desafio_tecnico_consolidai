import prisma from '../config/prisma';
import { ProductCreateInput, ProductUpdateInput } from '../interfaces/Product';

export default class ProductRepository {
  async findAll() {
    return (await prisma.produto.findMany()).sort((a, b) => a.id - b.id);
  };

  async findById(id: number) {
    return prisma.produto.findUnique({ where: { id } });
  };

  async create(data: ProductCreateInput) {
    return prisma.produto.create({ 
      data: { ...data, data_alteracao: new Date() }
    });
  };

  async update(id: number, data: ProductUpdateInput) {
    return prisma.produto.update({
      where: { id },
      data: { ...data, data_alteracao: new Date() }
    });
  };

  async delete(id: number) {
    return prisma.produto.delete({ where: { id } });
  };
}