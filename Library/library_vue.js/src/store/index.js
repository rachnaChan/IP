import { createStore } from "vuex";
import createPersistedState from "vuex-plugin-persistedstate";
import setAuthHeader from '../libs/apis/axiosConfig'

//var token = this.$store.getters.token

const store = createStore({
    state: {
        token: null,
        user: {},
        role: null,
        email: null,
        id:null,
        sideBarOpen: false


    },

    getters: {
        token: state => state.token,
        user: state => state.user,
        user: state => state.id,
        role: state => state.role,
        email: state => state.email,
        sideBarOpen: state => {
            return state.sideBarOpen
        }
    },

    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        clearTokenAndUser(state, value) {
            //whenever user logout everything inside the vuex will be deleted
            state.token = value;
            state.user = {};
            state.role = value;
        },
        setUser(state, user) {
            state.user = user;
        },
        setRole(state, role) {
            state.role = role;
        },
        setEmail(state, email) {
            state.email = email;
        },
        setId(state, id) {
            state.id = id;
        },
        toggleSidebar (state) {
            state.sideBarOpen = !state.sideBarOpen
        }

    },

    actions: {
      setAuthHeaderIfNeeded({ state }) {
          if (state.token) {
              setAuthHeader(state.token);
          } else {
              setAuthHeader(false);
          }
      },

      toggleSidebar(context) {
        context.commit('toggleSidebar')
    }


  },

    plugins: [createPersistedState(



    )],
})

export default store