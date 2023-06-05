// const { models } = require("mongoose");
const users = require("../Model/User");

const register = async (parame) => {
  try {
    const { username, firstname, lastname, email, password } = parame;

    const exists = await users.findOne({ email });

    //check all existed user 
    if (exists) {
      throw "User is already Existed!!";
    }

    // const user = new users({
    //     username,
    //     firstname,
    //     lastname,
    //     email,
    //     password
    //     })
    //     const _user = await user.save()
    //     return _user

    //create new user check exist users
    const newUser = {
      username,
      firstname,
      lastname,
      email,
      password
    }
    
    //save after create then insert into db
    const createUsers = await users.create(newUser);
    return createUsers;
  } catch (error) {
    return {
      status: false,
      error: error || "error"
    }
  }
}

module.exports = {
  register
}
