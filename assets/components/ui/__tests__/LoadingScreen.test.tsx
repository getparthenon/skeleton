import { mount } from '@vue/test-utils';
import { describe, expect, test } from 'vitest';
import LoadingScreen from '../LoadingScreen.vue';

describe('LoadingScreen.vue', () => {
    test('render message', () => {
        const wrapper = mount(LoadingScreen, {
            slots: {content: "Content", loading: "Loading message"},
            propsData: {ready: false},
            global: {plugins: []}
        });

        expect(wrapper.text()).toEqual("Loading message")
    });
    test('render content', () => {
        const wrapper = mount(LoadingScreen, {
            slots: {default: "Content", message: "Loading message"},
            propsData: {ready: true},
            global: {plugins: []}
        });

        expect(wrapper.text()).toEqual("Content")
    });
})