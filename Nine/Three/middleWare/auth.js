


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

module.exports = {
    ensureSignedIn,
    ensureSignedOut
}