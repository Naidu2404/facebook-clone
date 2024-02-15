const state = {
    userData: {
        user: null,
        userStatus: true,
    },
};

const getters = {
    authUser: (state) => {
        return state.userData;
    },
};

const actions = {
    fetchAuthUser({ commit, state }) {
        axios
            .get("/api/auth-user")
            .then((res) => {
                commit("setAuthUser", res.data);
            })
            .catch((error) => {
                console.log("unable to fetch auth user");
            });
    },
};

const mutations = {
    setAuthUser(state, user) {
        state.userData.user = user;
        state.userData.userStatus = false;
    },
};

export default {
    state,
    actions,
    getters,
    mutations,
};
