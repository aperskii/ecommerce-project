import React from 'react'
import { Link } from 'react-router-dom'

export default function ProductsList({product}) {
    return (
        <div className="col-md-4 mb-3">
            <Link to={`/product/${product.slug}`} className="text-decoration-none text-dark">
                <div className="card h-100 shadow-sm">
                    <img className="card-img-top" src={product.thumbnail} alt={product.name} />
                    <div className="card-body">
                        <div className="d-flex justify-content-between">
                            <h5 className="text-dark">{product.name}</h5>
                            <h6 className="badge bg-danger p-2">${product.price}</h6>
                        </div>
                        <div className="d-flex justify-content-between">
                            <div className="d-flex justify-content-start align-items-center mb-3">
                                {
                                    product.sizes?.map(size => (
                                        <span key={size.id} className='bg-light text-dark p-1 me-2 fw-bold'>
                                            <small>{size.name}</small>
                                        </span>
                                    ))
                                }
                            </div>
                            <div>
                                {
                                    product.status == 1 ?
                                        <span className="badge bg-success p-2">
                                            In Stock
                                        </span>
                                    :
                                        <span className="badge bg-danger p-2">
                                            Out of Stock
                                        </span>
                                }
                            </div>
                        </div>
                        <div className="d-flex justify-content-start align-items-center mb-3">
                            {
                                product.colors?.map(color => (
                                    <div className='me-1 border border-secondary' key={color.id}
                                         style={{ backgroundColor: color.name.toLowerCase(), height: '20px', width: '20px' }}>
                                    </div>
                                ))
                            }
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    );
}
