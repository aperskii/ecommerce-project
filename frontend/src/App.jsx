import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './components/Home';
import Header from './components/layouts/Header';
import Product from './components/products/Product.jsx';
import Cart from './components/cart/Cart.jsx';

function App() {
  return (
    <BrowserRouter>
        <Header/>
        <Routes>
            <Route path="/" element={<Home/>} />
            <Route path="/product/:slug" element={<Product/>} />
            <Route path="/cart" element={<Cart/>} />
        </Routes>
    </BrowserRouter>
  )
}

export default App
