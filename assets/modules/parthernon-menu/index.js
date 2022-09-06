import Menu from "./compoents/Menu";
import MenuGroup from "./compoents/MenuGroup";
import MenuItem from "./compoents/MenuItem";

const ParthenonMenu = {
    install(Vue, options) {

        Vue.component("Menu", Menu);
        Vue.component("MenuGroup", MenuGroup);
        Vue.component("MenuItem", MenuItem);
    }
};

// Automatic installation if Vue has been added to the global scope.
if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(ParthenonMenu);
}

export default ParthenonMenu;