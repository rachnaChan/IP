const Joi = require('joi');

module.exports = Joi.object({

    //atleast three at most thirty name
    username: Joi.string()
        .alphanum()
        .min(3)
        .max(30)
        .required(),
    
    firstname: Joi.string()
    
        .alphanum()
        .min(3)
        .max(30)
        .required(),
    
    lastname: Joi.string()
        .alphanum()
        .min(3)
        .max(30)
        .required(),

    password: Joi.string()
     //accept all alphabe, number  regular expression
        .pattern(new RegExp('^[a-zA-Z0-9]{3,30}$')),

    repeat_password: Joi.ref('password'),


    email: Joi.string()
        .email({ minDomainSegments: 2, tlds: { allow: ['com', 'net'] } })
})
    .with('password', 'repeat_password');


