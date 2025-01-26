const Lesson = require('../models/Lesson');

exports.addLesson = async (req, res) => {
  try {
    const { title, content, teacherId } = req.body;
    const newLesson = new Lesson({ title, content, teacherId });
    await newLesson.save();
    res.json({ success: true, lesson: newLesson });
  } catch (err) {
    res.status(500).send('Error adding lesson');
  }
};

exports.getLessons = async (req, res) => {
  try {
    const lessons = await Lesson.find();
    res.json({ lessons });
  } catch (err) {
    res.status(500).send('Error fetching lessons');
  }
};
