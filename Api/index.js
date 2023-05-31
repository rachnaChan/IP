require("dotenv").config();
const express= require('express')
var cors = require('cors')
const mongoose=require('mongoose')
const app=express()
const userRouter=require('./src/router/user')
const productRouter=require('./src/router/product')
const categoryRouter=require('./src/router/cateogry')




app.use(cors("*"))
app.use(express.json())
app.use(express.urlencoded({ extended: true }));


app.use('/api/user',userRouter)
app.use('/api/product',productRouter)
app.use('/api/category',categoryRouter)


app.get('/',(req,res)=>{
    res.json({
        msg:"It work"
    })
})

const connectDB=async()=>{
    try {
        await mongoose.connect(`${process.env.DB_CONNECTION}`);
        console.log("CONNECTED");
      } catch (error) {
        // console.log("SOMETHING WHEN WRONG");
        console.log(error);
      }
}
connectDB()

app.listen(process.env.PORT ?? 3000,()=>{
    console.log(`Server run on http://localhost:${process.env.PORT ?? 3000}`);
})