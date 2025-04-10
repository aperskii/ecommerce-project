import { createSlice } from '@reduxjs/toolkit';
import { toast } from 'react-toastify';


const initialState = {
    cartItems: [],
    validCoupon: {
        name: '',
        discount: 0,
    }
}

export const cartSlice = createSlice({
    name: 'cart',
    initialState,
    reducers: {
        addToCart: (state, action) => {
            const item = action.payload
            let productItems = state.cartItems.find(product => product.product_id === item.product_id
                 && product.color === item.color && product.size === item.size
            )
            if (productItems) {
                toast.info('Product already added to your cart')
            }else{
                state.cartItems = [item,...state.cartItems]
                toast.success('Product added to your cart')
            }
        },
        incrementQ: (state, action) => {
            const item = action.payload
            let productItem = state.cartItems.find(product => product.product_id === item.product_id
                && product.color === item.color && product.size === item.size
            )
            if (productItem.qty === productItem.maxQty) {
                toast.info(`Only ${productItem.maxQty} available`)
            }else{
                productItem.qty += 1
            }
        },
        decrementQ: (state, action) => {
            const item = action.payload
            let productItem = state.cartItems.find(product => product.product_id === item.product_id
                && product.color === item.color && product.size === item.size
            )
            productItem.qty -= 1
            if (productItem.qty === 0) {
                state.cartItems = state.cartItems.filter(product => product.ref !== item.ref)
            }
        },
        removeFromCart: (state, action) => {
            const item = action.payload
            state.cartItems = state.cartItems.filter(product => product.ref !== item.ref)
            toast.warning('Product removed from your cart')
        }
    }
})

const cartReducer = cartSlice.reducer

export const {addToCart, decrementQ, incrementQ, removeFromCart} = cartSlice.actions;

export default cartReducer
