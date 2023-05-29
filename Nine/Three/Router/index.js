
const express = require('express');
var router = express.Router();
const { login } = require('../Service/login');
const { register } = require('../Service/register');
const { logout } = require('../Service/logout');

const userService = require('../Service/user');
const joiValid = require('../middleWare/joiValid');
const signUp = require('../Schema/signUp');
const { signUpSchema, signInSchema } = require('../Schema');
// const { signInSchema } = require('../Schema/signIn');


router.post('/register', joiValid(signUpSchema), async (req, res, next) => {

    const createdUser = await register(req.body); 

    res.json(createdUser);

});

//get user by id
router.get('/user/:id',  async function (req, res, next) {
    const { id } = req.params;
    
    const result = await userService.findById(id);
    res.json(result);
});

//login with email, pass
router.post('/login', joiValid(signInSchema) ,async (req, res, next) => {

    const { email, password } = req.body;
    const user = await login(email, password);

    res.json(user);

});

//logout
router.post('/logout', async (req, res) => {
    const { email, password } = req.body;
    const user = await login(email, password);
    
    res.json(result);

});



module.exports = router;