
import {userservice} from "../userservice";

import axios from "axios";
import MockAdapter from "axios-mock-adapter";

// This sets the mock adapter on the default instance
var mock = new MockAdapter(axios);

// Mock any GET request to /users
// arguments for reply are (status, data, headers)
mock.onGet("/users").reply(200, {
    users: [{ id: 1, name: "John Smith" }],
});

describe("userService", () => {
    let mock;

    beforeAll(() => {
        mock = new MockAdapter(axios);
        axios.defaults.validateStatus = function () {
            return true;
        };
    });

    afterEach(() => {
        mock.reset();
    });

    describe("When doing confirm email", () => {
        it("Should return response if successful", async () => {

            var code = "a-random-code";

            mock.onGet(`/api/user/confirm/`+code).reply(200, {success: true});

            // when
            const result = await userservice.confirmEmail(code)

            // then
            expect(mock.history.get[0].url).toEqual(`/api/user/confirm/`+code);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            var code = "a-random-code";

            mock.onGet(`/api/user/confirm/`+code).reply(400, {success: false, error: "Invalid code"});

            try {
                await  userservice.confirmEmail(code);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.get[0].url).toEqual(`/api/user/confirm/`+code);
                expect(error).toEqual("Invalid code");

            }
        });
    })

    describe("When doing reset password check", () => {
        it("Should return response if successful", async () => {

            var code = "a-random-code";

            mock.onGet(`/api/user/reset/`+code).reply(200, {success: true});

            // when
            const result = await userservice.forgotPasswordCheck(code)

            // then
            expect(mock.history.get[0].url).toEqual(`/api/user/reset/`+code);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            var code = "a-random-code";

            mock.onGet(`/api/user/reset/`+code).reply(400, {success: false, error: "Invalid code"});

            try {
                await  userservice.forgotPasswordCheck(code);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.get[0].url).toEqual(`/api/user/reset/`+code);
                expect(error).toEqual("Invalid code");

            }
        });
    });

    describe("When sending the new password during the reset password", () => {
        it("Should return response if successful", async () => {

            var code = "a-random-code";
            var newPassword = "a-new-password";
            mock.onPost(`/api/user/reset/`+code, {password: newPassword}).reply(200, {success: true});

            // when
            const result = await userservice.forgotPasswordConfirm(code, newPassword)

            // then
            expect(mock.history.post[0].url).toEqual(`/api/user/reset/`+code);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            var code = "a-random-code";
            var newPassword = "a-new-password";

            mock.onPost(`/api/user/reset/`+code, {password: newPassword}).reply(400, {success: false, error: "Invalid code"});

            try {
                await  userservice.forgotPasswordConfirm(code, newPassword);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.post[0].url).toEqual(`/api/user/reset/`+code);
                expect(error).toEqual("Invalid code");

            }
        });
    });
})