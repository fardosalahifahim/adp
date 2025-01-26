const express = require('express');
const { addLesson, getLessons } = require('../controllers/lessonController');
const router = express.Router();

router.post('/add', addLesson);
router.get('/list', getLessons);

module.exports = router;
