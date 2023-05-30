import { createStore } from 'vuex';

export default createStore({

    // Store options will be defined here
    state: {
        // Define your state variables here
        userId: null
      },
      mutations: {
        // Define your mutations here
        setUserId(state, userId) {
            state.userId = userId;
          },

      },
      actions: {
        // Define your actions here
        updateUserId({ commit }, userId) {
            commit('setUserId', userId);
          },

      }

  });
  