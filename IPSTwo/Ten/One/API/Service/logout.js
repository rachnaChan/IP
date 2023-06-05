
//session : can display every pagesssss by call one 

const logout = (session) => {
  try {
    session.jwt = null;
    session.destroy();
    return {
      // status: 200,
      // message: 'Logout Successful'
      success: true,
    };
  } catch (error) {
    return {
      success: false,
      error: error || "error",
    };
  }
};

module.exports = {
  logout
}
