import { mount } from '@vue/test-utils';
import { describe, expect, test } from 'vitest';
import { TypeComponentsMap } from '@element-plus/utils';
import LoadingMessage from '../LoadingMessage.vue';

describe('LoadingMessage.vue', () => {
    const mockRoute = {
        params: {
            id: 1
        }
    }
    test('render test', () => {
        const wrapper = mount(() => <LoadingMessage>Hello</LoadingMessage>, {
            global: {plugins: []}
        });
        expect(wrapper.find('span').text()).toEqual("Hello")
    })
})