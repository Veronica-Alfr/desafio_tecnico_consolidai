import 'express-async-errors';
import express, { Express } from 'express';
import produtoRouter from './routes/productRoutes';
import errorMiddleware from './middlewares/errors/error';
import prisma from './config/prisma';

class App {
  public app: Express;

  constructor() {
    this.app = express();
    this.middlewares();
    this.routes();
    this.setupGracefulShutdown();
  }

  private middlewares() {
    this.app.use(express.json());
    this.setupCors();
  }

  private setupCors() {
    this.app.use((_req, res, next) => {
      res.header('Access-Control-Allow-Origin', '*');
      res.header('Access-Control-Allow-Methods', 'GET,POST,DELETE,OPTIONS,PUT,PATCH');
      res.header('Access-Control-Allow-Headers', '*');
      next();
    });
  }

  private routes() {
    this.app.use(produtoRouter);
    this.addHealthCheck();
    this.app.use(errorMiddleware);
  }

  private addHealthCheck() {
    this.app.get('/health', async (_req, res) => {
      try {
        await prisma.$queryRaw`SELECT 1`;
        res.json({ status: 'OK', database: 'Connected' });
      } catch (error) {
        res.json({ status: 'OK', database: 'Disconnected' });
      }
    });
  }

  private setupGracefulShutdown() {
    process.on('SIGTERM', async () => {
      await prisma.$disconnect();
      process.exit(0);
    });
  }

  public start(port: number | string) {
    const server = this.app.listen(port, () => {
      console.log(`Server running on port ${port}`);
    });

    return server;
  }
}

export default App;