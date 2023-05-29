const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const cors = require('cors');
const mongoose =require('mongoose')

app.use(cors({
    origin: 'http://localhost:3000'
}))


app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


app.use(require('./Router'));

const db=async () => {
    try {
        await mongoose.connect('mongodb://127.0.0.1:27017/tpnineone');
        console.log("MongoDB connected~");

    } catch (err) {
        console.log("Mongoose: ", err);
    }
}
db()
//port for running 
app.listen(process.env.PORT || 3001, () => {
    console.log('Your app is available at http://localhost:3001');
});