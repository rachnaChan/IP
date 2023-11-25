import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

import loginView from "../views/signIn.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: loginView,
    },
    {
      path: "/unauthorized",
      name: "unauthorized",
      component: () => import("../views/UnauthorizedView.vue"),
    },
    {
      path: "/login",
      name: "login",

      component: () => import("../views/signIn.vue"),
      meta: { ensureLogout: true },
    },
    {
      path: "/forgetPass",
      name: "forgetPass",

      component: () => import("../components/password/forgetPassword.vue"),
      // meta: { ensureLogout: true },
    },
    // {
    //   path: "/forgotPass",
    //   name: "forgotPass",
    //   component: () => import("../components/password/forgetPassword.vue"),
    //   meta: { requiresAuth: true, role: "Student" },
    // },

    {
      path: "/newPassword",
      name: "newPassword",

      component: () => import("../components/password/resetPassword.vue"),
      // meta: { ensureLogout: true },
    },

    //student's part
    {
      path: "/student/dashboard/:userId",
      name: "studentDashboard",
      component: () => import("../components/student/dashboard/dashBoard.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/changePass/:userId",
      name: "studentChangePass",

      component: () =>
        import("../components/student/password/changePassword.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/course/:userId",
      name: "studentCourse",
      component: () => import("../components/student/dashboard/courseView.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/myCourse/:userId",
      name: "studentMyCourse",
      component: () => import("../components/student/enroll/myCourse.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    // {
    //   path: "/student/editCourse/:userId",
    //   name: "studentEditCourse",
    //   component: () => import("../components/student/enroll/editCourseEnrollment.vue"),
    //   meta: { requiresAuth: true, role: "Student" },
    // },
    {
      path: "/student/draftCourse/:userId",
      name: "studentDraftCourse",
      component: () => import("../components/student/enroll/draftCourse.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/document/:userId",
      name: "studentDocument",
      component: () =>
        import("../components/student/dashboard/documentView.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/importantDate/:userId",
      name: "studentImportantDate",
      component: () =>
        import("../components/student/dashboard/eventImportantDate.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/profile/:userId",
      name: "studentProfile",
      component: () => import("../components/student/profile/profile.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    {
      path: "/student/editProfile/:userId",
      name: "studentEditProfile",
      component: () => import("../components/student/profile/editProfile.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },
    // {
    //   path: "/student/detailProgram/:userId/:programId",
    //   name: "studentDetailProgram",
    //   component: () =>
    //     import("../components/student/dashboard/programDetail.vue"),
    //   meta: { requiresAuth: true, role: "Student" },
    // },
    {
      path: "/student/enrollCourse/:userId/:programId",
      name: "studentEnrollCourse",
      component: () => import("../components/student/enroll/enrollCourse.vue"),
      meta: { requiresAuth: true, role: "Student" },
    },

    //admin's part
    {
      path: "/admin/dashboard/:userId",
      name: "adminDashboard",
      component: () =>
        import("../components/admin/dashboard/dashBoard.vue"),
      meta: { requiresAuth: true, role: "Admin" },
    },
    // //head's part
    // {
    //   path: "/head/dashboard/:userId",
    //   name: "headDashboard",
    //   component: () =>
    //     import("../components/headProgram/dashboard/dashBoard.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },

    // {
    //   path: "/head/profile/:userId",
    //   name: "headProfile",
    //   component: () => import("../components/headProgram/profile/profile.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/addProgram/:userId",
    //   name: "headAddProgram",
    //   component: () =>
    //     import("../components/headProgram/courseProgram/addCourse.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/allProgram/:userId",
    //   name: "headAllProgram",
    //   component: () =>
    //     import("../components/headProgram/courseProgram/allProgram.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/addCourse/:userId",
    //   name: "headAddCourse",
    //   component: () =>
    //     import("../components/headProgram/courseProgram/addCourse.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/allCourse/:userId",
    //   name: "headAllCourse",
    //   component: () =>
    //     import("../components/headProgram/courseProgram/allCourse.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/allEnrollment/:userId",
    //   name: "headAllEnrollment",
    //   component: () =>
    //     import("../components/headProgram/enrollment/enrollmentStudent.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/allStudent/:userId",
    //   name: "headAllStudent",
    //   component: () =>
    //     import("../components/headProgram/dashboard/listStudent.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/profile/:userId",
    //   name: "headProfile",
    //   component: () => import("../components/headProgram/profile/profile.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },
    // {
    //   path: "/head/editProfile",
    //   name: "headEditProfile",
    //   component: () =>
    //     import("../components/headProgram/profile/editProfile.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },

    // {
    //   path: "/head/changePass/:userId",
    //   name: "headChangePass",
    //   component: () =>
    //     import("../components/headProgram/password/changePassword.vue"),
    //   meta: { requiresAuth: true, role: "Head" },
    // },





    //head of program's part
    {
      path: "/head/dashboard",
      name: "headDashboard",
      component: () =>
        import("../components/head _of_program/dashboard/dashBoard.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/profile",
      name: "headProfile",
      component: () =>
        import("../components/head _of_program/profile/profile.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/editProfile",
      name: "headEditProfile",
      component: () =>
        import("../components/head _of_program/profile/editProfile.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/program",
      name: "program",
      component: () =>
        import("../components/head _of_program/dashboard/program.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/events",
      name: "events",
      component: () =>
        import("../components/head _of_program/dashboard/events.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/enrollment",
      name: "enrollment",
      component: () =>
        import("../components/head _of_program/dashboard/enrollment.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/students",
      name: "students",
      component: () =>
        import("../components/head _of_program/dashboard/students.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/program/course_detail",
      name: "coursedetail",
      component: () =>
        import("../components/head _of_program/dashboard/courseDetail.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/program/create_new_course",
      name: "createcourse",
      component: () =>
        import("../components/head _of_program/dashboard/createNewCourse.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
    {
      path: "/head/changePass",
      name: "headChangePass",

      component: () => import("../components/student/password/changePassword.vue"),
      meta: { requiresAuth: true, role: "Head" },
    },
  ],
});

router.beforeEach((to, from, next) => {
  // Check if the route requires authentication
  const requiresAuth = to.meta.requiresAuth;

  // Check if the user is authenticated by looking for the token in local storage
  const isAuthenticated = store.state.token;

  //to ensure that user is already logout in order to login or register
  const ensureLogout = to.matched.some((record) => record.meta.ensureLogout);

  //get role from vuex, so only certain user can go to certain route
  var roles = store.state.role;

  console.log(roles);
  console.log(requiresAuth);

  // check if they have already login, so they cannot go to login, register route
  if (isAuthenticated && ensureLogout) {
    alert("you have already logged in");
    next("/");
  }

  //check if the route require login or not and if user has login yet, if not it will route to login page
  if (requiresAuth && !isAuthenticated) {
    alert("you must log in first to continue!!!");
    // If the route requires authentication and the user is not authenticated, redirect to the login page
    next("/login");
  }
  // check if the route require login or not and if our user have what role
  else if (requiresAuth && roles != null) {
    const allowedRoles = to.meta.role;

    // if their role match with their the required of the route, they can access the page, otherwise it will route to unauthorized page
    if (allowedRoles && allowedRoles.includes(roles)) {
      next();
    } else {
      alert(
        "As " +
          roles +
          ", you do not have authorized for the page to this route"
      );
      next("/unauthorized");
    }
  } else {
    next();
  }
});

export default router;
