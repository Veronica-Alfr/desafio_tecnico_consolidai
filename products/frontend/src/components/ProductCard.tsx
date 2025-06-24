import { Card, Button, Badge, Stack } from 'react-bootstrap';
import type { IProductCard } from '../interfaces/IProduct';

export const ProductCard = ({ product, onEdit, onDelete }: IProductCard) => {
  const getStatusVariant = () => {
    switch (product.status) {
      case 'ativo': return 'success';
      case 'inativo': return 'warning';
      case 'excluido': return 'danger';
      default: return 'secondary';
    }
  };

  return (
    <Card className="h-100 shadow-sm">
      <Card.Body className="d-flex flex-column">
        <div className="d-flex justify-content-between align-items-start mb-2">
          <Card.Title className="mb-0 flex-grow-1">{product.nome}</Card.Title>
          <Badge bg={getStatusVariant()} className="ms-2">
            {product.status}
          </Badge>
        </div>

        <Card.Subtitle className="mb-2 text-primary">
          R$ {product.preco}
        </Card.Subtitle>

        <Card.Text className="flex-grow-1">
          <small className="text-muted">Estoque:</small> {product.estoque} unidades
          {product.descricao && (
            <>
              <br />
              <small className="text-muted">Descrição:</small> {product.descricao}
            </>
          )}
        </Card.Text>

        <Stack direction="horizontal" gap={2} className="mt-auto">
          <Button 
            variant="outline-primary" 
            size="sm" 
            onClick={() => onEdit(product.id)}
            className="flex-grow-1"
          >
            Editar
          </Button>
          <Button 
            variant="outline-danger" 
            size="sm" 
            onClick={() => onDelete(product.id)}
            className="flex-grow-1"
            disabled={product.status === 'excluido'}
          >
            {product.status === 'excluido' ? 'Excluído' : 'Excluir'}
          </Button>
        </Stack>
      </Card.Body>
    </Card>
  );
};