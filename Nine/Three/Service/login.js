
const users = require("../Model/User");

const login = async (email, password) => {
  try {
//check user in db

    const user = await users.findOne({ email });
    if (!user) {
      // return {
      //   status: 404,
      //   message: "User not found",
      // };
      throw "User not Found!!";
    }

//compare password & repeat password
    if (!user.matchesPassword(password)) {
      throw "Invaild username or password!!";
    }
    return {
      success: true,
      data: user,
    };
  } catch (error) {
      return{
        success: false,
        error:error || 'error'
      }
  }

  //   if (user.password != password) {
  //     return {
  //       status: 401,
  //       message: "Invalid Password",
  //     };
  //   }
  //   return {
  //     status: 200,
  //     message: "Login Success",
  //     data: {
  //       _id: user._id,
  //       name: user.name,
  //       email: user.email,
  //       password: user.password,
  //     },
  //   };
};

module.exports = {
    login
}
