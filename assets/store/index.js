import { createStore } from 'vuex';
import {user} from "./user";

export const store = createStore({
    modules: {
        user
    }
});