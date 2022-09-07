import { mount } from '@vue/test-utils';
import { describe, expect, test } from 'vitest';
import { TypeComponentsMap } from '@element-plus/utils';
import MenuItem from '../components/MenuItem.vue';
import VueRouter, {createMemoryHistory, createRouter, createWebHistory} from 'vue-router';


const router = createRouter({
    history: createMemoryHistory("/"),
    routes: [
        {
            name: 'app.home',
            path: '/home'
        },
        {
            name: 'root',
            path: '/',
        }
    ]
});


describe('MenuItem.vue', () => {
    const mockRoute = {
        params: {
            id: 1
        }
    }
    test('render test', () => {
        const wrapper = mount(() => <MenuItem route-name="app.home">Hello</MenuItem>, {
            global: {plugins: [router]}
        });
        expect(wrapper.find('.menu-link').text()).toEqual("Hello")
    })

    test('render test class', () => {
        const wrapper = mount(() => <MenuItem route-name="app.home" link-class="second-link">Hello</MenuItem>, {
            global: {plugins: [router]}
        })
        expect(wrapper.find('.second-link').text()).toEqual("Hello")
    })
})