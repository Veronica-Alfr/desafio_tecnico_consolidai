import { Request, Response, NextFunction } from 'express';
import ProductService from '../services/ProductService';
import ProductRepository from '../repositories/ProductRepository';
import { validateProductCreate, validateProductUpdate } from '../middlewares/validations/validateProduct';

const repository = new ProductRepository();
const service = new ProductService(repository);

export default class ProductController {
  async getAllProducts(_req: Request, res: Response) {
    const products = await service.getAll();
    res.json(products);
  };

  async getProductById(req: Request, res: Response) {
    try {
      const product = await service.getById(Number(req.params.id));
      res.json(product);
    } catch (error) {
      throw error;
    }
  };

  async createProduct(req: Request, res: Response) {
    const data = validateProductCreate(req.body);
    await service.create(data);
    res.status(201).json({ message: "Produto criado com sucesso!" });
  };

  async updateProduct(req: Request, res: Response) {
    const data = validateProductUpdate(req.body);
    await service.update(Number(req.params.id), data);
    res.status(201).json({ message: "Produto atualizado com sucesso!" });
  };

  async deleteProduct(req: Request, res: Response) {
    await service.delete(Number(req.params.id));
    res.status(204).send();
  }
};