; (function ($) {
    'use strict';
    $.extend($.fn, {
        fadeIn: function (speed, complete) {
            $(this).css({ display: 'block', opacity: 1 });
            complete && typeof (complete) === 'function' && complete();
            return this;
        },
        fadeOut: function (speed, complete) {
            $(this).css({ opacity: 0 });
            complete && typeof (complete) === 'function' && complete();
            return this;
        }
    });

    $.lightbox = function ($this, options) {
        this.settings = $.extend(true, {}, $.lightbox.defaults, options);
        this.$el = $this;      // parent container holding items
        this.$box = null;      // the lightbox modal
        this.$items = null;    // recomputed each time its opened
        this.idx = 0;          // of the $items which index are we on
        this.enable();
    };

    $.lightbox.defaults = {
        theme: 'lightbox',        // class name parent gets (for your css)
        selector: null,        // the selector to delegate to, should be to the <a> which contains an <img>
        prev: '&larr;',        // use an image, text, whatever for the previous button
        next: '&rarr;',        // use an image, text, whatever for the next button
        loading: '%',          // use an image, text, whatever for the loading notification
        close: '&times;',      // use an image, text, whatever for the close button
        speed: 400,            // speed to fade in or out
        zIndex: 1000,          // zIndex to apply to the outer container
        cycle: true,           // whether to cycle through galleries or stop at ends
        captionAttr: 'title',  // name of the attribute to grab the caption from
        template: 'image',     // the default template to be used (see templates below)
        templates: {           // define templates to create the elements you need function($item, settings)
            image: function ($item, settings, callback) {
                return $('<img src="' + $item.attr('href') + '"class="' + settings.theme + '-content"/>').on('load', callback);
            }
        }
    };

    $.lightbox.setDefaults = function (options) {
        $.lightbox.defaults = $.extend(true, {}, $.lightbox.defaults, options);
    };

    $.lightbox.lookup = { i: 0 };

    $.extend($.lightbox.prototype, {
        enable: function () {
            var t = this;

            return t.$el.on('click.lightbox', t.settings.selector, function (e) {
                e.preventDefault();
                t.open(this);
            });
        },
        open: function (i) {
            var t = this;

            // figure out where to start
            t.$items = t.settings.selector === null ? t.$el : t.$el.find(t.settings.selector);
            if (isNaN(i)) {
                i = t.$items.index(i);
            }

            // build the lightbox
            t.$box = $('<div class="' + t.settings.theme + '"style="display:none;">' +
                '<a href="#"class="' + t.settings.theme + '-close ' + t.settings.theme + '-button">' + t.settings.close + '</a>' +
                '<a href="#"class="' + t.settings.theme + '-prev ' + t.settings.theme + '-button">' + t.settings.prev + '</a>' +
                '<a href="#"class="' + t.settings.theme + '-next ' + t.settings.theme + '-button">' + t.settings.next + '</a>' +
                '<div class="' + t.settings.theme + '-contents"></div>' +
                '<div class="' + t.settings.theme + '-caption"><p></p></div>' +
                '</div>').appendTo('body').css('zIndex', t.settings.zIndex).fadeIn(t.settings.speed)
                .on('click.lightbox', '.' + t.settings.theme + '-close', function (e) { e.preventDefault(); t.close(); })
                .on('click.lightbox', '.' + t.settings.theme + '-next', function (e) { e.preventDefault(); t.next(); })
                .on('click.lightbox', '.' + t.settings.theme + '-prev', function (e) { e.preventDefault(); t.prev(); })
                .on('click.lightbox', '.' + t.settings.theme + '-contents', function (e) {
                    e.preventDefault();
                    // if the content is clicked, go to the next, otherwise close
                    if ($(e.target).hasClass(t.settings.theme + '-content') && t.$items.length > 1) {
                        t.next();
                    } else {
                        t.close();
                    }
                });

            // add some key hooks
            $(document).on('swipeLeft.lightbox', function (e) { t.next(); })
                .on('swipeRight.lightbox', function (e) { t.prev(); })
                .on('keydown.lightbox', function (e) {
                    e.preventDefault();
                    var key = (window.event) ? event.keyCode : e.keyCode;
                    switch (key) {
                        case 27: t.close(); break; // escape key closes
                        case 37: t.prev(); break;  // left arrow to prev
                        case 39: t.next(); break;  // right arrow to next
                    }
                });

            t.$el.trigger('lightbox:open', [t]);
            t.goto(i);
            return t.$el;
        },
        close: function () {
            var t = this;

            if (t.$box && t.$box.length) {
                t.$box.fadeOut(t.settings.speed, function (e) {
                    t.$box.remove();
                    t.$box = null;
                    t.$el.trigger('lightbox:close', [t]);
                });
            }
            $(document).off('.lightbox');

            return t.$el;
        },
        goto: function (i) {
            var t = this,
                $item = $(t.$items[i]),
                captionVal = $item.attr(t.settings.captionAttr),
                $cap = t.$box.children('.' + t.settings.theme + '-caption')[captionVal ? 'show' : 'hide']().children('p').text(captionVal),
                $bi = t.$box.children('.' + t.settings.theme + '-contents'),
                $img = null;

            if ($item.length) {
                t.idx = i;
                $bi.html('<div class="' + t.settings.theme + '-loading ' + t.settings.theme + '-button">' + t.settings.loading + '</div>');

                $img = t.settings.templates[$item.data('lightbox-template') || t.settings.template]($item, t.settings, function (content) {
                    $bi.empty().append($(this));
                });

                if (t.$items.length == 1 || !t.settings.cycle) {
                    t.$box.children('.' + t.settings.theme + '-prev')[i <= 0 ? 'hide' : 'show']();
                    t.$box.children('.' + t.settings.theme + '-next')[i >= t.$items.length - 1 ? 'hide' : 'show']();
                }
                t.$el.trigger('lightbox:goto', [t, i, $item, $img]);
            }
            return t.$el;
        },
        prev: function () {
            var t = this;
            return t.goto(t.idx === 0 ? t.$items.length - 1 : t.idx - 1);
        },
        next: function () {
            var t = this;
            return t.goto(t.idx === t.$items.length - 1 ? 0 : t.idx + 1);
        },
        disable: function () {
            var t = this;
            return t.close().off('.lightbox').trigger('lightbox:disable', [t]);
        },
        destroy: function () {
            var t = this;
            return t.disable().removeData('lightbox').trigger('lightbox:destroy');
        },
        option: function (key, val) {
            var t = this;
            if (val !== undefined) {
                t.settings[key] = val;
                return t.disable().enable();
            }
            return t.settings[key];
        }
    });

    $.fn.lightbox = function (o) {
        o = o || {};
        var tmp_args = Array.prototype.slice.call(arguments);

        if (typeof (o) == 'string') {
            if (o == 'option' && typeof (tmp_args[1]) == 'string' && tmp_args.length === 2) {
                var inst = $.lightbox.lookup[$(this).data('lightbox')];
                return inst[o].apply(inst, tmp_args.slice(1));
            }
            else return this.each(function () {
                var inst = $.lightbox.lookup[$(this).data('lightbox')];
                inst[o].apply(inst, tmp_args.slice(1));
            });
        } else return this.each(function () {
            var $t = $(this);
            $.lightbox.lookup[++$.lightbox.lookup.i] = new $.lightbox($t, o);
            $t.data('lightbox', $.lightbox.lookup.i);
        });
    };

})(Zepto)