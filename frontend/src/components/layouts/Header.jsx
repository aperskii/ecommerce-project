import React from 'react'
import { useSelector } from 'react-redux';
import { Link } from 'react-router-dom'

export default function Header() {
    const { cartItems } = useSelector(state => state.cart);
    return (
        <nav className="navbar navbar-expand-lg">
            <div className="container-fluid">
                <Link className="navbar-brand" to="/">
                    <i className="bi bi-shop h1"></i>
                </Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <Link className="nav-link active" aria-current="page" to="/">
                                <i className="bi bi-house"></i> Home
                            </Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/cart">
                                <i className="bi bi-bag"></i> Cart({cartItems.length})
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    )
}
