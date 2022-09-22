
import {planservice} from "../planservice";

import axios from "axios";
import MockAdapter from "axios-mock-adapter";
import { describe, it, expect, beforeAll, afterEach } from 'vitest'

// This sets the mock adapter on the default instance
var mock = new MockAdapter(axios);

describe("planservice", () => {
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

    describe("Fetch Plan Info", () => {
        it("Should return response if successful", async () => {

            mock.onGet(`/api/payments/plans`).reply(200, {success: true});

            // when
            const result = await planservice.fetchPlanInfo();

            // then
            expect(mock.history.get[0].url).toEqual(`/api/payments/plans`);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            mock.onGet(`/api/payments/plans`).reply(400, {success: false, error: "Error message here"});

            try {
                await planservice.fetchPlanInfo();
                fail("Didn't throw error");
            } catch (error) {
                expect(mock.history.get[0].url).toEqual(`/api/payments/plans`);
                expect(error).toEqual("Error message here");

            }
        });
    });
    describe("Change Plan", () => {
        it("Should return response if successful", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/change/` + planName + '/' + paymentSchedule).reply(200, {success: true});

            // when
            const result = await planservice.changePlan(planName, paymentSchedule)

            // then
            expect(mock.history.post[0].url).toEqual(`/api/payments/plans/change/` + planName + '/' + paymentSchedule);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/change/` + planName + '/' + paymentSchedule).reply(400, {success: false, error: "Error message here"});

            try {
                await planservice.changePlan(planName, paymentSchedule);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.post[0].url).toEqual(`/api/payments/plans/change/` + planName + '/' + paymentSchedule);
                expect(error).toEqual("Error message here");

            }
        });
    })

    describe("Create Checkout", () => {
        it("Should return response if successful", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule).reply(200, {success: true});

            // when
            const result = await planservice.createCheckout(planName, paymentSchedule)

            // then
            expect(mock.history.post[0].url).toEqual(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule).reply(400, {success: false, error: "Error message here"});

            try {
                await planservice.createCheckout(planName, paymentSchedule);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.post[0].url).toEqual(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule);
                expect(error).toEqual("Error message here");

            }
        });
    });
    describe("Create Per Seat Checkout", () => {
        it("Should return response if successful", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule, {seats: 1}).reply(200, {success: true});

            // when
            const result = await planservice.createPerSeatCheckout(planName, paymentSchedule, 1)

            // then
            expect(mock.history.post[0].url).toEqual(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            const planName = "plan-name";
            const paymentSchedule = "payment-schedule";

            mock.onPost(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule, {seats: 1}).reply(400, {success: false, error: "Error message here"});

            try {
                await planservice.createPerSeatCheckout(planName, paymentSchedule, 1);
                fail("Didn't throw error")
            } catch (error) {
                expect(mock.history.post[0].url).toEqual(`/api/payments/plans/checkout/` + planName + '/' + paymentSchedule);
                expect(error).toEqual("Error message here");

            }
        });
    });

    describe("Cancel", () => {
        it("Should return response if successful", async () => {

            mock.onPost(`/api/payments/cancel`).reply(200, {success: true});

            // when
            const result = await planservice.cancel();

            // then
            expect(mock.history.post[0].url).toEqual(`/api/payments/cancel`);
            expect(result.data).toEqual({success: true});
        });

        it("Should return error", async () => {

            mock.onPost(`/api/payments/cancel`).reply(400, {success: false, error: "Error message here"});

            try {
                await planservice.cancel();
                fail("Didn't throw error");
            } catch (error) {
                expect(mock.history.post[0].url).toEqual(`/api/payments/cancel`);
                expect(error).toEqual("Error message here");

            }
        });
    });
})