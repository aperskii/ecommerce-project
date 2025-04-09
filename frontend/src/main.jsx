import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import 'bootstrap/dist/css/bootstrap.min.css'
import "bootstrap/dist/js/bootstrap.bundle.min.js"
import 'bootstrap-icons/font/bootstrap-icons.css'
import { ToastContainer } from 'react-toastify'
import 'react-toastify/dist/ReactToastify.css'
import "react-image-gallery/styles/css/image-gallery.css"


createRoot(document.getElementById("root")).render(
        <div className="container card shadow-sm my-4">
            <ToastContainer position="top-right" />
            <App />
        </div>
);
