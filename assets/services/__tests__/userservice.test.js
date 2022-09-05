
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

            axios.defaults.validateStatus = function () {
                return true;
            };
            mock.onGet(`/api/user/confirm/`+code).reply(400, {success: false, error: "Invalid code"});

            userservice.confirmEmail(code).then(form => {}, error => {

                expect(mock.history.get[0].url).toEqual(`/api/user/confirm/`+code);
                expect(error).toEqual("Invalid code");
            });

        });
    });
})