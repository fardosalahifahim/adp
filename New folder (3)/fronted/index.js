// frontend/index.js

import React from 'react';
import ReactDOM from 'react-dom';
import './App.css';  // Global styles
import App from './App';
import { BrowserRouter as Router } from 'react-router-dom';

ReactDOM.render(
    <Router>
        <App />
    </Router>,
    document.getElementById('root')
);
