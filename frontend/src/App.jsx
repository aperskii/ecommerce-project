import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './components/Home';
import Header from './components/layouts/Header';
import Product from './components/products/Product.jsx';

function App() {
  return (
    <BrowserRouter>
        <Header/>
        <Routes>
            <Route path="/" element={<Home/>} />
            <Route path="/product/:slug" element={<Product/>} />
        </Routes>
    </BrowserRouter>
  )
}

export default App
