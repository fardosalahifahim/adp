const express = require('express');
const cors = require('cors');
const mongoose = require('mongoose');
const http = require('http');
const socketIo = require('socket.io');
const authRoutes = require('./routes/authRoutes');
const productRoutes = require('./routes/productRoutes');
const lessonRoutes = require('./routes/lessonRoutes');
const adminRoutes = require('./routes/adminRoutes');
const app = express();

// Create HTTP server and attach socket.io
const server = http.createServer(app);
const io = socketIo(server);

// Middleware
app.use(cors());
app.use(express.json());

// Routes
app.use('/api/auth', authRoutes);
app.use('/api/products', productRoutes);
app.use('/api/lessons', lessonRoutes);
app.use('/api/admin', adminRoutes);

// WebSocket connection for chat
io.on('connection', (socket) => {
  console.log('A user connected');

  // Receive chat message from client
  socket.on('chatMessage', (msg) => {
    io.emit('chatMessage', msg); // Broadcast the message to all clients
  });

  socket.on('disconnect', () => {
    console.log('User disconnected');
  });
});

// Connect to MongoDB
mongoose.connect('mongodb://localhost:27017/actdoor', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
}).then(() => {
  console.log('Database connected');
}).catch(err => {
  console.log('Database connection error:', err);
});

// Server
server.listen(5000, () => {
  console.log('Server is running on http://localhost:5000');
});
