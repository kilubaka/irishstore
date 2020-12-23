/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    /**
     * @param {String} url
     * @param {*} fromPages
     */
    function processReviews(url, fromPages) {
        $('.items.review-items').fadeTo( "fast", 0);
        $.ajax({
            url: url,
            cache: true,
            dataType: 'html',
            showLoader: false,
            loaderContext: $('.product.data.items')
        }).done(function (data) {
            $('.items.review-items').fadeTo( "fast", 0.5);
            $('#product-review-container').html(data).trigger('contentUpdated');
            $('.items.review-items').fadeTo( "fast", 1);
            $('[data-role="product-review"] .pages a').each(function (index, element) {
                $(element).click(function (event) { //eslint-disable-line max-nested-callbacks
                    processReviews($(element).attr('href'), true);
                    event.preventDefault();
                });
            });
        }).complete(function () { });
    }

    return function (config) {

        processReviews(config.productReviewUrl);

        $(function () {
            $('.product-info-main .reviews-actions a').click(function (event) {
                var anchor, addReviewBlock;

                event.preventDefault();
                anchor = $(this).attr('href').replace(/^.*?(#|$)/, '');
                addReviewBlock = $('#' + anchor);

            });
        });
    };
});
