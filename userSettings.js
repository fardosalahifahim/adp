const userSettings = {};

function setUserSetting(userId, settingKey, settingValue) {
    if (!userSettings[userId]) {
        userSettings[userId] = {};
    }
    userSettings[userId][settingKey] = settingValue;
}

function getUserSetting(userId, settingKey) {
    return userSettings[userId] ? userSettings[userId][settingKey] : null;
}

function clearUserSettings(userId) {
    delete userSettings[userId];
}

// Example usage
setUserSetting(1, 'theme', 'dark');
console.log(getUserSetting(1, 'theme')); // 'dark'
clearUserSettings(1);
console.log(getUserSetting(1, 'theme')); // null
