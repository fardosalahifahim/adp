const express = require('express');
const User = require('../models/User');
const router = express.Router();

// Update Profile
router.put('/profile', async (req, res) => {
  const { userId, username, bio, profilePicture } = req.body;
  try {
    const user = await User.findByIdAndUpdate(userId, {
      username,
      bio,
      profilePicture,
    }, { new: true });
    res.json({ success: true, user });
  } catch (err) {
    res.status(500).send('Error updating profile');
  }
});

module.exports = router;
