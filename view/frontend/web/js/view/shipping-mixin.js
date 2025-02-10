define([
    'jquery',
    'ko',
    'Magento_Checkout/js/model/quote',
    'uiRegistry'
], function ($, ko, quote, registry) {
    'use strict';

    return function (shipping) {
        return shipping.extend({
            defaults: {
                shippingMethodListTemplate: 'Smartcore_InPostInternational/shipping-address/shipping-method-list'
            },

            initialize: function() {
                this._super();
                registry.get('checkout.inpost-geowidget', (component) => {
                    this.geowidget = component;
                });
                return this;
            },

            getTemplateForMethod: function(method) {
                const inpostMethods = window.checkoutConfig.inpostGeowidget?.shippingMethods || [];
                return inpostMethods.includes(method.carrier_code)
                    ? 'Smartcore_InPostInternational/shipping-method-item'
                    : 'Magento_Checkout/shipping-address/shipping-method-item';
            },

            showInpostWidget: function() {
                const geowidget = registry.get('checkout.inpost-geowidget');
                if (geowidget) {
                    geowidget.showWidget();
                }
            },

            getSelectedPoint: function() {
                const geowidget = registry.get('checkout.inpost-geowidget');
                return geowidget ? geowidget.selectedPoint() : null;
            },

            validateShippingInformation: function () {
                const originalResult = this._super();
                if (!originalResult) return false;

                const method = quote.shippingMethod();
                const inpostMethods = window.checkoutConfig.inpostGeowidget?.shippingMethods || [];

                if (inpostMethods.includes(method.carrier_code)) {
                    const pointSelected = $('[name="inpostinternational_locker_id"]').val();
                    if (!pointSelected) {
                        this.errorValidationMessage('Please select pickup point');
                        return false;
                    }
                }
                return true;
            }
        });
    };
});
