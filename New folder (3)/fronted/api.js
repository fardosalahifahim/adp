// frontend/api.js

const API_URL = 'http://localhost:5000/api';

// API to login user
export const loginUser = async (email, password) => {
    const response = await fetch(`${API_URL}/auth/login`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
    });
    const data = await response.json();
    return data;
};

// API to register user
export const registerUser = async (name, email, password) => {
    const response = await fetch(`${API_URL}/auth/register`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, email, password }),
    });
    const data = await response.json();
    return data;
};

// API to fetch products
export const fetchProducts = async () => {
    const response = await fetch(`${API_URL}/products`);
    const products = await response.json();
    return products;
};

// API to create a new product
export const createProduct = async (product) => {
    const response = await fetch(`${API_URL}/products`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(product),
    });
    const data = await response.json();
    return data;
};

// API to fetch lessons
export const fetchLessons = async () => {
    const response = await fetch(`${API_URL}/lessons`);
    const lessons = await response.json();
    return lessons;
};
