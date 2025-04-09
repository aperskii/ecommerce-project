import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import { axiosRequest } from '../../helpers/config.js'
import Alert from '../layouts/Alert.jsx'
import Spinner from '../layouts/Spinner.jsx'
import { Parser } from 'html-to-react'
import Slider from './images/Slider.jsx';

export default function Product() {
    const [product, setProduct] = useState([])
    const [loading, setLoading] = useState(false)
    const [selectedColor, setSelectedColor] = useState('')
    const [selectedSize, setSelectedSize] = useState('')
    const [qty, setQty] = useState('1')
    const [error, setError] = useState('')
    const { slug } = useParams()

    useEffect(() => {
        const fetchProductBySlug = async () => {
            setLoading(true)
            try {
                    const response = await axiosRequest.get(`product/${slug}/show`)
                    setProduct(response.data.data)
                    setLoading(false)
            }catch(error) {
                if (error?.response?.status === 404) {
                    setError('The Product your are looking for does not exist.')
                }
                console.log(error)
                setLoading(false)
            }
        }
        fetchProductBySlug()
    },[slug])


    return (
        <div className="card my-5">
            {
                error ?
                    <Alert content={error} type="danger" />
                :
                loading ?
                        <Spinner />
                :
                <>
                    <div className="row g-0">
                        <div className="col-md-4 p-2">
                            <div>
                                <Slider product={product} />
                            </div>
                        </div>
                        <div className="col-md-8">
                            <div className="card-body">
                                <div className="d-flex justify-content-between">
                                    <h5 className="text-dark">{product?.name}</h5>
                                    <h6 className="badge bg-danger p-2">${product?.price}</h6>
                                </div>
                            </div>
                            <div className="my-3">
                                { Parser().parse(product?.desc)}
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
                                <div className="me-2">
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
                                        <span key={color.id}>
                                            <div className='me-1 border border-secondary' key={color.id} style={{ backgroundColor: color.name.toLowerCase(), height: '20px', width: '20px' }}>
                                            </div>
                                    </span>
                                    ))
                                }
                            </div>
                        </div>
                    </div>
                </>
            }
        </div>
    )
}
