import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Profile = () => {
  const [user, setUser] = useState(null);
  const [username, setUsername] = useState('');
  const [bio, setBio] = useState('');
  const [profilePicture, setProfilePicture] = useState('');

  useEffect(() => {
    // Fetch user data on component mount
    const fetchUser = async () => {
      const response = await axios.get('http://localhost:5000/api/user/profile');
      setUser(response.data);
      setUsername(response.data.username);
      setBio(response.data.bio);
      setProfilePicture(response.data.profilePicture);
    };
    fetchUser();
  }, []);

  const handleProfileUpdate = async () => {
    const response = await axios.put('http://localhost:5000/api/user/profile', {
      userId: user._id,
      username,
      bio,
      profilePicture
    });
    setUser(response.data.user);
  };

  return (
    <div className="profile-container">
      <h2>Your Profile</h2>
      <div className="profile-info">
        <img src={profilePicture || '/default-avatar.png'} alt="Profile" />
        <input
          type="text"
          value={username}
          onChange={(e) => setUsername(e.target.value)}
          placeholder="Username"
        />
        <textarea
          value={bio}
          onChange={(e) => setBio(e.target.value)}
          placeholder="Bio"
        />
        <input
          type="file"
          onChange={(e) => setProfilePicture(URL.createObjectURL(e.target.files[0]))}
        />
        <button onClick={handleProfileUpdate}>Update Profile</button>
      </div>
    </div>
  );
};

export default Profile;
