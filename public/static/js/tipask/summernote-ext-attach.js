(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        // Node/CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(window.jQuery);
    }
}(function ($) {
    // Extends plugins for adding hello.
    //  - plugin is external module for customizing.
    $.extend($.summernote.plugins, {
        /**
         * @param {Object} context - context object has status of editor.
         */
        'attachment': function (context) {
            var self = this;

            // ui has renders to build ui elements.
            //  - you can create a button with `ui.button`
            var ui = $.summernote.ui;

            var $editor = context.layoutInfo.editor;
            var options = context.options;
            var lang = options.langInfo;


            // add hello button
            context.memo('button.attachment', function () {
                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-paperclip" aria-hidden="true"></i>',
                    tooltip: '上传附件',
                    click:function(){
                        self.show();
                    }

                });

                // create jQuery object from button instance.
                var $hello = button.render();
                return $hello;
            });

            // This events will be attached when editor is initialized.
            this.events = {
                // This will be called after modules are initialized.
                'summernote.init': function (we, e) {
                    console.log('summernote initialized', we, e);
                },
                // This will be called when user releases a key on editable.
                'summernote.keyup': function (we, e) {
                    console.log('summernote keyup', we, e);
                }
            };

            // This method will be called when editor is initialized by $('..').summernote();
            // You can create elements for plugin
            this.initialize = function () {
                var $container = options.dialogsInBody ? $(document.body) : $editor;

                var attachmentLimitation = '';
                if (options.maximumattachmentFileSize) {
                    var unit = Math.floor(Math.log(options.maximumattachmentFileSize) / Math.log(1024));
                    var readableSize = (options.maximumattachmentFileSize / Math.pow(1024, unit)).toFixed(2) * 1 +
                        ' ' + ' KMGTP'[unit] + 'B';
                    attachmentLimitation = '<small>' + lang.attachment.maximumFileSize + ' : ' + readableSize + '</small>';
                }
                var body = '<div class="form-group note-group-select-from-files">' +
                    '<label>' + lang.image.selectFromFiles + '</label>' +
                    '<input class="note-attachment-input form-control" type="file" name="files" accept="application/zip,application/x-gzip,application/pdf,application/msword,application/ocelet-stream,application/x-tar,video/mp4" />' +
                    attachmentLimitation +
                    '</div>';
                var footer = '<button href="#" class="btn btn-primary note-attachment-btn">确认</button>';

                self.$dialog = ui.dialog({
                    title: '插入附件',
                    fade: options.dialogsFade,
                    body: body,
                    footer: footer
                }).render().appendTo($container);

            };


            self.show = function () {
                context.invoke('editor.saveRange');
                self.showAttachDialog().then(function (data) {
                    // [workaround] hide dialog before restore range for IE range focus
                    ui.hideDialog(self.$dialog);
                    context.invoke('editor.restoreRange');

                    if (typeof data === 'string') { // image url
                        console.log('string:'+data);
                        //context.invoke('editor.insertAttachment', data);
                    } else { // array of files
                        var linkData = {isNewWindow:true};
                        var forData = new FormData();
                        console.log(data[0]);
                        forData.append("file", data[0]);
                        $.ajax({
                            data: forData,
                            type: "POST",
                            dataType : 'json',
                            url: "/attach/upload",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(result) {
                                if( result.code!=0 ){
                                    alert('上传失败：'+result.message);
                                    return false;
                                }
                                linkData.text = result.message.name;
                                linkData.url = result.message.url;
                                context.invoke('editor.createLink',linkData);
                            },
                            error:function(){
                                alert('文件上传失败！');
                            }
                        });
                        console.log('upload:'+data);
                        //context.invoke('editor.insertAttachmentOrCallback', data);
                    }
                }).fail(function () {
                    context.invoke('editor.restoreRange');
                });
            };

            self.showAttachDialog = function () {
                return $.Deferred(function (deferred) {
                    var $attachmentInput = self.$dialog.find('.note-attachment-input'),
                        $attachmentUrl = self.$dialog.find('.note-attachment-url'),
                        $attachmentBtn = self.$dialog.find('.note-attachment-btn');

                    ui.onDialogShown(self.$dialog, function () {
                        context.triggerEvent('dialog.shown');
                        // Cloning attachmentInput to clear element.
                        $attachmentInput.replaceWith($attachmentInput.clone()
                                .on('change', function () {
                                    deferred.resolve(this.files || this.value);
                                })
                                .val('')
                        );

                        $attachmentBtn.click(function (event) {
                            event.preventDefault();

                            deferred.resolve($attachmentUrl.val());
                        });

                        $attachmentUrl.on('keyup paste', function () {
                            var url = $attachmentUrl.val();
                            ui.toggleBtn($attachmentBtn, url);
                        }).val('').trigger('focus');
                        self.bindEnterKey($attachmentUrl, $attachmentBtn);

                    });

                    ui.onDialogHidden(self.$dialog, function () {
                        $attachmentInput.off('change');
                        $attachmentUrl.off('keyup paste keypress');
                        $attachmentBtn.off('click');

                        if (deferred.state() === 'pending') {
                            deferred.reject();
                        }

                    });

                    ui.showDialog(self.$dialog);

                });
            };


            /**
             * insert image
             *
             * @param {String} src
             * @param {String|Function} param
             * @return {Promise}
             */
            this.insertAttach = function (src, param) {
                return async.createImage(src, param).then(function ($image) {
                    beforeCommand();

                    if (typeof param === 'function') {
                        param($image);
                    } else {
                        if (typeof param === 'string') {
                            $image.attr('data-filename', param);
                        }
                        $image.css('width', Math.min($editable.width(), $image.width()));
                    }

                    $image.show();
                    range.create(editable).insertNode($image[0]);
                    range.createFromNodeAfter($image[0]).select();
                    afterCommand();
                }).fail(function (e) {
                    context.triggerEvent('image.upload.error', e);
                });
            };

            /**
             * insertImages
             * @param {File[]} files
             */
            this.insertAttaches = function (files) {
                $.each(files, function (idx, file) {
                    var filename = file.name;
                    if (options.maximumImageFileSize && options.maximumImageFileSize < file.size) {
                        context.triggerEvent('attach.upload.error', lang.image.maximumFileSizeError);
                    } else {
                        async.readFileAsDataURL(file).then(function (dataURL) {
                            return self.insertAttach(dataURL, filename);
                        }).fail(function () {
                            context.triggerEvent('image.upload.error');
                        });
                    }
                });
            };

            /**
             * insertImagesOrCallback
             * @param {File[]} files
             */
            this.insertAttachesOrCallback = function (files) {
                var callbacks = options.callbacks;

                // If onImageUpload options setted
                if (callbacks.onImageUpload) {
                    context.triggerEvent('attach.upload', files);
                    // else insert Image as dataURL
                }else{
                    console.log('upload error');
                }
            };

            // This methods will be called when editor is destroyed by $('..').summernote('destroy');
            // You should remove elements on `initialize`.
            this.destroy = function () {
                this.$panel.remove();
                this.$panel = null;
            };

            this.bindEnterKey = function ($input, $btn) {
                $input.on('keypress', function (event) {
                    if (event.keyCode === 13) {
                        $btn.trigger('click');
                    }
                });
            };

        }
    });
}));
