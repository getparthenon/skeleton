import SubmitButton from "./SubmitButton";
import LoadingMessage from "./LoadingMessage";
import LoadingScreen from "./LoadingScreen";

const ParthenonUI = {
    install(Vue, options) {
        Vue.component("LoadingScreen", LoadingScreen);
        Vue.component("LoadingMessage", LoadingMessage);
        Vue.component("SubmitButton", SubmitButton);
    }
};

// Automatic installation if Vue has been added to the global scope.
if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(ParthenonUI);
}

export default ParthenonUI;