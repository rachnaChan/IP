const mongoose = require('mongoose');

module.exports = async () => {
    try {
        await mongoose.connect('mongodb://127.0.0.1:27017/tptenone', {
            autoIndex: true,
            //default thirty seconds
            serverSelectionTimeoutMS: 30000 
        });
        console.log("MongoDB connected~");

    } catch (err) {
        console.log("Mongoose: ", err);
    }
}