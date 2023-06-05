
const express = require('express');
var router = express.Router();
const { login } = require('../Service/login');
const { register } = require('../Service/register');
const { logout } = require('../Service/logout');

const userService = require('../Service/delete');

//can also create function joiValid
const joiValid = require('../middleWare/joiValid');
const signUp = require('../Schema/signUp');
const { signUpSchema, signInSchema } = require('../Schema');

const auth = require('../middleWare/auth');
const {createAsessionToken} = require('../Service/utils');



//get user by id
router.get('/user/:id', auth.ensureSignedIn,  async function (req, res, next) {
    const { id } = req.params;
    
    const result = await userService.findById(id);
    res.json(result);
});

//create schema then do not need write middleware anymore 
//ctrl+space then joiValid 
router.post('/register', auth.ensureSignedOut, joiValid(signUpSchema), async (req, res, next) => {

    const createdUser = await register(req.body); 
    res.json(createdUser);

});

//login with email, pass
router.post('/login' , auth.ensureSignedOut, joiValid(signInSchema) ,async (req, res, next) => {

    // const { email, password } = req.body;
    // const user = await login(email, password);

    //store token in session
    // const token = createAsessionToken(user?._id, user?.email);
    // req.session.jwt = token;

    // res.json(user);
    // res.json(result);

    const {email, password} = req.body;
    const user = await login(email, password);

    req.session.jwt= user?.data?.tokens;

    res.json(user);

});

//logout
router.post('/logout', auth.ensureSignedIn, async (req, res) => {
    // // const { email, password } = req.body;
    // // const user = await login(email, password);
    const result = logout(req.session);
    
    res.json(result);

    

});

//display information user
router.get('/me', auth.ensureSignedIn,auth.currentUser,async function(req, res){
    const {currentUser} = req;

    const result = await userService.findById(currentUser?._id);
    res.json(result);

} )


//update user 
router.post('/update-user', auth.ensureSignedIn,auth.currentUser, async function (req, res) {
   
    const { currentUser } = req;
   const result = await userServices.findById(currentUser?._id);
   res.json(result);

});

//update password user
router.post('/update-password', auth.ensureSignedIn,auth.currentUser, async function (req, res) {
  
   const { currentUser } = req;jwt
   const result = await userService.findById(currentUser?._id);
   res.json(result);

});

//delete user
router.post('/delete-user', auth.ensureSignedIn,auth.currentUser, async function (req, res) {
  
   
   const { currentUser } = req;
   const result = await userService.findById(currentUser?._id);
   res.json(result);

});


module.exports = router;