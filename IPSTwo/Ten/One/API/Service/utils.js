const jwt = require('jsonwebtoken');

const createAsessionToken = (userID, email) => {
    return jwt.sign({
        _id: userID,
        email,
    }, 'secret-jwt');
    
}

module.exports = {
    createAsessionToken
}