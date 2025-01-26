const Product = require('../models/Product');

exports.addProduct = async (req, res) => {
  try {
    const { title, description, price, sellerId } = req.body;
    const newProduct = new Product({ title, description, price, sellerId });
    await newProduct.save();
    res.json({ success: true, product: newProduct });
  } catch (err) {
    res.status(500).send('Error adding product');
  }
};

exports.getProducts = async (req, res) => {
  try {
    const products = await Product.find();
    res.json({ products });
  } catch (err) {
    res.status(500).send('Error fetching products');
  }
};
