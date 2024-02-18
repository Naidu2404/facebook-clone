const state = {
    user: null,
    userStatus: true,
};

const getters = {
    user: (state) => {
        return state.user;
    },
    friendship: (state) => {
        return state.user.data.attributes.friendship;
    },
    friendButtonText: (state, getters, rootState) => {
        // if (rootState.User.user) {
        if (getters.friendship === null) {
            return "Add Friend";
        } else if (
            rootState.User.user &&
            getters.friendship.data.attributes.confirmed_at === null &&
            getters.friendship.data.attributes.friend_id !==
                rootState.User.user.data.user_id
        ) {
            return "Pending Friend Request";
        } else if (getters.friendship.data.attributes.confirmed_at !== null) {
            return "";
        }
        // }
        return "Accept";
    },
};

const actions = {
    fetchUser({ commit, dispatch }, userId) {
        axios
            .get("/api/users/" + userId)
            .then((res) => {
                commit("setUser", res.data);
                commit("setUserStatus", "success");
            })
            .catch((error) => {
                commit("setUserStatus", "error");
            });
    },
    sendFriendRequest({ commit, state }, friendId) {
        axios
            .post("/api/friend-request", { friend_id: friendId })
            .then((res) => {
                commit("setUserFriendship", res.data);
            })
            .catch((error) => {});
    },
    acceptFriendRequest({ commit, state }, userId) {
        axios
            .post("/api/friend-request-response", {
                user_id: userId,
                status: 1,
            })
            .then((res) => {
                commit("setUserFriendship", res.data);
            })
            .catch((error) => {});
    },
    ignoreFriendRequest({ commit, state }, userId) {
        axios
            .delete("/api/friend-request-response/delete", {
                data: { user_id: userId },
            })
            .then((res) => {
                commit("setUserFriendship", null);
            })
            .catch((error) => {});
    },
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setUserFriendship(state, friendship) {
        state.user.data.attributes.friendship = friendship;
    },
    setUserStatus(state, status) {
        state.userStatus = status;
    },
};

export default {
    state,
    actions,
    getters,
    mutations,
};
