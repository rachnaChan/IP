const express =require('express')
const router=express.Router()
const TokenValidation =require('../../middleware/TokenValidation')
const Category=require('../../model/category')
const { model } = require('mongoose')

router.get('/',async(req,res)=>{
    const cat=await Category.find().populate("products").exec()
    return res.json(cat)
})

router.post('/',TokenValidation,async(req,res)=>{
    const data=req.body

    const category= new Category(data)
    try{
        return res.json(await category.save())
    }catch(err){
        return res.json({msg:err})
    }
})
router.put('/:id',TokenValidation,async(req,res)=>{
    const id=req.params.id
    const data=req.body
    
    const category=await  Category.findOneAndUpdate({_id:id},data,{new: true})
    // category.name=data.name
    try{
        return res.json(category)
    }catch(err){
        return res.json({msg:err})
    }
})
router.delete('/:id',TokenValidation,async(req,res)=>{
    const id=req.params.id

    
    const category=await  Category.findOneAndRemove({_id:id})
    // category.name=data.name
    try{
        return res.json(category)
    }catch(err){
        return res.json({msg:err})
    }
})


module.exports=router