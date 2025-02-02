define([
    'Magento_Ui/js/form/element/select',
    'jquery',
    'mage/url',
    'ko'
], function (Select, $, urlBuilder, ko) {
    'use strict';

    return Select.extend({
        defaults: {
            template: 'Smartcore_InPostInternational/form/element/select-pickup-address',
            tracks: {
                pickupCutoffForAddress: true
            }
        },

        initialize: function () {
            this._super();
            this.pickupCutoffForAddress = ko.observable('');
            this.onChange(this.value());

            return this;
        },

        onChange: function (element) {
            if (element) {
                if (typeof element === 'object' && typeof element.value === 'function') {
                    this.requestForCutoffTime(element.value());
                } else {
                    this.requestForCutoffTime(element);
                }
            } else {
                this.pickupCutoffForAddress('');
            }
        },

        requestForCutoffTime: function (addressId) {
            var self = this;

            $.ajax({
                url: window.location.origin + '/admin/inpostinternational/pickup/cutofftime',
                data: {
                    addressId: addressId,
                    form_key: window.FORM_KEY
                },
                type: 'POST',
                dataType: 'json',
                showLoader: true
            }).done(function (response) {
                if (response.success) {
                    self.updatePickupCutoffForAddress(response.info);
                } else {
                    self.updatePickupCutoffForAddress('Error occurred while fetching cutoff time');
                }
            }).fail(function (jqXHR) {
                self.updatePickupCutoffForAddress(
                    'Unable to check pickup cutoff time. Request failed: ' + jqXHR.responseText
                );
            });
        },

        updatePickupCutoffForAddress: function (text) {
            this.pickupCutoffForAddress(text);
        }
    });
});
