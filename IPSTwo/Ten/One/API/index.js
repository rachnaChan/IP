//allow us to store sth into a cookie as same as jsonwebtoken
var sessions = require('express-session');
const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const cors = require('cors');


app.use(cors({
    origin: 'http://localhost:3000'
}))

//parse application/x-ww-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

//use the sessions
app.use(sessions({
    //trust first proxy
    secret: 'secret',
    rolling: true,
    resave: true, //resave:false,
    saveUninitialized: true,
    name:'access_token',
    cookie: {
        //one hour
        maxAge: 1000 * 60 * 60 * 1,

        secure: false,
        //can ignore sameSite or uncomment
        sameSite: true,
        
        }
    
}));

// Connect mongodb
require('./Config/db')();
app.use(require('./Router'));

app.listen(process.env.PORT || 3001, () => {
    console.log('Your app is available at http://localhost:3001');
});


