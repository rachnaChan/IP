
const jwt = require('jsonwebtoken')

const ensureSignedIn = (req, res, next) => {
    if (!req.session.jwt) {
        return res.json({
            success: false,
            error:`Please, sign In!!`
        })
    }
    next();
}

const ensureSignedOut = (req, res, next) => {
    if (req.session.jwt) {
        return res.json({
            success: false,
            error: `Already signed in !!`
        })
    }
    next();
}


const currentUser = (req, res, next)=>{
    if(!req.session.jwt){
        return res.json({
            success: false,
            error: `Please, sign In!!`
        })
    }

    const userss = jwt.verify(req.session.jwt, 'secret-jwt')
    req.currentUser = userss;

    next();
}

module.exports = {
    ensureSignedIn,
    ensureSignedOut,
    currentUser
}