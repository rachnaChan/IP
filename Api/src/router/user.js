const express =require('express')
const router=express.Router()
const User=require('../model/user')
const jwt=require('jsonwebtoken')
const bcrypt = require('bcrypt');
const {check_login,check_register,check_credentail} =require('../middleware/user_check_req')
const TokenValidation =require('../middleware/TokenValidation')

router.post('/login',check_login,async(req,res)=>{
    const data=req.body;
    let user=await User.findOne({username:data.EUID},{password:0})
    if(!user) user=await User.findOne({email:data.EUID},{password:0})
    if(!user) return res.status(400).send({"message":"Email or Password invalid"})
    // delete user.password;
    const token=generateGToken({id:user._id})
    res.json({
        token:token,
        user:user,
        msg:"Login successfull"
    })
})

router.post('/register', check_register,check_credentail,async(req,res)=>{

    // console.log(req.body);
    
    const data=req.body
    if(data.password!=data.repeat_password) return  res.status(400).send({"msg":"Password and Repeat password not match"})
    const salt= await bcrypt.genSalt(10);
    const hashPassword=await bcrypt.hash(data.password,salt)
    const user=new User({
        username:data.username,
        email:data.email,
        password:hashPassword,
        firstname:data.firstname,
        lastname:data.lastname,
    })

    try{
        const userSaved=await user.save();
        const token=generateGToken({id:userSaved._id})
        res.json({
            token:token,
            user:userSaved,
            msg:"Register successfull"
        })
    }catch{
        res.send({"Message":"it not work"});
    }
    // res.send("")
    
})
router.get("/me",TokenValidation,(req,res)=>{
    const user=req.user;
    delete user.password;
    res.json(req.user)
})
const generateGToken=(obj)=>{
    return jwt.sign(obj,process.env.ACCESS_TOKEN_SECRET)
}



module.exports=router