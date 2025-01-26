import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Chat from './components/Chat';
import Profile from './components/Profile';
import Marketplace from './components/Marketplace';
import Lessons from './components/Lessons';

const App = () => {
  return (
    <Router>
      <div>
        <header>
          <h1>ActDoor</h1>
        </header>
        <Switch>
          <Route path="/" exact component={Marketplace} />
          <Route path="/profile" component={Profile} />
          <Route path="/lessons" component={Lessons} />
          <Route path="/chat" component={Chat} />
        </Switch>
      </div>
    </Router>
  );
};

export default App;
