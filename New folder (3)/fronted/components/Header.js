// frontend/components/Header.js

import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
    return (
        <header style={styles.header}>
            <div style={styles.container}>
                <h1 style={styles.logo}>ActDoor</h1>
                <nav>
                    <ul style={styles.navList}>
                        <li><Link style={styles.navItem} to="/">Marketplace</Link></li>
                        <li><Link style={styles.navItem} to="/profile">Profile</Link></li>
                        <li><Link style={styles.navItem} to="/lessons">Lessons</Link></li>
                        <li><Link style={styles.navItem} to="/chat">Chat</Link></li>
                    </ul>
                </nav>
            </div>
        </header>
    );
};

// Inline styles
const styles = {
    header: {
        backgroundColor: '#6A5ACD',
        padding: '10px 0',
        color: 'white',
    },
    container: {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        width: '80%',
        margin: '0 auto',
    },
    logo: {
        fontSize: '2rem',
        fontWeight: 'bold',
    },
    navList: {
        listStyle: 'none',
        display: 'flex',
        gap: '20px',
    },
    navItem: {
        textDecoration: 'none',
        color: 'white',
        fontSize: '1.2rem',
    }
};

export default Header;
