const users = {};

function addUser(userId, userData) {
    users[userId] = userData;
}

function getUser(userId) {
    return users[userId] || null;
}

function updateUser(userId, newData) {
    if (users[userId]) {
        users[userId] = { ...users[userId], ...newData };
    }
}

function deleteUser(userId) {
    delete users[userId];
}

// Example usage
addUser(1, { firstName: 'John', lastName: 'Doe', email: 'john@example.com' });
console.log(getUser(1)); // { firstName: 'John', lastName: 'Doe', email: 'john@example.com' }
updateUser(1, { email: 'john.doe@example.com' });
console.log(getUser(1)); // { firstName: 'John', lastName: 'Doe', email: 'john.doe@example.com' }
deleteUser(1);
console.log(getUser(1)); // null
