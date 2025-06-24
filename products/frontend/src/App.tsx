import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { ProductsPage } from './pages/ProductsPage';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<ProductsPage />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;