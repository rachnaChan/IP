const express =require('express')
const router=express.Router()
const User=require('../model/user')
const TokenValidation =require('../middleware/TokenValidation')
const Product=require('../model/product')
const multer = require("multer");
const path=require('path')
const { route } = require('./user')
const { unlinkSync } = require('fs')
const { error } = require('console')

const storage=multer.diskStorage({
    destination:(req,file,cb)=>{
        cb(null,'src/file')
    },
    filename:(req,file,cb)=>{
        console.log(file)
        cb(null,Date.now()+path.extname(file.originalname))
    }
});

const upload = multer({storage:storage})


router.get('/',async(req,res)=>{
    res.json(await Product.find().populate('owner').populate('category').exec())
})

router.get('/static/*',(req,res)=>{
    let filePath=req.url.replace('/static',"")
    filePath=filePath.split('%20').join(" ")
    res.sendFile(filePath,{root:'./src/file'})
})

router.post('/add',TokenValidation,upload.single('file'),async(req,res)=>{
    const data=req.body
    data.owner=req.user._id;
    
    data.imagePath=req.file ? req.file.filename :"default-image.jpg"
    const product= new Product(data)
    try{
        return res.json(await product.save())
    }catch(err){
        return res.json({msg:err})
    }
})
router.put('/:id',TokenValidation,upload.single('file'),async(req,res)=>{
    const data=req.body
    data.owner=req.user._id;
    const id=req.params.id
    
    try{
        const oldData=await Product.findOne({_id:id});
        if(req.file){
            try{
                if(oldData.imagePath!="default-image.jpg"){
                    unlinkSync(`src/file/${oldData.imagePath}`)
                }
            }catch(err){
                console.error(err);
            }
            data.imagePath=req.file.filename
        }else{
            if(oldData.imagePath){
                
                data.imagePath=oldData.imagePath
            }else{
                data.imagePath="default-image.jpg"
            }
        }
        
    
        const product= await Product.findOneAndUpdate({_id:id},data,{new: true})
        return res.json(product)
    }catch{
        return res.status(400).json({
            msg:"Product not found"
        })
    }
    


})


router.delete("/:id",TokenValidation,async(req,res)=>{
    const id=req.params.id
    const product=await  Product.findOneAndRemove({_id:id})
    try{
        return res.json(product)
    }catch(err){
        return res.json({msg:err})
    }
})




module.exports=router