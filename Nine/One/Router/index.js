
const express = require('express');
var router = express.Router();
const { login } = require('../Service/login');
const { register } = require('../Service/register');
const userService = require('../Service/user');
const { logout } = require('../Service/logout');


router.post('/register', async (req, res, next) => {

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
router.post('/login', async (req, res, next) => {

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