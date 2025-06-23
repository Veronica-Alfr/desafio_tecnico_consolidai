import Joi from 'joi';

const fieldsMissing = 'Todos os campos obrigatórios devem ser preenchidos';

const produtoBaseSchema = {
    nome: Joi.string().min(3).max(255).messages({
        'string.empty': fieldsMissing,
        'string.min': 'O nome deve ter pelo menos 3 caracteres',
        'string.max': 'O nome não pode exceder 255 caracteres'
    }),
    preco: Joi.string().pattern(/^\d+(\.\d{1,2})?$/)
        .message('O preço deve ser um número positivo com até 2 casas decimais (ex: "10.99")'),
    estoque: Joi.number().integer().min(0).messages({
        'number.base': 'O estoque deve ser um número inteiro',
        'number.min': 'O estoque não pode ser negativo'
    }),
    descricao: Joi.string().allow(null, '').max(1000)
        .messages({
            'string.max': 'A descrição não pode exceder 1000 caracteres'
        }),
    status: Joi.string().valid('ativo', 'inativo', 'excluido').default('ativo')
};

const processValidation = (schema: Joi.ObjectSchema, body: object) => {
    const { error, value } = schema.validate(body);

    if (error) {
        const e = new Error(error.details[0].message);
        e.name = 'BadRequest';
        throw e;
    }

    return value;
};

export const validateProductCreate = (body: object) => {
    const schema = Joi.object({
        ...produtoBaseSchema,
        nome: produtoBaseSchema.nome.required(),
        preco: produtoBaseSchema.preco.required(),
        estoque: produtoBaseSchema.estoque.required()
    });
    
    return processValidation(schema, body);
};

export const validateProductUpdate = (body: object) => {
    const schema = Joi.object(produtoBaseSchema)
        .min(1);
    
    return processValidation(schema, body);
};