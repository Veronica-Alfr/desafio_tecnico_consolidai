import { Form, Button, FloatingLabel, Alert, Spinner } from 'react-bootstrap';
import { useState } from 'react';
import type { IProductForm } from '../interfaces/IProduct';

export const ProductForm = ({ 
  initialData, 
  onSubmit,
  error, 
  onCancel,
  isLoading
}: IProductForm) => {
  const [formData, setFormData] = useState({
    nome: initialData?.nome || '',
    preco: initialData?.preco || '',
    estoque: initialData?.estoque || 0,
    descricao: initialData?.descricao || '',
    status: initialData?.status || 'ativo'
  });

  const [localError, setLocalError] = useState<string | null>(null);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    await onSubmit(formData);
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: name === 'preco' ? value.replace(',', '.') : value
    }));
  };

  return (
    <Form onSubmit={handleSubmit}>
      {(error || localError) && (
        <Alert variant="danger" dismissible onClose={() => {
          setLocalError(null);
          if (error) onCancel?.();
        }}>
          {error || localError}
        </Alert>
      )}

      <FloatingLabel label="Nome" className="mb-3">
        <Form.Control
          type="text"
          name="nome"
          value={formData.nome}
          onChange={handleChange}
          required
          minLength={3}
          isInvalid={!!localError && localError.includes('Nome')}
        />
      </FloatingLabel>

      <FloatingLabel label="Preço" className="mb-3">
        <Form.Control
          type="text"
          name="preco"
          value={formData.preco}
          onChange={handleChange}
          required
          pattern="^\d+(\.\d{1,2})?$"
          isInvalid={!!localError && localError.includes('Preço')}
        />
        <Form.Text>Formato: 10.99</Form.Text>
      </FloatingLabel>

      <FloatingLabel label="Estoque" className="mb-3">
        <Form.Control
          type="number"
          name="estoque"
          value={formData.estoque}
          onChange={handleChange}
          required
          min={0}
        />
      </FloatingLabel>

      <FloatingLabel label="Descrição (Opcional)" className="mb-3">
        <Form.Control
          as="textarea"
          name="descricao"
          value={formData.descricao}
          onChange={handleChange}
          style={{ height: '100px' }}
        />
      </FloatingLabel>

      <div className="d-flex justify-content-end gap-2 mt-4">
        <Button variant="outline-secondary" onClick={onCancel} disabled={isLoading}>
          Cancelar
        </Button>
        <Button variant="primary" type="submit" disabled={isLoading}>
          {isLoading ? (
            <Spinner animation="border" size="sm" />
          ) : (
            initialData?.id ? 'Atualizar' : 'Criar'
          )}
        </Button>
      </div>
    </Form>
  );
};