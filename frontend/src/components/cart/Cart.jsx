import React from 'react'
import { useDispatch, useSelector } from 'react-redux';
import Alert from '../layouts/Alert.jsx';
import { decrementQ, incrementQ, removeFromCart } from '../../redux/slices/cartSlice.js';

export default function Cart() {
    const { cartItems } = useSelector(state => state.cart);
    const dispatch = useDispatch();

    return (
        <div className="row my-4">
            <div className="col-md-12">
                <div className="card">
                    <div className="card-body">
                        {cartItems.length > 0 ? (
                            <>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {cartItems.map((item, index) => (
                                            <tr key={index}>
                                                <td>{(index += 1)}</td>
                                                <td>
                                                    <img src={item.image} width={60} height={60} className="img-fluid rounded" />
                                                </td>
                                                <td>{item.name}</td>
                                                <td>
                                                    <i className="bi bi-caret-up" style={{cursor:'pointer'}}
                                                    onClick={() => dispatch(incrementQ(item))}></i>
                                                    <span className="mx-2">
                                                        {item.qty}
                                                    </span>
                                                    <i className="bi bi-caret-down" style={{cursor:'pointer'}}
                                                       onClick={() => dispatch(decrementQ(item))}></i>
                                                </td>
                                                <td>${item.price}</td>
                                                <td>
                                                    <div
                                                        className="border-secondary border"
                                                        style={{ backgroundColor: String(item.color).toLowerCase(), height: '20px', width: '20px' }}
                                                    ></div>
                                                </td>
                                                <td>
                                                    <span className="bg-light text-dark fw-bold me-2 p-1">
                                                        <small>{String(item.size)}</small>
                                                    </span>
                                                </td>
                                                <td>${item.price * item.qty}</td>
                                                <td>
                                                    <i className="bi bi-cart-x" style={{cursor:'pointer'}}
                                                       onClick={() => dispatch(removeFromCart(item))}></i>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </>
                        ) : (
                            <Alert content="Your cart is empty" type="primary" />
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}
