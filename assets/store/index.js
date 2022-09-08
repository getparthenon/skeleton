import { createStore } from 'vuex';
import {userStore} from "./user";
import {teamStore} from "./team";

export const store = createStore({
    modules: {
        userStore,
        teamStore,
    }
});