
const mongoose = require("mongoose");

const category =mongoose.Schema({
    name:{
        type:String,
        min:1,
        max:255
    },
    created:{
        type:Date,
        default:Date.now()
    }
})

category.virtual('products',{
    ref:'product',
    localField:"_id",
    foreignField:"category"
})

module.exports=mongoose.model("category",category)