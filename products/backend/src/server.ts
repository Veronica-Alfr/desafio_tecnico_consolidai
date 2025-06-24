import 'dotenv/config';
import App from './App';

const PORT = process.env.APP_PORT || 3002;

new App().start(PORT);