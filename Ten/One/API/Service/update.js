

const users = require("../Model/User");


//user/+id = display all information
const findById = async (id) => {
  try {
    const userss = await users.findOneAndUpdate(id);
    return {
      sucess: true,
      status:true,
      message: 'Update!!',
      // status:true,
      // data: user
    //   data: userss
    };
  } catch (error) {
    return {
      sucess: false,
      error: error || "error"
    }
  }
}

module.exports = {
  findById
}
