import swal from '@/plugin/util/swal';
export default {
    methods: {
        _btnLoading(target, is_load = true) {
            let btn = $(target);
            if (btn.hasClass('fe')) {
                btn = btn.closest('.btn');   
            }

            if (is_load) {
                btn.addClass('btn-loading');
            } else {
                btn.removeClass('btn-loading');
            }
        },

        _fileMultiSelect(selectedfiles, {instance, input}, extra={}) {
            let s_files = [];
            let data = extra;
            if (selectedfiles instanceof Array) {
                Object.entries(selectedfiles).forEach(([index, value]) => {
                    if (_.isNil(instance[input].find((file) => file.url == value.url))) {
                        data.url = value.url;
                        instance[input].push(data);
                        
                    } else {
                        swal.setTitle(`${value.filename} already selected`).setIcon('error').toast();
                    }
                });
            } else {
                if (_.isNil(instance[input].find((file) => file.url == selectedfiles.url))) {
                    data.url = selectedfiles.url;
                    instance[input].push(data);
                } else {
                    swal.setTitle(`${selectedfiles.filename} already selected`).setIcon('error').toast();
                }
            }
        },

        _fileSingleSelect(selectedFile, {instance, input}, callback=null) {
            if (!_.isNil (instance[input])) {
                if (instance[input].url != selectedFile.url) {
                    instance[input] = {
                        id: null,
                        url: selectedFile.url
                    };
                } else {
                    swal.setTitle(`${selectedFile.filename} already selected`).setIcon('error').toast();
                }
            } else {
                instance[input] = {
                    id: null,
                    url: selectedFile.url
                };
            }
        },
        _setSelectedFileId(input, payload) {
            if (_.isArray(input)) {
                let file = input.find(n => {
                    return n.url == payload.url;
                });
                file.id = payload.id;
            } else {
                input.id = payload.id;
            }
        },
        _removeFile(e, payload, store_path, {instance, input, index}) {
            this._btnLoading(e.target);

            if (!_.isNil(payload.id)) {
                this.$store.dispatch(store_path, payload.id).then(res => {
                    if (res) {
                        swal.setTitle(`Image removed successfully`).toast();
                        if (!_.isNil(index)) {
                            instance[input].splice(index, 1);
                        } else {
                            instance[input] = null
                        }
                        this._btnLoading(e.target, false);
                    } else {
                        swal.setTitle(`Unable to remove image due to system error. Please try again.`).setIcon('error').toast();
                    }
                })
            } else {
                if (!_.isNil(index)) {
                    instance[input].splice(index, 1);
                } else {
                    instance[input] = null
                }
            }
        }
    }
}