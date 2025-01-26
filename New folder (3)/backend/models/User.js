const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
  username: { type: String, required: true },
  bio: { type: String },
  profilePicture: { type: String },
});

module.exports = mongoose.model('User', userSchema);
