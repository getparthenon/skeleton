
const ParthenonMenu = {
    install(Vue, options) {

    }
};

// Automatic installation if Vue has been added to the global scope.
if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(ParthenonMenu);
}

export default ParthenonMenu;