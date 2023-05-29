

const users = require("../Model/User");

//user/+id = display all information
const findById = async (id) => {
  try {
    const user = await users.findById(id);
    return {
      sucess: true,
      // status:true,
      data: user,
    };
  } catch (error) {
    return {
      sucess: false,
      error: error || "error",
    };
  }
};

module.exports = {
  findById,
};
