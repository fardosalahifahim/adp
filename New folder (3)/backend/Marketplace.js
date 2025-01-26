import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Marketplace = () => {
  const [products, setProducts] = useState([]);
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [price, setPrice] = useState('');

  useEffect(() => {
    const fetchProducts = async () => {
      const response = await axios.get('http://localhost:5000/api/products/list');
      setProducts(response.data.products);
    };
    fetchProducts();
  }, []);

  const handleAddProduct = async () => {
    await axios.post('http://localhost:5000/api/products/add', {
      title,
      description,
      price,
      sellerId: 'user-id', // Replace with logged-in user ID
    });
    setTitle('');
    setDescription('');
    setPrice('');
  };

  return (
    <div>
      <h2>Marketplace</h2>
      <div>
        <input
          type="text"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          placeholder="Product Title"
        />
        <input
          type="text"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
          placeholder="Description"
        />
        <input
          type="number"
          value={price}
          onChange={(e) => setPrice(e.target.value)}
          placeholder="Price"
        />
        <button onClick={handleAddProduct}>Add Product</button>
      </div>
      <div>
        <h3>Products for Sale</h3>
        {products.map((product) => (
          <div key={product._id}>
            <h4>{product.title}</h4>
            <p>{product.description}</p>
            <p>${product.price}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Marketplace;
