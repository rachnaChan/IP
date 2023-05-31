
const mongoose = require("mongoose");

const user =mongoose.Schema({
    name:{
        type:String,
        min:1,
        max:255
    },
    price:{
        type:Number,
        min:0

    },
    imagePath:{
        type:String
    },
    owner:{
        type: mongoose.Schema.Types.ObjectId,
        ref: 'user'
    },
    category:{
        type: mongoose.Schema.Types.ObjectId,
        ref: 'category'
    },
    created:{
        type:Date,
        default:Date.now()
    }
})

module.exports=mongoose.model("product",user)