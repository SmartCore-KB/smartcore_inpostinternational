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

                quote.shippingMethod.subscribe(this.onShippingMethodChange.bind(this));

                return this;
            },

            onShippingMethodChange: function(method) {
                if (!method) return;

                const inpostMethods = window.checkoutConfig.inpostGeowidget?.shippingMethods || [];
                const isInpostMethod = inpostMethods.includes(method.carrier_code);

                if (isInpostMethod && this.geowidget && this.geowidget.selectedPoint()) {
                    this.geowidget.updateInpostinternationalInputField(this.geowidget.selectedPoint());
                }
            },

            getTemplateForMethod: function(method) {
                const inpostMethods = window.checkoutConfig.inpostGeowidget?.shippingMethods || [];
                return inpostMethods.includes(method.carrier_code)
                    ? 'Smartcore_InPostInternational/shipping-method-item'
                    : 'Magento_Checkout/shipping-address/shipping-method-item';
            },

            showInpostWidget: function() {
                if (this.geowidget) {
                    this.geowidget.showWidget();
                }
            },

            getSelectedPoint: function() {
                return this.geowidget ? this.geowidget.selectedPoint() : null;
            },

            validateShippingInformation: function () {
                const originalResult = this._super();
                if (!originalResult) return false;

                const method = quote.shippingMethod();
                const inpostMethods = window.checkoutConfig.inpostGeowidget?.shippingMethods || [];

                if (method && inpostMethods.includes(method.carrier_code)) {
                    let pointSelected = $('[name="inpostinternational_locker_id"]').val();
                    const selectedPoint = this.getSelectedPoint();

                    if (!pointSelected && selectedPoint) {
                        setTimeout(() => {
                            this.geowidget.updateInpostinternationalInputField(selectedPoint);
                            $('button.continue').trigger('click');
                        }, 100);
                        return false;
                    }

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
