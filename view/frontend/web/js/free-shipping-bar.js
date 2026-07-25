/**
 * SomePlus Free Shipping Bar - KnockoutJS Component
 */
define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data'
], function (Component, ko, customerData) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'SomePlus_FreeShippingBar/free-shipping-bar',
            position: 'header'
        },

        /** @inheritdoc */
        initialize: function () {
            this._super();
            this.freeShippingBar = customerData.get('free-shipping-bar');
            return this;
        },

        /**
         * Check if bar is enabled for this position
         * @returns {Boolean}
         */
        isVisible: function () {
            var data = this.freeShippingBar();
            if (!data || !data.enabled) {
                return false;
            }

            var position = this.position;
            switch (position) {
                case 'header':
                    return data.showInHeader || false;
                case 'minicart':
                    return data.showInMinicart || false;
                case 'cart':
                    return data.showInCart || false;
                case 'checkout':
                    return data.showInCheckout || false;
                default:
                    return true;
            }
        },

        /**
         * Get current progress percentage
         * @returns {Number}
         */
        getPercentage: function () {
            var data = this.freeShippingBar();
            return data && data.progress ? data.progress.percentage : 0;
        },

        /**
         * Get progress bar width style
         * @returns {String}
         */
        getProgressWidth: function () {
            return this.getPercentage() + '%';
        },

        /**
         * Get current message
         * @returns {String}
         */
        getMessage: function () {
            var data = this.freeShippingBar();
            return data && data.progress ? data.progress.message : '';
        },

        /**
         * Check if free shipping is achieved
         * @returns {Boolean}
         */
        isAchieved: function () {
            var data = this.freeShippingBar();
            return data && data.progress ? data.progress.achieved : false;
        },

        /**
         * Get progress bar fill color
         * @returns {String}
         */
        getBarColor: function () {
            var data = this.freeShippingBar();
            if (!data || !data.design) {
                return '#10b981';
            }
            return this.isAchieved() ? data.design.achievedColor : data.design.barColor;
        },

        /**
         * Get progress bar background color
         * @returns {String}
         */
        getBgColor: function () {
            var data = this.freeShippingBar();
            return data && data.design ? data.design.bgColor : '#e5e7eb';
        },

        /**
         * Get text color
         * @returns {String}
         */
        getTextColor: function () {
            var data = this.freeShippingBar();
            return data && data.design ? data.design.textColor : '#374151';
        },

        /**
         * Get CSS classes for the bar container
         * @returns {String}
         */
        getContainerClasses: function () {
            var classes = ['fsb-container', 'fsb-position-' + this.position];
            if (this.isAchieved()) {
                classes.push('fsb-achieved');
            }
            return classes.join(' ');
        }
    });
});
