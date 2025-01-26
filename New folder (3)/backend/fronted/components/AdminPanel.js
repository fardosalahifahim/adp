import React, { useState, useEffect } from 'react';
import axios from 'axios';

const AdminPanel = () => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    const fetchUsers = async () => {
      const response = await axios.get('http://localhost:5000/api/admin/users');
      setUsers(response.data.users);
    };
    fetchUsers();
  }, []);

  return (
    <div>
      <h2>Admin Panel</h2>
      <h3>User List</h3>
      <ul>
        {users.map((user) => (
          <li key={user._id}>{user.username}</li>
        ))}
      </ul>
    </div>
  );
};

export default AdminPanel;
