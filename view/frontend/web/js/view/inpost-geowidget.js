define([
    'uiComponent',
    'ko',
    'jquery',
    'Magento_Checkout/js/model/quote'
], function (Component, ko, $, quote) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Smartcore_InPostInternational/inpost-geowidget',
            selectedPoint: ko.observable(null),
            isVisible: ko.observable(false)
        },

        initialize: function () {
            this._super();
            this.bindEscapeKey();
            this.loadSavedPoint();
            this.loadGeowidgetResources();
            this.createModalContainer();
            return this;
        },

        createModalContainer: function() {
            if (!$('#inpost-modal-wrapper').length) {
                $('body').append(
                    '<div id="inpost-modal-wrapper" data-bind="visible: isVisible" style="display: none;">' +
                    '<div class="modal-content">' +
                    '<a href="#" class="action-close" data-bind="click: closeWidget"></a>' +
                    '<div id="inpost-map-container"></div>' +
                    '</div>' +
                    '</div>'
                );
                ko.applyBindings(this, document.getElementById('inpost-modal-wrapper'));
            }
        },

        showWidget: function () {
            $('body').addClass('_has-inpost-modal');
            this.isVisible(true);
            setTimeout(() => this.initGeowidget(), 100);
        },

        closeWidget: function () {
            $('body').removeClass('_has-inpost-modal');
            this.isVisible(false);
            $('#inpost-map-container').empty();
        },

        initGeowidget: function () {
            const container = document.getElementById('inpost-map-container');
            if (!container) return;

            container.innerHTML = '';
            const config = window.checkoutConfig.inpostGeowidget;
            const widget = document.createElement('inpost-geowidget');

            widget.setAttribute('token', config.token);
            // widget.setAttribute('country', config.defaultCountry);
            // widget.setAttribute('language', config.language);
            widget.setAttribute('config', 'parcelCollect');
            widget.setAttribute('onpoint', 'onpointselect');

            if (config.isSandbox) {
                widget.setAttribute('sandbox', 'true');
            }

            widget.addEventListener('onpointselect', (event) => {
                this.handlePointSelection(event.detail);
            });

            container.appendChild(widget);
        },

        handlePointSelection: function(point) {
            this.selectedPoint(point);
            this.updateInpostinternationalInputField(point.name);

            const inpostMethod = $('input[type="radio"]').filter(function() {
                const methodCode = $(this).val();
                const carrierCode = methodCode.split('_')[0];
                return window.checkoutConfig.inpostGeowidget.shippingMethods.includes(carrierCode);
            }).first();

            if (inpostMethod.length) {
                inpostMethod.prop('checked', true).trigger('click');
            }

            this.savePoint(point);
            this.closeWidget();
        },

        loadGeowidgetResources: function() {
            const config = window.checkoutConfig.inpostGeowidget;
            const baseUrl = config.isSandbox
                ? 'https://sandbox-global-geowidget-sdk.easypack24.net'
                : 'https://geowidget.inpost-group.com';

            this.loadResource('link', {
                rel: 'stylesheet',
                href: `${baseUrl}/inpost-geowidget.css`
            });

            this.loadResource('script', {
                src: `${baseUrl}/inpost-geowidget.js`,
                defer: true
            });
        },

        loadResource: function(type, attributes) {
            const selector = type === 'link'
                ? `link[href="${attributes.href}"]`
                : `script[src="${attributes.src}"]`;

            if (!document.querySelector(selector)) {
                const element = document.createElement(type);
                Object.keys(attributes).forEach(key => element[key] = attributes[key]);
                document.head.appendChild(element);
            }
        },

        bindEscapeKey: function() {
            $(document).on('keyup', (e) => {
                if (e.key === 'Escape' && this.isVisible()) {
                    this.closeWidget();
                }
            });
        },

        loadSavedPoint: function() {
            const serverSavedPoint = JSON.parse(window.checkoutConfig.inpostGeowidget.savedPoint);

            let localStoragePoint = null;
            try {
                const stored = localStorage.getItem('inpostinternational_locker_id');
                if (stored) {
                    localStoragePoint = JSON.parse(stored);
                }
            } catch (e) {
                console.warn('Failed to load point from localStorage:', e);
            }

            const pointToUse = serverSavedPoint || localStoragePoint;

            if (pointToUse) {
                this.selectedPoint(pointToUse);
                this.updateInpostinternationalInputField(pointToUse);

                if (localStoragePoint && !serverSavedPoint) {
                    this.savePoint(pointToUse);
                }
            }
        },

        updateInpostinternationalInputField: function(pointToUse) {
            const observer = new MutationObserver((mutations) => {
                const field = $('[name="inpostinternational_locker_id"]');
                if (field.length) {
                    field.val(pointToUse.name);
                    observer.disconnect();
                }
            });

            observer.observe(document.body, { childList: true, subtree: true });
        },

        savePoint: function(point) {
            let pointData = JSON.stringify(point);

            localStorage.setItem('inpostinternational_locker_id', pointData);

            return $.ajax({
                url: window.checkoutConfig.inpostGeowidget.savePointUrl,
                type: 'POST',
                data: {
                    point_data: pointData,
                    point_id: point.name,
                },
                dataType: 'json'
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to sync point with server:', textStatus, errorThrown);
            });
        }
    });
});
