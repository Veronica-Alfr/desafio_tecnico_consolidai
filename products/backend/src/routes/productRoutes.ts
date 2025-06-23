import { Router } from 'express';
import ProductController from '../controllers/ProductController';

const router = Router();
const productController = new ProductController();

router.get('/produtos', productController.getAllProducts);
router.get('/produtos/:id', productController.getProductById);
router.post('/produtos', productController.createProduct);
router.put('/produtos/:id', productController.updateProduct);
router.delete('/produtos/:id', productController.deleteProduct);

export default router;