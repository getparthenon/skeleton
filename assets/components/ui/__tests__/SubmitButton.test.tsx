import { mount } from '@vue/test-utils';
import { describe, expect, test } from 'vitest';
import SubmitButton from '../SubmitButton.vue';

describe('SubmitButton.vue', () => {
    test('render content', () => {
        const wrapper = mount(SubmitButton, {
            slots: {default: "Content"},
            propsData: {inProgress: false},
            global: {plugins: []}
        });

        expect(wrapper.text()).toEqual("Content")
    });
    test('render message', () => {
        const wrapper = mount(SubmitButton, {
            slots: {default: "Content"},
            propsData: {inProgress: true},
            global: {plugins: []}
        });


        expect(wrapper.text()).toEqual("In Progress")
    });

    test('render loading message from prop', () => {
        const wrapper = mount(SubmitButton, {
            slots: {default: "Content"},
            propsData: {inProgress: true, loadingText: "Submitting"},
            global: {plugins: []}
        });


        expect(wrapper.text()).toEqual("Submitting")
    });

    test('render loading message from slot', () => {
        const wrapper = mount(SubmitButton, {
            slots: {default: "Content", loading: "Loading..."},
            propsData: {inProgress: true, loadingText: "Submitting"},
            global: {plugins: []}
        });


        expect(wrapper.text()).toEqual("Loading...")
    });
})