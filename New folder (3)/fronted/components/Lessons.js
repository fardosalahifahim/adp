import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Lessons = () => {
  const [lessons, setLessons] = useState([]);
  const [title, setTitle] = useState('');
  const [content, setContent] = useState('');

  useEffect(() => {
    const fetchLessons = async () => {
      const response = await axios.get('http://localhost:5000/api/lessons/list');
      setLessons(response.data.lessons);
    };
    fetchLessons();
  }, []);

  const handleAddLesson = async () => {
    await axios.post('http://localhost:5000/api/lessons/add', {
      title,
      content,
      teacherId: 'teacher-id', // Replace with logged-in teacher ID
    });
    setTitle('');
    setContent('');
  };

  return (
    <div>
      <h2>Lessons</h2>
      <div>
        <input
          type="text"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          placeholder="Lesson Title"
        />
        <textarea
          value={content}
          onChange={(e) => setContent(e.target.value)}
          placeholder="Lesson Content"
        />
        <button onClick={handleAddLesson}>Add Lesson</button>
      </div>
      <div>
        <h3>Lessons</h3>
        {lessons.map((lesson) => (
          <div key={lesson._id}>
            <h4>{lesson.title}</h4>
            <p>{lesson.content}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Lessons;
