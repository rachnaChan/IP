"use strict"
var mongoose = require('mongoose');
var bcrypt = require('bcryptjs');


var userSchema = new mongoose.Schema({
    username: {
        type: String,
        unique: true,
        required: true,
        validate: {
            //check exists username
            validator: async val => Users.doesntExist({username: val}),
            message: ({value}) => `Invalid Username ${value}!!`
        }
    },

    firstname: {
        type: String,
        required: true,
    },
    lastname: {
        type: String,
        required: true
    },
    email: {
        type: String,
        unique: true,
        required: true
    },
    password: {
        type: String,
        required: true,
    },
},

//time create, updated
 {
    timestamps: true,
    toJSON: {
        transform(doc, ret) {
            delete ret.password;
        }
    }
});

//local var salt String 
userSchema.pre('save', function (next){
    if (this.isModified('password')) {
        var salt = bcrypt.genSaltSync(10);
        this.password = bcrypt.hashSync(this.password, salt);
    }
    next();
})

//check confirm password
userSchema.methods.matchesPassword = function (password) {
    return bcrypt.compareSync(password, this.password);
};


userSchema.statics.doesntExist = async function (options) {
    return (await this.where(options).countDocuments() === 0);
};

var Users = mongoose.model('Users', userSchema);

module.exports = Users;
