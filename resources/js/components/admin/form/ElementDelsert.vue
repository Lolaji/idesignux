<template>
    <div>
        <div class="form-group"
            v-for="(m, index) in form_datas"
            :key="index">
            <div class="row">
                <div class="col-md-4">
                    <input type="number" v-model="form_datas[index][fields[0]]" class="form-control" placeholder="10">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="form_datas[index][fields[1]]" placeholder="Description">
                </div>
                <div class="col-md-2">
                    <button 
                        type="button"
                        v-if="isEqualIndex(form_datas, index)"
                        class="btn btn-icon btn-primary btn-sm"
                        @click="upsertElement('add', form_datas)">
                        <span><i class="fe fe-plus"></i></span>
                    </button>

                    <button 
                        type="button"
                        v-else
                        class="btn btn-icon btn-danger btn-sm"
                        @click="upsertElement('remove', form_datas, index)">
                        <span><i class="fe fe-minus"></i></span>
                    </button>
                </div>
            </div>
                
        </div>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
        fields: {
            type: Array,
            required: true
        }
    },
    data(){
        return {
            form_datas: []
        }
    },
    methods: {
        upsertElement(flag, instance, index=null){
            switch(flag) {
                case 'add':
                    instance.push({
                        name: "",
                        content: ""
                    });
                    break;
                case 'remove':
                    instance.splice(index, 1);
                    break;
            }
        },
        isEqualIndex (arrObj, index) {
            if ((index+1) == arrObj.length) {
                return true;
            }
            return false;
        }
    },
    created(){
        this.form_datas = this.data;
    }
}
</script>