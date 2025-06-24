import { useState } from 'react';
import { Container, Row, Col, Button, Modal, Alert } from 'react-bootstrap';
import { useProducts } from '../hooks/useProducts';
import { ProductsList } from '../components/ProductsList';
import { ProductForm } from '../components/ProductForm';
import type { IProduct } from '../interfaces/IProduct';

export const ProductsPage = () => {
  const { products, error, isLoading, handleCreate, handleEdit, handleDelete, clearError } = useProducts();
  const [showCreateModal, setShowCreateModal] = useState(false);
  const [editingProduct, setEditingProduct] = useState<IProduct | null>(null);

  const startEdit = (id: number) => {
    const product = products.find(p => p.id === id);
    if (product) {
      setEditingProduct(product);
      setShowCreateModal(true);
    }
  };

  const handleFormSubmit = async (formData: Omit<IProduct, 'id'>) => {
    let success = false;
    if (editingProduct) {
      success = await handleEdit(editingProduct.id, formData);
    } else {
      success = await handleCreate(formData);
    }

    if (success) {
      setShowCreateModal(false);
      setEditingProduct(null);
    }
  };


  return (
    <Container className="py-4">
      <Row className="mb-4 align-items-center">
        <Col>
          <h1>Produtos</h1>
        </Col>
        <Col xs="auto">
          <Button 
            variant="primary" 
            onClick={() => setShowCreateModal(true)}
          >
            Novo Produto
          </Button>
        </Col>
      </Row>

      {error && (
        <Alert variant="danger" dismissible onClose={clearError}>
          {error}
        </Alert>
      )}

      <ProductsList 
        products={products}
        onEdit={startEdit}
        onDelete={handleDelete} 
      />

      <Modal show={showCreateModal} onHide={() => setShowCreateModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Criar Novo Produto</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <ProductForm
            initialData={editingProduct || undefined}
            onSubmit={handleFormSubmit}
            onCancel={() => {
              setShowCreateModal(false);
              setEditingProduct(null);
            }}
            error={error}
            isLoading={isLoading}
          />
        </Modal.Body>
      </Modal>
    </Container>
  );
};