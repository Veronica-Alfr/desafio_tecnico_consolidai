import { Row, Col, Alert } from 'react-bootstrap';
import { ProductCard } from './ProductCard';
import type { IProductList } from '../interfaces/IProduct';

export const ProductsList = ({ products, onEdit: handleEdit, onDelete: handleDelete }: IProductList) => {
  if (products.length === 0) {
    return <Alert variant="info">Nenhum produto encontrado</Alert>;
  }

  return (
    <Row>
      {products.map((product) => (
        <Col key={product.id} md={4} className="mb-4">
          <ProductCard 
            key={product.id}
            product={product}
            onEdit={(id) => handleEdit(id)}
            onDelete={(id) => handleDelete(id)}
          />
        </Col>
      ))}
    </Row>
  );
};