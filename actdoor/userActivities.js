const userActivities = [];

function logActivity(userId, activityType, activityDescription) {
    const activity = {
        userId,
        activityType,
        activityDescription,
        timestamp: new Date().toISOString()
    };
    userActivities.push(activity);
}

function getActivities(userId) {
    return userActivities.filter(activity => activity.userId === userId);
}

function clearActivities(userId) {
    const index = userActivities.findIndex(activity => activity.userId === userId);
    if (index !== -1) {
        userActivities.splice(index, 1);
    }
}

// Example usage
logActivity(1, 'Login', 'User logged in successfully.');
console.log(getActivities(1)); // Retrieve activities for user ID 1
clearActivities(1); // Clear activities for user ID 1
